<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Navbar extends Component
{
    public $link_navbar = [];
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->link_navbar = [
            [
                "name" => "Home",
                "url" => url('backend')
            ],
            [
                "name" => "Profile",
                "url" => url('backend/profile')
            ]
        ];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.navbar');
    }
}
