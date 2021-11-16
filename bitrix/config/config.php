<?php

return [
    'db' => [
        'login' => 'gregreg',
        'password' => 'ihgjoref',
    ],
    'routes' => [
        [
            'pattern' => "~^/$~",
            'params' => [
                'path' => 'home.php',
                'method' => 'GET',
                'controller' => "\App\Controllers\PublicPageController"
            ]
        ],
        [
            'pattern' => "~login~",
            'params' => [
                'path' => 'login.php',
                'method' => 'GET',
                'controller' => "\App\Controllers\PublicPageController"
            ]
        ],
        [
            'pattern' => "~^/registration$~",
            'params' => [
                'path' => 'register.php',
                'method' => 'GET',
                'controller' => "\App\Controllers\PublicPageController"
            ]
        ],
        [
            'pattern' => "#/profile/(?P<id>\d+)$#i",
            'params' => [
                'path' => 'profile.php',
                'method' => 'GET',
                'controller' => "\App\Controllers\PublicPageController"
            ]
        ],
        [
            'pattern' => "#/profile#i",
            'params' => [
                'path' => 'profile.php',
                'method' => 'GET',
                'controller' => "\App\Controllers\PublicPageController"
            ]
        ],
        [
            'pattern' => "~^/auth/register$~",
            'params' => [
                'method' => 'POST',
                'controller' => "\App\Controllers\AuthController",
                'class' => "\App\Services\Auth",
                'action' => "register",
            ],

        ],
        [
            'pattern' => "~^/auth/auth$~",
            'params' => [
                'method' => 'POST',
                'controller' => "\App\Controllers\AuthController",
                'class' => "\App\Services\Auth",
                'action' => "auth",
            ]
        ],
        [
            'pattern' => "~^/auth/logout$~",
            'params' => [
                'method' => 'POST',
                'controller' => "\App\Controllers\AuthController",
                'class' => "\App\Services\Auth",
                'action' => "logout",
            ]
        ],
    ],
    "template_id" => "alice"
];
