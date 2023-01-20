<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $name, $label, $current, $select, $required;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $current = "", $select = [], $required = true)
    {
        $this->name = $name;
        $this->label = $label;
        $this->current = $current;
        $this->select = $select;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.select');
    }
}
