<?php

namespace Xup\Web\Components\Livewire\Modals\Acl;

use LivewireUI\Modal\ModalComponent;

class AddRole extends ModalComponent
{

    public function render()
    {
        return view('web::components.livewire.acl.add-role');
    }

}