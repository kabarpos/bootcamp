<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UpdateMidtransSettingsRequest;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function editMidtrans()
    {
        $settings = [
            'mode' => Setting::get('midtrans_mode', 'sandbox'),
            'sandbox_server_key' => Setting::get('midtrans_sandbox_server_key', ''),
            'sandbox_client_key' => Setting::get('midtrans_sandbox_client_key', ''),
            'production_server_key' => Setting::get('midtrans_production_server_key', ''),
            'production_client_key' => Setting::get('midtrans_production_client_key', ''),
        ];

        return view('admin.settings.midtrans', compact('settings'));
    }

    public function updateMidtrans(UpdateMidtransSettingsRequest $request)
    {
        $data = $request->validated();

        Setting::set('midtrans_mode', $data['mode']);
        Setting::set('midtrans_sandbox_server_key', $data['sandbox_server_key']);
        Setting::set('midtrans_sandbox_client_key', $data['sandbox_client_key']);
        Setting::set('midtrans_production_server_key', $data['production_server_key']);
        Setting::set('midtrans_production_client_key', $data['production_client_key']);

        return redirect()
            ->route('admin.settings.midtrans.edit')
            ->with('success', 'Pengaturan Midtrans berhasil disimpan.');
    }
}
