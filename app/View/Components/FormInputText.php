<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInputText extends Component
{
    public $column;
    public $label;
    public $name;
    public $value;
    public $class;
    public $placeholder;
    public $help;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($column,$label,$class=null,$help=null)
    {
        $this->column = explode(':', $column);
        $this->label = $label;
        $this->class = $class;
        $this->help = $help;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.input-text');
    }
}
