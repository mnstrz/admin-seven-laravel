<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInputDateRange extends Component
{
    public $column;
    public $label;
    public $class;
    public $help;
    public $name;
    public $color;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($column,$label,$class=null,$help=null,$color="primary")
    {
        $this->column = explode(':', $column);
        $this->label = $label;
        $this->class = $class;
        $this->help = $help;
        $this->name = \Str::slug($label);
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.input-date-range');
    }
}
