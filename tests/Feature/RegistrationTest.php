<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\URL;
use Laravel\Fortify\Features;
use Laravel\Jetstream\Jetstream;
use Tests\TestCase;

class RegistrationTest extends TestCase
{
    use RefreshDatabase;

    public function test_registration_screen_can_be_rendered(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(200);
    }

    public function test_registration_screen_cannot_be_rendered_if_support_is_disabled(): void
    {
        if (Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is enabled.');
        }

        $response = $this->get('/register');

        $response->assertStatus(404);
    }

    public function test_new_users_can_register(): void
    {
        if (! Features::enabled(Features::registration())) {
            $this->markTestSkipped('Registration support is not enabled.');
        }

        $response = $this->post('/register', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'whatsapp_number' => '08123456789',
            'password' => 'password',
            'password_confirmation' => 'password',
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature(),
        ]);

        $this->assertGuest();
        $response
            ->assertRedirect(route('login'))
            ->assertSessionHas('status', trans('auth.verify_before_login'));
        $this->assertDatabaseHas('users', [
            'email' => 'test@example.com',
            'whatsapp_number' => '08123456789',
        ]);
    }

    public function test_unverified_users_cannot_login(): void
    {
        $user = User::factory()->unverified()->create([
            'email' => 'unverified@example.com',
        ]);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors([
            'email' => trans('auth.email_not_verified'),
        ]);

        $this->assertGuest();
    }

    public function test_user_can_verify_email_via_signed_link_without_logging_in(): void
    {
        $user = User::factory()->unverified()->create([
            'email' => 'verifyme@example.com',
        ]);

        $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
            'id' => $user->getKey(),
            'hash' => sha1($user->email),
        ]);

        $response = $this->get($url);

        $response
            ->assertRedirect(route('login'))
            ->assertSessionHas('status', trans('auth.verify_success'));

        $this->assertGuest();
        $this->assertTrue($user->fresh()->hasVerifiedEmail());
    }

    public function test_verified_user_can_login_after_confirming_link(): void
    {
        $user = User::factory()->unverified()->create([
            'email' => 'verified@example.com',
        ]);

        $url = URL::temporarySignedRoute('verification.verify', now()->addMinutes(60), [
            'id' => $user->getKey(),
            'hash' => sha1($user->email),
        ]);

        $this->get($url);

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('public.dashboard', absolute: false));
        $this->assertAuthenticatedAs($user->fresh());
    }
}

