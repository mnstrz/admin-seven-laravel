<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Group;
use App\Models\Menu;
use App\Models\GroupMenu;
use App\Admin\AdminSevenHelper as AdminSeven;

class BackendMenu extends Component
{
    public $parent = null;
    public $result = '';

    public $name;
    public $icon;
    public $url;
    public $group = [];
    public $list_group = [];
    public $selected_id = null;


	public function mount()
	{
        $this->listData();
	}

	/**
     * @method listRole
     */
    public function listData()
    {
    	$data = Menu::orderBy('sort','asc')->get();

        $menu = [];
        foreach($data as $row){
            $group = [];
            foreach ($row->hasGroup as $key => $r) {
                array_push($group, $r->thisGroup->name);
            }
            $subs = [
                "id" => $row->id,
                "name" => $row->name,
                "url" => $row->url,
                "icon" => $row->icon,
                "parent" => $row->parent,
                "group" => $group,
            ];
            array_push($menu,$subs);
        }
        $treeMenu = AdminSeven::createTreeList($menu);
        if($treeMenu){
            $render_menu = $this->createTreeMenu($treeMenu);
        }else{
            $render_menu = '';
        }
        $this->result = $render_menu;
    }

    /**
     * @method orderMenu
     * @param int $id
     * @param int $change ... id for change order
     */
    public function orderMenu($id,$change)
    {
        $exist = Menu::where("id",$change)->first();
        $new = Menu::where("id",$id)->first();

        $new_order_exist = $new->sort;
        $new_order_new = $exist->sort;

        $exist->sort = $new_order_exist;
        $new->sort = $new_order_new;

        $exist->save();
        $new->save();

        $this->listData();
    }

	/**
     * @method createTreeMenu
     * @param array $items
     */
    public function createTreeMenu($items,$child=null){ 

        $render = "<ul class='tree-menu'>";
        foreach ($items as $key => $row) {
            $name = $row['name'];
            $id = $row['id'];
            $icon = $row['icon'];
            $group = '';
            foreach ($row['group'] as $val) {
                $group .= '<label class="badge badge-primary mr-2">'.$val.'</label>';
            }
            $after = (isset($items[$key+1])) ? $items[$key+1]['id'] : null ;
            $before = (isset($items[$key-1])) ? $items[$key-1]['id'] : null ;

            $orderUp = ($before) ? "<a wire:click='orderMenu($id,$before)' class=title data-tooltip='true' title='Move to Top'>
                                        <i class='fa fa-arrow-up'></i>
                                    </a>" : '';
            $orderDown = ($after) ? "<a wire:click='orderMenu($id,$after)' class=title data-tooltip='true' title='Move to Down'>
                                        <i class='fa fa-arrow-down'></i>
                                    </a>" : '';
            $childIcon = ($row['parent']) ? '<i class="icon feather icon-corner-down-right text-gray-600"></i>' : '';

            if(isset($row['child'])){
                $render .= "<li>
                                $childIcon
                                <i class='$icon'></i>
                                <span>$name</span>
                                <div class=mr-auto>
                                    <a href=#! wire:click='addChild($id)' class=title data-tooltip='true' title='Add Child Menu'>
                                        <i class='fa fa-plus'></i>
                                    </a>
                                    <a data-toggle=modal data-target=#form wire:click='editMenu($id)' class=title title='Edit' data-tooltip='true'>
                                        <i class='fa fa-edit'></i>
                                    </a> 
                                    $orderUp
                                    $orderDown
                                </div>
                                $group
                            </li>
                            <li>
                                <ul class=tree-menu>
                                    ".$this->createTreeMenu($row['child'])."
                                </ul>
                            </li>";
            }else{
                $render .= "<li>
                                $childIcon
                                <i class='$icon'></i>
                                <span>$name</span>
                                <div class=mr-auto>
                                    <a href=#! wire:click='addChild($id)' class='title' title='Add Child Menu' data-tooltip='true'>
                                        <i class='fa fa-plus'></i>
                                    </a>
                                    <a data-toggle=modal data-target=#form wire:click='editMenu($id)' class=title title='Edit' data-tooltip='true'>
                                        <i class='fa fa-edit'></i>
                                    </a> 
                                    <a data-toggle=modal wire:click='deleteMenu($id)' class=title title='Delete' data-tooltip='true'>
                                        <i class='fa fa-trash text-danger'></i>
                                    </a>
                                    $orderUp
                                    $orderDown
                                </div>
                                $group
                            </li>";
            }
        }
        $render .= "</ul>";
        return $render;
    }

    public function addChild($id=null)
    {
        $this->dispatchBrowserEvent('add');
        $this->parent = $id;
        $group = Group::all();
        $list_group = [];
        foreach($group as $key => $value){
            $list_group[$value->id] = $value->name;
        }
        $this->list_group = $list_group;
    }

    public function editMenu($id){

        $this->dispatchBrowserEvent('edit');
        $menu = Menu::find($id);
        $group = [];
        foreach($menu->hasGroup as $key => $value){
            array_push($group, (string) $value->group);
        }

        $this->selected_id = $menu->id;
        $this->name = $menu->name;
        $this->url = $menu->url;
        $this->icon = $menu->icon;
        $this->parent = $menu->parent;
        $this->group = $group;

        $group = Group::all();
        $list_group = [];
        foreach($group as $key => $value){
            $list_group[$value->id] = $value->name;
        }
        $this->list_group = $list_group;
    }

    public function updatedGroup()
    {
        $this->group = $this->group;
    }

    public function resetForm()
    {
        $this->parent = null;
        $this->name = null;
        $this->url = null;
        $this->icon = null;
        $this->group = [];
        $this->list_group = [];
        $this->selected_id = null;
    }

    public function saveMenu()
    {
        $this->validate([
            'name' => 'required|unique:menu,name',
            'icon' => 'required'
        ]);

        # make new sort number
        $current_sort = Menu::max('sort');
        $sort = $current_sort+1;

        $menu = new Menu;
        $menu->name = $this->name;
        $menu->icon = $this->icon;
        $menu->url = $this->url;
        $menu->parent = $this->parent;
        $menu->sort = $sort;
        $menu->save();

        $this->storeGroupMenu($menu);
        $this->dispatchBrowserEvent('close-add');
        $this->resetForm();
        $this->listData();
    }

    public function updateMenu()
    {
        $this->validate([
            'name' => 'required|unique:menu,name,'.$this->selected_id,
            'icon' => 'required'
        ]);

        $menu = Menu::find($this->selected_id);
        $menu->name = $this->name;
        $menu->icon = $this->icon;
        $menu->url = $this->url;
        $menu->save();

        $this->storeGroupMenu($menu);
        $this->dispatchBrowserEvent('close-edit');
        $this->resetForm();
        $this->listData();
    }

    public function storeGroupMenu($menu){

        GroupMenu::where('menu',$menu->id)->delete();

        foreach($this->group as $key => $value){
            $group_menu = new GroupMenu;
            $group_menu->menu = $menu->id;
            $group_menu->group = $value;
            $group_menu->save();
        }

    }

    public function deleteMenu($id)
    {
        $this->selected_id = $id;
        $menu = Menu::find($this->selected_id);

        $this->dispatchBrowserEvent('delete');
    }

    public function cancelDelete()
    {
        $this->selected_id = null;
    }

    public function confirmDelete()
    {
        Menu::where("id",$this->selected_id)->delete();
        $this->resetForm();
        $this->listData();
    }

	public function render()
	{
		return view('livewire.backend.menu');
	}
}
