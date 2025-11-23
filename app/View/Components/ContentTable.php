<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ContentTable extends Component
{
    public $items;
    public $title;
    public $editRoute;
    public $deleteRoute;
    public $showImage;
    public $showBody;
    public $showFiles;

    /**
     * Create a new component instance.
     */
    public function __construct(
        $items = [],
        $title = '',
        $editRoute = null,
        $deleteRoute = null,
        $showImage = false,
        $showBody = false,
        $showFiles = false
    ) {
        $this->items = $items;
        $this->title = $title;
        $this->editRoute = $editRoute;
        $this->deleteRoute = $deleteRoute;
        $this->showImage = $showImage;
        $this->showBody = $showBody;
        $this->showFiles = $showFiles;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.content-table');
    }
}
