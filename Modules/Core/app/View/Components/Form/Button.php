<?php

namespace Modules\Core\View\Components\Form;

use Illuminate\View\Component;
use Illuminate\View\View;

class Button extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct() {}

    /**
     * Get the view/contents that represent the component.
     */
    public function render(): View|string
    {
        return view('core::components.form/button');
    }
}
