<?php

namespace Tests\Feature\Payment;

use App\Models\Batch;
use App\Models\Bootcamp;
use App\Models\Enrollment;
use App\Models\Order;
use App\Models\User;
use App\Services\MidtransService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery;
use Tests\TestCase;

class EnrollmentFlowTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_from_enroll_page(): void
    {
        $bootcamp = Bootcamp::factory()->create(['is_active' => true]);
        Batch::factory()->for($bootcamp)->create(['status' => 'upcoming', 'capacity' => 10]);

        $response = $this->get(route('payment.enroll', $bootcamp->slug));

        $response->assertRedirect(route('login'));
    }

    public function test_authenticated_user_can_view_enroll_page(): void
    {
        $user = User::factory()->create();
        $bootcamp = Bootcamp::factory()->create(['is_active' => true]);
        Batch::factory()->for($bootcamp)->create(['status' => 'upcoming', 'capacity' => 10]);

        $response = $this->actingAs($user)->get(route('payment.enroll', $bootcamp->slug));

        $response->assertOk()->assertViewIs('public.enroll');
    }

    public function test_user_can_submit_enrollment_and_checkout(): void
    {
        $user = User::factory()->create();
        $bootcamp = Bootcamp::factory()->create(['is_active' => true, 'base_price' => 500000]);
        $batch = Batch::factory()->for($bootcamp)->create([
            'status' => 'upcoming',
            'capacity' => 20,
        ]);

        $response = $this->actingAs($user)->post(route('payment.process', $bootcamp->slug), [
            'batch_id' => $batch->id,
            'terms' => true,
        ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('enrollment', [
            'user_id' => $user->id,
            'batch_id' => $batch->id,
            'status' => 'pending',
        ]);

        $order = Order::latest('id')->first();

        $this->assertNotNull($order);
        $response->assertRedirect(route('payment.checkout', $order->id));
        $this->assertSame('pending', $order->status);
        $this->assertSame($bootcamp->base_price, (float) $order->total);
    }
    public function test_checkout_displays_snap_token(): void
    {
        $user = User::factory()->create();
        $bootcamp = Bootcamp::factory()->create(['is_active' => true, 'base_price' => 750000]);
        $batch = Batch::factory()->for($bootcamp)->create(['status' => 'upcoming', 'capacity' => 15]);

        $enrollment = Enrollment::factory()->create([
            'user_id' => $user->id,
            'batch_id' => $batch->id,
            'status' => 'pending',
        ]);

        $order = Order::factory()->create([
            'enrollment_id' => $enrollment->id,
            'amount' => $bootcamp->base_price,
            'total' => $bootcamp->base_price,
            'status' => 'pending',
        ]);

        $midtransMock = Mockery::mock(MidtransService::class);
        $midtransMock->shouldReceive('getSnapToken')->once()->andReturn('test-snap-token');
        $midtransMock->shouldReceive('getSnapJsUrl')->andReturn('https://app.sandbox.midtrans.com/snap/snap.js');
        $midtransMock->shouldReceive('getClientKey')->andReturn('test-client-key');
        app()->instance(MidtransService::class, $midtransMock);

        $response = $this->actingAs($user)->get(route('payment.checkout', $order->id));

        $response->assertOk()
            ->assertViewIs('public.checkout')
            ->assertViewHas('snapToken', 'test-snap-token')
            ->assertViewHas('clientKey', 'test-client-key');
    }

    public function test_midtrans_notification_marks_order_paid(): void
    {
        $user = User::factory()->create();
        $bootcamp = Bootcamp::factory()->create(['is_active' => true, 'base_price' => 600000]);
        $batch = Batch::factory()->for($bootcamp)->create(['status' => 'upcoming', 'capacity' => 10]);

        $enrollment = Enrollment::factory()->create([
            'user_id' => $user->id,
            'batch_id' => $batch->id,
            'status' => 'pending',
        ]);

        $order = Order::factory()->create([
            'enrollment_id' => $enrollment->id,
            'invoice_no' => 'INV-20251001-TEST01',
            'amount' => $bootcamp->base_price,
            'total' => $bootcamp->base_price,
            'status' => 'pending',
        ]);

        $payload = [
            'order_id' => $order->invoice_no,
            'transaction_status' => 'settlement',
            'fraud_status' => 'accept',
            'transaction_id' => 'test-transaction',
            'payment_type' => 'bank_transfer',
            'va_numbers' => [
                ['va_number' => '1234567890'],
            ],
            'pdf_url' => 'https://snap.test/receipt.pdf',
        ];

        $response = $this->postJson(route('payment.notification'), $payload);

        $response->assertOk();
        $this->assertEquals('paid', $order->fresh()->status);
        $this->assertEquals('confirmed', $enrollment->fresh()->status);
        $this->assertDatabaseHas('payment', [
            'order_id' => $order->id,
            'transaction_id' => 'test-transaction',
            'status' => 'success',
        ]);
    }

    public function test_midtrans_notification_handles_expired_order(): void
    {
        $user = User::factory()->create();
        $bootcamp = Bootcamp::factory()->create(['is_active' => true, 'base_price' => 400000]);
        $batch = Batch::factory()->for($bootcamp)->create(['status' => 'upcoming', 'capacity' => 5]);

        $enrollment = Enrollment::factory()->create([
            'user_id' => $user->id,
            'batch_id' => $batch->id,
            'status' => 'pending',
        ]);

        $order = Order::factory()->create([
            'enrollment_id' => $enrollment->id,
            'invoice_no' => 'INV-20251001-EXPIRE',
            'amount' => $bootcamp->base_price,
            'total' => $bootcamp->base_price,
            'status' => 'pending',
        ]);

        $payload = [
            'order_id' => $order->invoice_no,
            'transaction_status' => 'expire',
            'fraud_status' => 'accept',
            'transaction_id' => 'test-expired',
        ];

        $response = $this->postJson(route('payment.notification'), $payload);

        $response->assertOk();
        $this->assertEquals('expired', $order->fresh()->status);
        $this->assertEquals('pending', $enrollment->fresh()->status);
        $this->assertDatabaseHas('payment', [
            'order_id' => $order->id,
            'status' => 'failed',
        ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}












