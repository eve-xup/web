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

];