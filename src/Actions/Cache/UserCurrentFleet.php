<?php


namespace Xup\Web\Actions\Cache;


use Xup\Core\Models\Fleets\Fleet;
use Xup\Web\Concerns\Handler;

class UserCurrentFleet implements Handler
{
    private $cacheKey;

    const TTL = 2;



    public function __construct()
    {
        $this->cacheKey = sprintf("%s.%d", 'current-fleet', auth()->user()->getKey());
    }

    public function handle()
    {
        return cache()->remember($this->cacheKey, self::TTL, function(){
            return Fleet::InFleet()->first();
        });
    }
}
