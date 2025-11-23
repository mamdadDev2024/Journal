<?php

namespace Modules\Magazine\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class ArticleForm extends Component
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
        return view('magazine::components.articleform');
    }
}
