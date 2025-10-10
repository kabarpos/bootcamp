<?php

namespace Database\Seeders;

use App\Models\EmailTemplate;
use Illuminate\Database\Seeder;

class EmailTemplateSeeder extends Seeder
{
    public function run(): void
    {
        $templates = [
            [
                'key' => 'registration_verification',
                'name' => 'Verifikasi Registrasi',
                'subject' => 'Verifikasi Akun Anda di {{app_name}}',
                'content' => "Halo {{name}},\n\nTerima kasih telah mendaftar di {{app_name}}.\nKlik tautan berikut untuk memverifikasi akun Anda:\n{{verification_link}}\n\nTautan akan kadaluarsa dalam {{expires_in}}.\n\nSalam hangat,\nTim {{app_name}}",
            ],
            [
                'key' => 'password_reset',
                'name' => 'Reset Password',
                'subject' => 'Permintaan Reset Password - {{app_name}}',
                'content' => "Halo {{name}},\n\nKami menerima permintaan untuk reset password akun Anda.\nSilakan klik tautan berikut untuk mengatur password baru:\n{{reset_link}}\n\nTautan ini hanya berlaku hingga {{expires_in}}.\nJika Anda tidak meminta reset, abaikan email ini.\n\nSalam,\nTim {{app_name}}",
            ],
            [
                'key' => 'order_created',
                'name' => 'Order Bootcamp',
                'subject' => 'Invoice {{invoice_no}} - {{bootcamp_title}}',
                'content' => "Halo {{name}},\n\nOrder Anda dengan nomor invoice {{invoice_no}} telah kami terima.\nProgram: {{bootcamp_title}}\nTotal pembayaran: Rp {{amount}}\nBatas pembayaran: {{expires_at}}\n\nSilakan selesaikan pembayaran melalui dashboard Anda.\n\nTerima kasih,\nTim {{app_name}}",
            ],
            [
                'key' => 'payment_success',
                'name' => 'Pembayaran Berhasil',
                'subject' => 'Pembayaran Diterima - Invoice {{invoice_no}}',
                'content' => "Halo {{name}},\n\nKami telah menerima pembayaran untuk invoice {{invoice_no}}.\nStatus enrollment Anda saat ini: {{enrollment_status}}.\nSampai jumpa di kelas {{bootcamp_title}}.\n\nSalam,\nTim {{app_name}}",
            ],
            [
                'key' => 'payment_failed',
                'name' => 'Pembayaran Gagal / Expired',
                'subject' => 'Pembayaran Belum Berhasil - Invoice {{invoice_no}}',
                'content' => "Halo {{name}},\n\nPembayaran untuk invoice {{invoice_no}} belum berhasil atau telah kadaluarsa.\nAnda dapat melakukan pembayaran ulang melalui tautan berikut:\n{{checkout_url}}\n\nHubungi tim kami jika membutuhkan bantuan.\n\nTerima kasih,\nTim {{app_name}}",
            ],
        ];

        foreach ($templates as $template) {
            $placeholders = [];
            preg_match_all('/{{\\s*(.*?)\\s*}}/', $template['subject'] . ' ' . $template['content'], $matches);
            if (! empty($matches[1])) {
                $placeholders = array_values(array_unique($matches[1]));
            }

            EmailTemplate::updateOrCreate(
                ['key' => $template['key']],
                [
                    'name' => $template['name'],
                    'subject' => $template['subject'],
                    'content' => $template['content'],
                    'placeholders' => $placeholders,
                    'is_active' => true,
                ]
            );
        }
    }
}
