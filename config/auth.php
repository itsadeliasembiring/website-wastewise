<?php
return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'akun', // Ubah dari 'users' ke 'akun'
        ],
    ],

    'providers' => [
        'akun' => [ // Tambahkan provider baru
            'driver' => 'eloquent',
            'model' => App\Models\AkunModel::class,
        ],
        
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'akun', // Ubah ke provider 'akun'
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];