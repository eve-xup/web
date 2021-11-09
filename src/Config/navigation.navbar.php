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
    '1currentFleet' => [
        'name'=>'current_fleet',
        'icon' => 'heroicon-o-home',
        'label' => 'Current Fleet',
        'route' => 'xup.fleets.current',
        'permissions' => 'xup.current-fleet',
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