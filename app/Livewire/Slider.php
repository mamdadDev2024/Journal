<?php
namespace App\Http\Livewire;

use Livewire\Component;

class Slider extends Component
{
    public $items;
    public $type;
    public $defaultLink;
    public $containerClass;

    public function mount($items, $type = '', $defaultLink = '#', $containerClass = '')
    {
        $this->items = $items;
        $this->type = $type;
        $this->defaultLink = $defaultLink;
        $this->containerClass = $containerClass;
    }

    public function render()
    {
        return view('livewire.slider');
    }
}
