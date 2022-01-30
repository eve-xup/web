<?php


namespace Xup\Web\Acl\Policies;


use Xup\Core\Models\Fleets\Fleet;
use Illuminate\Auth\Access\Response;
use Xup\Core\Models\User;
use Xup\Web\Actions\Cache\UserCurrentFleet;

class InFleetPolicy extends AbstractPolicy
{
    public function before(User $user, $ability)
    {
        return $this->IsInFleet();
    }

    /**
     * Checks to see if the current user is in a fleet or not.
     * @return bool
     */
    public function IsInFleet(): bool
    {
        return (new UserCurrentFleet())->handle() != null;
    }
}
