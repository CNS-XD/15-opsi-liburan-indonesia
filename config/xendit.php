<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Xendit Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for Xendit payment gateway
    |
    */

    'secret_key' => env('XENDIT_SECRET_KEY'),
    'public_key' => env('XENDIT_PUBLIC_KEY'),
    'webhook_token' => env('XENDIT_WEBHOOK_TOKEN'),
    'environment' => env('XENDIT_ENVIRONMENT', 'test'), // test or live
    
    /*
    |--------------------------------------------------------------------------
    | Payment Methods
    |--------------------------------------------------------------------------
    |
    | Available payment methods for Xendit
    |
    */
    'payment_methods' => [
        'virtual_account' => [
            'bca' => 'BCA Virtual Account',
            'bni' => 'BNI Virtual Account',
            'bri' => 'BRI Virtual Account',
            'mandiri' => 'Mandiri Virtual Account',
            'permata' => 'Permata Virtual Account',
        ],
        'ewallet' => [
            'ovo' => 'OVO',
            'dana' => 'DANA',
            'linkaja' => 'LinkAja',
            'shopeepay' => 'ShopeePay',
        ],
        'qr_code' => [
            'qris' => 'QRIS',
        ],
        'credit_card' => [
            'visa' => 'Visa',
            'mastercard' => 'Mastercard',
            'jcb' => 'JCB',
            'amex' => 'American Express',
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Currency
    |--------------------------------------------------------------------------
    |
    | Default currency for payments
    |
    */
    'currency' => 'IDR',

    /*
    |--------------------------------------------------------------------------
    | Webhook URLs
    |--------------------------------------------------------------------------
    |
    | URLs for Xendit webhooks
    |
    */
    'webhook_urls' => [
        'invoice' => env('APP_URL') . '/webhook/xendit/invoice',
        'virtual_account' => env('APP_URL') . '/webhook/xendit/virtual-account',
        'ewallet' => env('APP_URL') . '/webhook/xendit/ewallet',
    ],

    /*
    |--------------------------------------------------------------------------
    | Payment Expiry
    |--------------------------------------------------------------------------
    |
    | Default payment expiry time in hours
    |
    */
    'payment_expiry_hours' => 24,
];