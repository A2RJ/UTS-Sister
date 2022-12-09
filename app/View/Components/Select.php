<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Select extends Component
{
    public $name;
    public $label;
    public $current;
    public $select;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $current, $select = [])
    {
        $this->name = $name;
        $this->label = $label;
        $this->current = $current;
        $this->select = $select;
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
