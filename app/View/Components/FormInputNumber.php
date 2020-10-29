<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInputNumber extends Component
{
    public $column;
    public $label;
    public $name;
    public $value;
    public $class;
    public $placeholder;
    public $help;
    public $after;
    public $before;
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($column,$label,$class=null,$help=null,$after=null,$before=null,$color="grey-light")
    {
        $this->column = explode(':', $column);
        $this->label = $label;
        $this->class = $class;
        $this->help = $help;
        $this->after = $after;
        $this->before = $before;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.input-number');
    }
}
