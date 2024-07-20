<?php

return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
        'pupil' => [
            'driver' => 'session',
            'provider' => 'pupils',
        ],
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],
        'representative' => [
            'driver' => 'session',
            'provider' => 'representatives',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],
        'pupils' => [
            'driver' => 'eloquent',
            'model' => App\Models\Pupil::class,
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Administrator::class,
        ],
        'representatives' => [
            'driver' => 'eloquent',
            'model' => App\Models\Representative::class,
        ],
    ],

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'pupils' => [
            'provider' => 'pupils',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'administrators' => [
            'provider' => 'admins',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
        'representatives' => [
            'provider' => 'represantatives',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];



// return [
//     'defaults' => [
//         'guard' => 'web',
//         'passwords' => 'users',
//     ],

//     'guards' => [
//         'web' => [
//             'driver' => 'session',
//             'provider' => 'users',
//         ],
//     ],

//     'providers' => [
//         'users' => [
//             'driver' => 'eloquent',
//             'model' => App\Models\User::class,
//         ],
//     ],
//     'passwords' => [
//         'users' => [
//             'provider' => 'users',
//             'table' => 'password_resets',
//             'expire' => 60,
//             'throttle' => 60,
//         ],
//     ],

//     'password_timeout' => 10800,

// ]; -->
