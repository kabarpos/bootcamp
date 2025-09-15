<?php

return [
    'server_key' => env('MIDTRANS_SERVER_KEY'),
    'client_key' => env('MIDTRANS_CLIENT_KEY'),
    'is_production' => env('MIDTRANS_IS_PRODUCTION', false),
    'sanitized_redirect_url' => env('MIDTRANS_SANITIZED_REDIRECT_URL', env('APP_URL').'/payment/success'),
    '3ds_redirect_url' => env('MIDTRANS_3DS_REDIRECT_URL', env('APP_URL').'/payment/success'),
];