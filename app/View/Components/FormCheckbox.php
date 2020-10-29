<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormCheckbox extends Component
{
    public $column;
    public $label;
    public $class;
    public $help;
    public $options=[];
    public $color;
    public $value;
    public $name;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($column,$label,$class=null,$help=null,$options=null,$color="primary",$value=null)
    {
        $this->column = explode(':', $column);
        $this->label = $label;
        $this->value = $value;
        $this->class = $class;
        $this->help = $help;
        $this->color = $color;
        $this->options = $options;
        $this->name = \Str::slug($label);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.checkbox');
    }
}
