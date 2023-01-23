<?php

return [

    'name' => 'cities',
    'publishes' => [
        'config' => [

        ],
        'controllers' => [
            'DashboardController.php'
        ],
        'auth' => [
            'LoginController.php'
        ],
        'middleware' => [
            'SuperAuthenticated.php',
            'AdminAuthenticated.php'
        ],
        'migrations' => [
            '2014_10_12_000000_create_users_table.php',
            '2014_10_12_100000_create_password_resets_table.php'
        ],
        'seeds' => [

        ],
        'routes' => [
            'admin.php',
            'dashboard.php'
        ],
        'models' => [
            'Users',
        ],
        'views' => [
            'dashboard',
            'custom'
        ],
        'view_components' => [
            'Modal.php',
            'Panel.php'
        ],
        'assets_css' => [

        ],
        'assets_js' => [
            'base'
        ],
        'admin_assets' => [

        ],
        'files' => [
            'users'
        ]
    ],
    'migrates' => [

    ]

];
