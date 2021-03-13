<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Documentation;
use App\Admin\AdminSevenHelper as AdminSeven;

class BackendDocumentation extends Component
{
    public $parent = null;
    public $result = '';

    public $name;
    public $title;
    public $next;
    public $prev;
    public $list_other = [];
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
    	$data = Documentation::orderBy('sort','asc')->get();

        $menu = [];
        foreach($data as $row){
            $subs = [
                "id" => $row->id,
                "name" => $row->name,
                "title" => $row->title,
                "parent" => $row->parent,
                "next" => $row->next,
                "prev" => $row->prev
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
        $exist = Documentation::where("id",$change)->first();
        $new = Documentation::where("id",$id)->first();

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
            $title = $row['title'];
            $next = $row['next'];
            $prev = $row['prev'];

            $after = (isset($items[$key+1])) ? $items[$key+1]['id'] : null ;
            $before = (isset($items[$key-1])) ? $items[$key-1]['id'] : null ;

            $orderUp = ($before) ? "<a wire:click='orderMenu($id,$before)' class=title data-tooltip='true' title='Move to Top'>
                                        <i class='fa fa-arrow-up'></i>
                                    </a>" : '';
            $orderDown = ($after) ? "<a wire:click='orderMenu($id,$after)' class=title data-tooltip='true' title='Move to Down'>
                                        <i class='fa fa-arrow-down'></i>
                                    </a>" : '';
            $childIcon = ($row['parent']) ? '<i class="fas fa-angle-right"></i>' : '';

            if(isset($row['child'])){
                $render .= "<li class=mb-1>
                                $childIcon
                                <span>$name</span>
                                <div class=mr-auto>
                                    <a href='".route('backend.documentation.editor',[$id])."' class=title data-tooltip='true' title='Edit Documentation'>
                                        <i class='fas fa-book'></i>
                                    </a>
                                    <a href=#! wire:click='addChild($id)' class=title data-tooltip='true' title='Add Child Documentation'>
                                        <i class='fa fa-plus'></i>
                                    </a>
                                    <a data-toggle=modal data-target=#form wire:click='editMenu($id)' class=title title='Edit' data-tooltip='true'>
                                        <i class='fa fa-edit'></i>
                                    </a> 
                                    $orderUp
                                    $orderDown
                                </div>
                            </li>
                            <li>
                                <ul class=tree-menu>
                                    ".$this->createTreeMenu($row['child'])."
                                </ul>
                            </li>";
            }else{
                $render .= "<li class=mb-1>
                                $childIcon
                                <span>$name</span>
                                <div class=mr-auto>
                                    <a href='".route('backend.documentation.editor',[$id])."' class=title data-tooltip='true' title='Edit Documentation'>
                                        <i class='fas fa-book'></i>
                                    </a>
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
                            </li>";
            }
        }
        $render .= "</ul>";
        return $render;
    }

    public function addChild($id=null)
    {
        $this->resetForm();
        $this->parent = $id;
        $documentation = Documentation::all();
        $list_other = [];
        $list_other[0] = 'None';
        foreach($documentation as $key => $value){
            $list_other[$value->id] = $value->name;
        }
        $this->list_other = $list_other;
        $this->dispatchBrowserEvent('add');
    }

    public function editMenu($id){
        $this->resetForm();
        $doc = Documentation::find($id);
        $this->selected_id = $doc->id;
        $this->name = $doc->name;
        $this->title = $doc->title;
        $this->parent = $doc->parent;
        $this->next = $doc->next;
        $this->prev = $doc->prev;
        $documentation = Documentation::where('id','!=',$id)->get();
        $list_other = [];
        $list_other[0] = 'None';
        foreach($documentation as $key => $value){
            $list_other[$value->id] = $value->name;
        }
        $this->list_other = $list_other;
        $this->dispatchBrowserEvent('edit');
    }

    public function resetForm()
    {
        $this->parent = null;
        $this->name = null;
        $this->title = null;
        $this->next = null;
        $this->prev = null;
        $this->selected_id = null;
    }

    public function saveMenu()
    {
        $this->validate([
            'name' => 'required',
            'title' => 'required'
        ]);

        # make new sort number
        $current_sort = Documentation::max('sort');
        $sort = $current_sort+1;

        $menu = new Documentation;
        $menu->name = $this->name;
        $menu->title = $this->title;
        $menu->next = ($this->next != 0) ? $this->next : null;
        $menu->prev = ($this->prev != 0) ? $this->prev : null;
        $menu->parent = $this->parent;
        $menu->sort = $sort;
        $menu->save();

        $this->dispatchBrowserEvent('close-add');
        $this->resetForm();
        $this->listData();
    }

    public function updateMenu()
    {
        $this->validate([
            'name' => 'required',
            'title' => 'required'
        ]);

        $menu = Documentation::find($this->selected_id);
        $menu->name = $this->name;
        $menu->title = $this->title;
        $menu->next = ($this->next != 0) ? $this->next : null;
        $menu->prev = ($this->prev != 0) ? $this->prev : null;
        $menu->save();

        $this->dispatchBrowserEvent('close-edit');
        $this->resetForm();
        $this->listData();
    }

    public function deleteMenu($id)
    {
        $this->selected_id = $id;
        $menu = Documentation::find($this->selected_id);

        $this->dispatchBrowserEvent('delete');
    }

    public function cancelDelete()
    {
        $this->selected_id = null;
    }

    public function confirmDelete()
    {
        Documentation::where("id",$this->selected_id)->delete();
        $this->resetForm();
        $this->listData();
    }

	public function render()
	{
		return view('livewire.backend.documentation');
	}
}
