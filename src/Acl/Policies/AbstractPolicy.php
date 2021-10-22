<?php

namespace Xup\Web\Acl\Policies;

use Closure;
use Illuminate\Support\Facades\Cache;
use Xup\Core\Models\User;

abstract class AbstractPolicy
{
    const CACHE_TTL = 10;

    protected $ability;


    public function before(User $user, $ability)
    {
        $this->ability = $ability;


        if($user->isAdmin()){
            return true;
        }
    }

    protected function permissionsFrom(User $user){
        $cache = sprintf('users.%d:acl', $user->getKey());

        return Cache::store('redis')->remember($cache, self::CACHE_TTL, function() use ($user){
            return $user->roles()->with('permissions')->get()->pluck('permissions')->flatten();
        });
    }

    protected function userHasPermission(User $user, string $permission, Closure $callback)
    {
        $cache = sprintf('users:%d:acl:permissions:%s', $user->getKey(), $permission);

        return Cache::store('redis')->remember($cache, self::CACHE_TTL, $callback) !== false;
    }
}