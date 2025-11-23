<?php

namespace Modules\Core\View\Components;

use Illuminate\View\Component;

class Link extends Component
{
    public string $href;
    public string $text;
    public string $class;

    public function __construct(string $href, string $text, string $class = '')
    {
        $this->href = $href;
        $this->text = $text;
        $this->class = $class;
    }

    public function render()
    {
        return view('core::components.link');
    }
}
