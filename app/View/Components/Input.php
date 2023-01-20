<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $name, $label, $type, $placeholder, $value, $required, $readOnly;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label = "default label", $type = "text", $placeholder = "", $value = "", $required = true, $readOnly = false)
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->required = $required;
        $this->readOnly = $readOnly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.input');
    }
}
