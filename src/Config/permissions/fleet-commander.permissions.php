<?php

return [
    'fleet-commander'=>[
        'label' => 'Fleet Commander',
        'description' => 'Allows user to register their fleet',
        'gate' => \Xup\Web\Acl\Policies\CreateFleetPolicy::class
    ],

    'fleet-manager' => [
        'assignable' => false,
        'label'=> "Current Fleet",
        'gate'=> \Xup\Web\Acl\Policies\InFleetPolicy::class,
    ],

    'in-fleet'=>[
        'assignable' => false,
        'label'=> "Current Fleet",
        'gate'=> \Xup\Web\Acl\Policies\InFleetPolicy::class,
    ],

];
