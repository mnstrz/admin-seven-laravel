<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Menu;
use App\Models\GroupMenu;

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
        //$this->getMenu();
        $this->createMenu();
    }

    public function createMenu()
    {
        $user = \Auth::guard('admin')->user();
        $group_menu = GroupMenu::join('menu','group_menu.menu','=','menu.id')
                            ->where('group',$user->group)
                            ->orderBy('menu.sort','asc')
                            ->get();
        $menu = [];
        foreach($group_menu as $row){
            $subs = [
                "id" => $row->thisMenu->id,
                "label" => $row->thisMenu->name,
                "url" => url('backend/'.$row->thisMenu->url),
                "icon" => $row->thisMenu->icon,
                "parent" => $row->thisMenu->parent
            ];
            array_push($menu,$subs);
        }
        $treeMenu = \AdminSeven::createTreeList($menu);
        $this->menu = $treeMenu;
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
                                "url" => route('template.form_collective'),
                                "label" => 'Form Collective',
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
                            ],
                            [
                                "url" => route('backend.permission'),
                                "label" => 'Permission',
                                "icon" => 'fas fa-key'
                            ],
                            [
                                "url" => route('backend.menu'),
                                "label" => 'Menu',
                                "icon" => 'fas fa-list'
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
