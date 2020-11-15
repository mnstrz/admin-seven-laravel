<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{
    public $modal_title = null;
    public $modal_color = null;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($color=null,$title=null)
    {
        $this->modal_color = $color;
        $this->modal_title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.modal');
    }
}
