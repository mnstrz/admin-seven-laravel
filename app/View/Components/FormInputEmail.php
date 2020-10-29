<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormInputEmail extends Component
{
    public $column;
    public $label;
    public $name;
    public $value;
    public $class;
    public $attributes = [];
    public $events = [];
    public $placeholder;
    public $help;

    public $this_events = [];
    public $this_attributes = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($column,$label,$name,$value=null,$attributes=null,$events=null,$placeholder=null,$class=null,$help=null)
    {
        $this->column = explode(':', $column);
        if(!is_array($events)){
            $this_events = [];
            if($events != null){
                $events = explode("&&&", $events);
                foreach ($events as $key => $val) {
                    $val = explode(":", $val);
                    array_push($this_events, $val);
                }
            }
            $this->this_events = $this_events;
        }else{
            $this->this_events = $events;
        }
        if(!is_array($attributes)){
            $this_attributes = [];
            if($attributes != null){
                $attributes = explode("&&&", $attributes);
                foreach ($attributes as $key => $val) {
                    $val = explode(":", $val);
                    array_push($this_attributes, $val);
                }
            }
            $this->this_attributes = $this_attributes;
        }else{
            $this->attributes = $attributes;
        }
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->name = $name;
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
        return view('components.form.input-email');
    }
}
