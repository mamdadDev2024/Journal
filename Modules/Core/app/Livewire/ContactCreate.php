<?php

namespace Modules\Core\Livewire;

use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactCreate extends Component
{
    #[Validate('required|numeric')]
    public $number;
    #[Validate('required|string')]
    public $body;

    public function save()
    {
        $data = $this->validate();
    }
    public function render()
    {
        return view('core::livewire.contact-create');
    }
}
