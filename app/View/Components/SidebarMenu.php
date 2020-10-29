<?php

namespace App\View\Components;

use Illuminate\View\Component;

class SidebarMenu extends Component
{
    public $menu;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->getMenu();
    }

    public function getMenu()
    {
        $menu = [
                    [
                        "url" => route('template.dashboard'),
                        "label" => 'Dashboard',
                        "icon" => 'fas fa-tachometer-alt'
                    ],
                    [
                        "url" => '#',
                        "label" => 'Template',
                        "icon" => 'fas fa-clipboard',
                        "child" => [
                            [
                                "url" => route('template.form'),
                                "label" => 'Form',
                                "icon" => 'far fa-circle'
                            ],
                            [
                                "url" => route('template.table'),
                                "label" => 'Table',
                                "icon" => 'far fa-circle'
                            ]
                        ]
                    ],
                    [
                        "url" => '#',
                        "label" => 'Configurations',
                        "icon" => 'fas fa-cog',
                        "child" => [
                            [
                                "url" => route('backend.theming'),
                                "label" => 'Theme',
                                "icon" => 'fas fa-paint-brush'
                            ],
                            [
                                "url" => route('backend.user'),
                                "label" => 'User',
                                "icon" => 'fas fa-user'
                            ],
                            [
                                "url" => route('backend.group'),
                                "label" => 'Group',
                                "icon" => 'fas fa-users'
                            ]
                        ]
                    ] 
                ];

        $this->menu = $menu;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.sidebar-menu');
    }
}
