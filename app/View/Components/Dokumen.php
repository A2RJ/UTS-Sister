<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dokumen extends Component
{
    public $document;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($document)
    {
        $this->document = $document;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dokumen');
    }
}
