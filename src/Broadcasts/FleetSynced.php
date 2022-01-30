<?php


namespace Xup\Web\Broadcasts;


use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Xup\Core\Models\Fleets\Fleet;

class FleetSynced implements ShouldBroadcast
{
    use SerializesModels, Dispatchable;

    public int $fleet_id;

    public function broadcastQueue()
    {
        return 'broadcasts';
    }

    public function __construct(int $fleet_id)
    {
        $this->fleet_id = $fleet_id;
    }

    public function broadcastOn()
    {
        return new Channel('fleet.' . $this->fleet_id);
    }

    public function broadcastAs()
    {
        return 'fleet.synced';
    }
}
