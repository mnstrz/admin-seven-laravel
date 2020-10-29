<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Theme;

class Card extends Component
{
    public $title = '';
    public $color = '';
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title=null,$color=null)
    {
        $this->title = $title;
        if($color == null){
            if(Theme::first()){
                if(Theme::first()->card_skin){
                    $this->color = Theme::first()->card_skin;
                }
            }
        }else{
            $this->color = $color;
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.card');
    }
}
