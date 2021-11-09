<?php

namespace Xup\Web\Policies;

use Illuminate\Auth\Access\Response;

class CurrentFleetPolicy extends AbstractPolicy
{

    public function __call(string $method, array $args)
    {
        if($this->ability == 'current-fleet'){

        }

        if($this->ability == 'join-fleet'){

        }

        /*if(count($args) < 1){
            return false;
        }

        $user = $args[0];

        $message = sprintf('Request to %s was denied. The Permission %s is required', request()->path(), $this->ability);

        return $this->userHasPermissions($user, $this->ability, function() use ($user){
            $acl = $this->permissionsFrom($user);

            $permissions = $acl->filter(function($permission){
                return $permission->title === $this->ability;
            });

            return $permissions->isNotEmpty();
        }) ? Response::allow() : Response::deny($message);*/
    }

    protected function userCanJoinFleet(){

    }

    protected function userIsInFleet(){

    }
}