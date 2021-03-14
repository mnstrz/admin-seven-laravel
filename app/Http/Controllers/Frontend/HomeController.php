<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Documentation;

class HomeController extends Controller
{
    /**
     * homepage
     * @method index
     * @return view
     */
    public function index()
    {
    	$title = 'Documentation';
        $data = Documentation::all()->toArray();
        data_set($data,'*.created_at','2021-01-01 00:00:00');
        data_set($data,'*.updated_at','2021-01-01 00:00:00');
        return response()->json($data);
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
        $treeMenu = \AdminSeven::createTreeList($menu);
        $render_menu = $this->createMenu($treeMenu);

    	$response = [
    		'title','menu','render_menu'
    	];
    	return view('frontend.index',compact($response));
    }

    /**
     * getcontent
     * @method getDocumentation
     * @return json
     */
    public function getDocumentation(Request $r){
        $documentation = Documentation::find($r->id);
        $response = [
            "content" => $documentation->content,
            "next" => $documentation->next,
            "next_page" =>  ($documentation->nextPage) ? $documentation->nextPage->name : null,
            "prev" => $documentation->prev,
            "prev_page" => ($documentation->prevPage) ? $documentation->prevPage->name : null
        ];
        return response()->json($response);
    }

    protected function createMenu($items,$parent=null)
    {
        $show = ($parent === null) ? 'show' : '';
        $menu_id = ($parent !== null) ? "id='menu_$parent'" : '';
        $render = "<ul class='parent $show' $menu_id>";
        foreach ($items as $key => $row) {
            $id     = $row['id'];
            $name   = $row['name'];
            $slug   = \Str::slug($name);

            if(isset($row['child'])){
                $render .= "<li class=child>
                                <a href=#!$slug class=menu data-parent=$id data-id=$id>$name</a>
                                ".$this->createMenu($row['child'],$id)."
                            </li>
                            ";
            }else{
                $render .= "<li class=child>
                                <a href=#!$slug class=menu data-id=$id>$name</a>
                            </li>
                           ";
            }
        }
        $render .= "</ul>";
        return $render;
    }
}
