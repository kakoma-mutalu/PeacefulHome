<?php

return [
    'airtel_money' => [
        'client_id' => env('AIRTEL_MONEY_CLIENT_ID'),
        'client_secret' => env('AIRTEL_MONEY_CLIENT_SECRET'),
        'base_url' => env('AIRTEL_MONEY_BASE_URL'),
        'callback_url' => env('AIRTEL_MONEY_CALLBACK_URL'),
        'country' => env('AIRTEL_MONEY_COUNTRY', 'ZM'),
        'currency' => env('AIRTEL_MONEY_CURRENCY', 'ZMW'),
    ],
];
