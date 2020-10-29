<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TableData extends Component
{
    public $class;
    public $id;
    public $position;
    public $height = 300;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($class=null,$position=null,$height=null)
    {
        $id = rand(100,999).date('ymdhis');

        $this->class = $class;
        $this->id = $id;
        $this->height = $height;
        switch ($position) {
            case 'center':
                $this->position = 'center';
            break;
            case 'left':
                $this->position = 'start';
            break;
            case 'right':
                $this->position = 'end';
            break;
            default:
                $this->position = 'center';
            break;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.table.data');
    }
}
