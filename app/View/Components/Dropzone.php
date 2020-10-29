<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Dropzone extends Component
{
    public $path;
    public $current_file;
    public $label;
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($path=null,$current_file=null,$label=null)
    {
        $this->path = $path;
        $this->current_file = $current_file;
        $this->label = $label;
        $this->name = \Str::slug($label);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.form.dropzone');
    }
}
