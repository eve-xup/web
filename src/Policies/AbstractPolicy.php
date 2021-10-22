<?php

namespace Xup\Web\Policies;

use Closure;
use Xup\Core\Models\User;

abstract class AbstractPolicy
{

    const CACHE_DURACTION = 10;

    protected $ability;


    public function before(User $user, $ability)
    {
        $this->ability = $ability;

        if($user->isAdmin()){
            return true;
        }
    }


    /**
     * Fetch permissions from user model
     * @param User $user
     * @return mixed
     * @throws \Exception
     */
    protected function permissionsFrom(User $user){
        $cache_key = sprintf('users:%d:acl', $user->id);

        return cache()->remember($cache_key, self::CACHE_DURACTION, function() use ($user){
            return $user->roles()->with('permissions')->get()->pluck('permissions')->flatten();
        });
    }

    /**
     *
     * @param User $user
     * @param string $permission
     * @param Closure $callback
     * @param int|null $entity_id
     * @return bool
     * @throws \Exception
     */
    protected function userHasPermissions(User $user, string $permission, Closure $callback, ?int $entity_id = null): bool
    {
        $cache_key = sprintf('users:%d:acl:permissions:%s:%d', $user->id, $permission, $entity_id ?: 0);

        return cache()->remember($cache_key, self::CACHE_DURACTION, $callback) !== false;
    }
}