<?php


return [
    '0home'=> [
        'name' => 'home',
        //'group' => false,
        'icon' => 'heroicon-o-home',
        'label' => 'Home',
        'route' => 'home',
        'match' => 'home',
    ],

    '1fleetManagement' => [
        'name'=>'fleet_manager',
        'icon' => 'heroicon-o-adjustments',
        'label' => 'Fleet Management',
        'route' => 'xup.fleets.current',
        'parameters' => [
            'fleet' => \Xup\Web\Actions\Cache\UserCurrentFleet::class,
        ],
        'permissions' => 'xup.fleet-manager',
    ],
    '2currentFleet' => [
        'name'=>'current_fleet',
        'icon' => 'heroicon-o-paper-airplane',
        'iconClass'=> 'rotate-45',
        'label' => 'Current Fleet',
        'route' => 'xup.fleets.current',
        'parameters' => [
            'fleet' => \Xup\Web\Actions\Cache\UserCurrentFleet::class,
        ],
        'permissions' => 'xup.in-fleet',
    ],

    'administration' => [
        'name' => 'access-management',
        'group' => 'Administration',
        'icon' => 'heroicon-o-cog',
        'label' => 'Settings',
        'entries' => [
            [
                'icon' => 'heroicon-o-shield-check',
                'label' => 'Access Management',
                'route' => 'settings.acl.index',
                'permissions' => 'acl.manage',
                'match' => 'access',
            ],
            /*[
                'icon' => 'heroicon-o-users',
                'label' => 'Users',
                'route' => 'settings.access.index',
                //'permissions' => 'acl.manage',
                'match' => 'users',
            ]*/
        ]
    ],
    'fleets' => [
        'name'  => 'fleet-management',
        'group' => 'X-UP',
        'icon'  =>  'heroicon-o-cube-transparent',
        'label' => 'Form Fleet',
        'permissions' => 'xup.fleet-commander',
        'route' => 'xup.fleets.create'
    ]

];
