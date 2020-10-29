<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Stepper extends Component
{
    public $steps;
    public $buttons;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($steps=null,$buttons=true)
    {
        $this->steps = $steps;
        $this->buttons = $buttons;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.step');
    }
}
