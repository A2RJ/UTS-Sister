<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Table extends Component
{
    public $header;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($header = [])
    {
        $this->header = $header;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.table');
    }
}
