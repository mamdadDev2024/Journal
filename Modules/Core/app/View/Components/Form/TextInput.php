<?php


namespace Modules\Core\View\Components\Form;
use Illuminate\View\Component;

class TextInput extends Component
{
    public string $label;
    public string $name;
    public string $placeholder;
    public string $type;

    public function __construct(string $label, string $name, string $placeholder = '', string $type = 'text')
    {
        $this->label = $label;
        $this->name = $name;
        $this->placeholder = $placeholder;
        $this->type = $type;
    }

    public function render()
    {
        return view('core::components.form.textinput');
    }
}
