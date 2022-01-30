<?php


namespace Xup\Web\Http\Composers;


use Illuminate\View\View;
use Xup\Core\Models\Fleets\Fleet;

class FleetList
{
    public function compose(View $view)
    {
        $fleets = Fleet::query()->with('fleet_boss')->get();
        $view->with('fleets', $fleets);
    }

}
