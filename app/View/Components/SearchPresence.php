<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SearchPresence extends Component
{
    public $exportUrl, $withDate;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($exportUrl = false, $withDate = false)
    {
        $this->exportUrl = $exportUrl;
        $this->withDate = $withDate;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.search-presence');
    }
}
