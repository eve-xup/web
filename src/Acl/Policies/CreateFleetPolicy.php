<?php


namespace Xup\Web\Acl\Policies;


use Xup\Core\Models\User;
use Xup\Web\Actions\Cache\UserCurrentFleet;
use Illuminate\Auth\Access\Response;


class CreateFleetPolicy extends AbstractPolicy
{

    public function before(User $user, $ability)
    {
        $this->ability = $ability;
    }

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
            return $permissions->isNotEmpty() && !$this->IsInFleet();
        }) ? Response::allow() : Response::deny($message);
    }

    public function IsInFleet(){
        return (new UserCurrentFleet())->handle() != null;
    }

}
