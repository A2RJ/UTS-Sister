<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Form extends Component
{
    public $action, $displayError;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $displayError = false)
    {
        $this->action = $action;
        $this->displayError = $displayError;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form');
    }
}
