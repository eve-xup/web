<?php

namespace Xup\Web\Acl\Policies;

use Illuminate\Auth\Access\Response;
use Xup\Core\Models\User;

class GlobalPolicy extends AbstractPolicy
{

    public function __call(string $method, array $args)
    {
        if(count($args) < 1)
            return false;

        $user = $args[0];

        $message = sprintf('Request to %s was denied. The permission required is %s', request()->path(), $this->ability);

        return $this->userHasPermission($user, $this->ability, function() use ($user){
            $acl = $this->permissionsFrom($user);

            $permissions = $acl->filter(function($permission){
                return $permission->title === $this->ability;
            });

            return $permissions->isNotEmpty();
        }) ? Response::allow() : Response::deny($message);
    }

    public function superuser(User $user)
    {
        $message = sprintf('Request to %s was denied. The permission required is %s', request()->path(), $this->ability);

        return $user->isAdmin() ? Response::allow() : Response::deny($message);
    }
}