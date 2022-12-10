<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Delete extends Component
{
    public $action, $text, $confirm;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action, $confirm = "Yakin hapus data?")
    {
        $this->action = $action;
        $this->text = "Delete";
        $this->confirm = $confirm;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.delete');
    }
}
