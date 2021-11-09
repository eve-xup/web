<?php


return [
    [
        'label' => 'Permissions',
        'route' => 'settings.acl.edit',
        'permissions' => 'acl.manage',
        'match' => 'access',
    ],
    [
        'label' => 'Users',
        'route' => 'settings.acl.users',
        'permissions' => 'acl.assign',
        'match' => 'access',
    ],
];