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
            "pattern" => "~^/profile$~",
            "page_name" => "profile",
            "method" => 'GET',
        ],
        [
            "pattern" => "~^/auth/register$~",
            "page_name" => "null",
            "method" => 'POST',
            "namespace" => "App\Controllers\Auth",
            "form_data" => 1,
            "action" => "register"
        ],
        [
            "pattern" => "~^/auth/auth$~",
            "page_name" => "null",
            "method" => 'POST',
            "namespace" => "App\Controllers\Auth",
            "form_data" => 1,
            "action" => "auth"
        ],
        [
            "pattern" => "~^/auth/logout$~",
            "page_name" => "null",
            "method" => 'POST',
            "namespace" => "App\Controllers\Auth",
            "form_data" => 0,
            "action" => "logout"
        ],
    ]
];
