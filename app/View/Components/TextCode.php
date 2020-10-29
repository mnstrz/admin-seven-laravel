<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TextCode extends Component
{
    public $column;
    public $label;
    public $name;
    public $value;
    public $class;
    public $placeholder;
    public $help;
    public $id;

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
        $this->id = \Str::slug($label);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.text-code');
    }
}
