<?php

namespace Tests\Feature\Admin;

use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class WhatsappSettingsTest extends TestCase
{
    use RefreshDatabase;

    private function makeAdmin(): User
    {
        $user = User::factory()->create([
            'email_verified_at' => now(),
        ]);

        $role = Role::factory()->create([
            'name' => 'admin',
            'guard_name' => 'web',
        ]);

        $user->roles()->attach($role->id);

        return $user;
    }

    private function fakeSuccessResponses(): void
    {
        Http::fake([
            'https://app.dripsender.com/api/v3' => Http::response(['status' => 'ok'], 200),
            'https://app.dripsender.com/api/v3/me' => Http::response(['status' => 'ok'], 200),
        ]);
    }

    private function provisionSettings(): void
    {
        Setting::set('whatsapp_enabled', true);
        Setting::set('whatsapp_api_key', 'test-key');
        Setting::set('whatsapp_api_base_url', 'https://app.dripsender.com/api/v3');
        Setting::set('whatsapp_sender_number', '6281234567890');
        Setting::set('whatsapp_message_endpoint', 'messages/send');
    }

    public function test_admin_can_test_whatsapp_connection_successfully(): void
    {
        $this->fakeSuccessResponses();
        $this->provisionSettings();

        $admin = $this->makeAdmin();

        $response = $this->actingAs($admin)
            ->post(route('admin.settings.whatsapp.test'));

        $response->assertRedirect(route('admin.settings.whatsapp.edit'));
        $response->assertSessionHas('success', 'Koneksi ke Dripsender berhasil.');
    }

    public function test_test_connection_returns_error_when_api_key_invalid(): void
    {
        Http::fake([
            'https://app.dripsender.com/api/v3' => Http::response(['status' => 'ok'], 200),
            'https://app.dripsender.com/api/v3/me' => Http::response([], 401),
        ]);

        $this->provisionSettings();

        $admin = $this->makeAdmin();

        $response = $this->actingAs($admin)
            ->post(route('admin.settings.whatsapp.test'));

        $response->assertRedirect(route('admin.settings.whatsapp.edit'));
        $response->assertSessionHas('error');
        $response->assertSessionHasErrors('api_key');
    }
}
