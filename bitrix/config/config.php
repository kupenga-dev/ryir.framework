<?php

return [
    "db" => [
        "login" => "gregreg",
        "password" => "ihgjoref",
    ],
    "routes" => [
        [
            "pattern" => "~^/$~",
            "page_name" => "login",
            "method" => 'GET'
        ],
        [
            "pattern" => "~^/registration$~",
            "page_name" => "register",
            "method" => 'GET',
        ],
        [
            "pattern" => "#/profile/(?P<id>\d+)$#i",
            "page_name" => "profile",
            "method" => 'GET',
        ],
        [
            "pattern" => "~^/auth/register$~",
            "page_name" => "null",
            "method" => 'POST',
            "namespace" => "App\Controllers\Auth",
            "action" => "register"
        ],
        [
            "pattern" => "~^/auth/auth$~",
            "page_name" => "null",
            "method" => 'POST',
            "namespace" => "App\Controllers\Auth",
            "action" => "auth"
        ],
        [
            "pattern" => "~^/auth/logout$~",
            "page_name" => "null",
            "method" => 'POST',
            "namespace" => "App\Controllers\Auth",
            "action" => "logout"
        ],
    ]
];
