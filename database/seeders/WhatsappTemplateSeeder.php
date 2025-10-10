<?php

namespace Database\Seeders;

use App\Models\WhatsappTemplate;
use Illuminate\Database\Seeder;

class WhatsappTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $templates = [
            [
                'key' => 'registration_verification',
                'name' => 'Verifikasi Registrasi',
                'content' => "Hallo {{name}},\n\nTerima kasih telah mendaftar di {{app_name}}.\nKlik tautan berikut untuk verifikasi akun Anda:\n{{verification_link}}\n\nTautan akan kadaluarsa dalam {{expires_in}}.\n\nSalam,\nTim {{app_name}}",
                'placeholders' => ['name', 'app_name', 'verification_link', 'expires_in'],
            ],
            [
                'key' => 'order_created',
                'name' => 'Notifikasi Order Baru',
                'content' => "Halo {{name}},\n\nOrder Anda dengan nomor invoice {{invoice_no}} untuk program {{bootcamp_title}} telah berhasil dibuat.\nTotal pembayaran: Rp {{amount}}.\n\nSelesaikan pembayaran sebelum {{expires_at}}.\n\nTerima kasih,\nTim {{app_name}}",
                'placeholders' => ['name', 'invoice_no', 'bootcamp_title', 'amount', 'expires_at', 'app_name'],
            ],
            [
                'key' => 'payment_success',
                'name' => 'Pembayaran Berhasil',
                'content' => "Selamat {{name}}!\n\nPembayaran untuk invoice {{invoice_no}} telah kami terima.\nStatus enrollment Anda: {{enrollment_status}}.\n\nSampai jumpa di kelas {{bootcamp_title}}.\n\nSalam,\nTim {{app_name}}",
                'placeholders' => ['name', 'invoice_no', 'enrollment_status', 'bootcamp_title', 'app_name'],
            ],
            [
                'key' => 'payment_failed',
                'name' => 'Pembayaran Gagal / Expired',
                'content' => "Halo {{name}},\n\nPembayaran untuk invoice {{invoice_no}} tidak berhasil atau telah kadaluarsa.\nAnda dapat melakukan pembayaran ulang melalui tautan berikut:\n{{checkout_url}}\n\nButuh bantuan? Hubungi tim support {{app_name}}.\n\nTerima kasih.",
                'placeholders' => ['name', 'invoice_no', 'checkout_url', 'app_name'],
            ],
        ];

        foreach ($templates as $template) {
            WhatsappTemplate::updateOrCreate(
                ['key' => $template['key']],
                [
                    'name' => $template['name'],
                    'content' => $template['content'],
                    'placeholders' => $template['placeholders'],
                    'is_active' => true,
                ]
            );
        }
    }
}
