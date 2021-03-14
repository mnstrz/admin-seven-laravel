<?php

namespace App\Http\Livewire\Creator;

use Livewire\Component;
use App\Models\AdminSevenCrudModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AdminSevenFormCreator extends Component
{
	public $title = 'New';
	public $primary_id = null;
	public $crud_name = null;
	public $crud_slug = null;
	public $model = null;
	public $attributes = [];
	public $updated_id = [];
	public $warning = [];
	public $type = [
					 "inputText" => "Text",
					 "inputEmail" => "Email",
					 "inputPassword" => "Password",
					 "inputNumber" => "Number",
					 "selectOption" => "Combo Box",
					 "selectRadio" => "Radio",
					 "selectCheckbox" => "Checkbox",
					 "inputTextarea" => "Textarea",
					 "inputDate" => "Date",
					 "inputTime" => "Time",
					 "inputDatetime" => "Date and Time",
					 "inputDaterange" => "Date Range",
					 "inputDatetimerange" => "Date and Time Range",
					 "inputColor" => "Color",
					 "uploadFile" => "File",
					 "uploadImage" => "Image",
					 "inputTextEditor" => "Text Editor",
					 "inputTextCode" => "Text Code",
				   ];
	public $selected_column_add = null;
	public $selected_column_edit = null;
	public $tab = 'general';

	public function mount()
	{
		\AdminSeven::backendGate('authorize','creator');
		$primary_id = \Request::segment(4);
		if($primary_id){
			$this->primary_id = $primary_id;
			$this->getData();
			$this->title = 'Edit';
		}
	}

	public function getData(){
		$data = AdminSevenCrudModel::where('id',$this->primary_id)->first();
		if(!$data){
			abort('404');
		}
		$data = $data->toArray();
		$attributes = collect(json_decode(base64_decode($data['attributes']),true))->toArray();

		$this->crud_name = $data['crud_name'];
		$this->model = $data['model'];
		$this->attributes = $attributes;
	}

	public function updatedModel()
	{
		$model = str_replace(".",'\\', $this->model);
		$model = 'App\\'.$model;
		if(!class_exists($model)){
			$this->warning = ["model"=>"Model Not Found!"];
		}else{
			$this->warning = [];
			$this->attributes = [
									"column_add" => [], 
									"column_edit" => [],
									"edit_same_as_create" => true,
									"add_setting" => [
										"before_store" => "",
										"before_add" => "",
										"after_store" => "",
										"after_add" => "",
									],
									"edit_setting" => [
										"before_update" => "",
										"before_edit" => "",
										"after_udpate" => "",
										"adter_edit" => ""
									],
									"show_setting" => [
										"before_show" => "",
										"after_show" => ""
									],
									"list_setting" => [
										"before_list" => "",
										"after_list" => ""
									],
									"general" => [
										"can_add" => true,
										"can_edit" => true,
										"can_show" => true,
										"can_delete" => true,
										"custom_action" => [],
										"form_width" => 12,
										"show_width" => 12,
										"url_permission" => false,
										"javascript" => ($this->crud_name) ? "activeMenu('".$this->crud_name."')" : "",
										"with_filter" => true,
										"per_page" => 10,
										"list_per_page" => "10,20,50,100"
									],
									"list" => [],
									"show" => [],
									"filter" => [],
									"list_relation" => "",
									"show_relation" => "",
									"order_by" => ""
								];
		}
	}

	public function autoCreateColumn()
	{
		if(!$this->model){
			$this->warning = ["model"=>"Model Not Exists!"];
			return false;
		}
		$model = str_replace(".",'\\', $this->model);
		$model = 'App\\'.$model;
		if(!class_exists($model)){
			$this->warning = ["model"=>"Model Not Found!"];
			return false;
		}

		$data = new $model;
		$table = $data->getTable();

		$columns = DB::getSchemaBuilder()->getColumnListing($table);

		$column_add = [];
		$list = [];
		$show = [];
		$filter = [];

		foreach($columns as $column){

			$label = str_replace("_", " ",$column);
			$label = str_replace("-", " ",$label);
			$label = \Str::title($label);

			#autocreate form
			if($column != 'id' && $column != 'created_at' && $column != 'updated_at'){
				$sub = [
					"field" => $column,
					"label" => $label,
					"type" => "inputText",
					"relation_text" => null,
					"relation" => [],
					"options" => [],
					"options_text" => null,
					"validate" => null,
					"column_text" => "3,9",
					"column" => [3,9],
					"info" => null,
					"value" => null,
					"placeholder" => $label,
					"event_text" => "",
					"event" => [],
					"upload_dir" => null,
					"image_setting_text" => "",
					"image_setting" => [],
					"path" => null,
					"ignore" => false,
					"multifile" => false
				];
				array_push($column_add,$sub);
			}

			#autocreate list
			$sub = [
				"field" => $column,
				"label" => $label,
				"format" => "",
				"image" => false,
				"file" => false,
				"badge" => null,
				"options_text" => null,
				"options" => []
			];
			array_push($list, $sub);

			#autocreate show
			$sub = [
				"field" => $column,
				"label" => $label,
				"format" => null,
				"file" => false,
				"image" => false,
				"badge" => null,
				"options_text" => null,
				"options" => []
			];
			array_push($show, $sub);

			#autocreate filter
			$sub = [
				"field" => $column,
				"label" => $label,
				"operator" => "=",
				"type" => "inputText",
				"relation_text" => null,
				"relation" => [],
				"options_text" => null,
				"options" => []
			];
			array_push($filter, $sub);
		}
		$this->attributes["column_add"] = $column_add;
		$this->attributes["list"] = $list;
		$this->attributes["show"] = $show;
		$this->attributes["filter"] = $filter;
	}

	public function changeTab($tab){
		$this->tab = $tab;
	}

	public function updatedAttributes(){
		if($this->attributes['edit_same_as_create'] !== false){
			$this->attributes['column_edit'] = [];
			$this->selected_column_edit = null;
		}
	}

	public function uncheckSameAsEdit(){
		$this->attributes['edit_same_as_create'] = false;
	}

	public function openSettingAdd($key)
	{
		$this->selected_column_add = $key;
	}

	public function openSettingEdit($key)
	{
		$this->selected_column_edit = $key;
	}

	public function copyForm()
	{
		$this->uncheckSameAsEdit();
		$this->attributes['column_edit'] = $this->attributes['column_add'];
	}

	public function addColumnAdd()
	{
		$column_add = $this->attributes['column_add'] ?? [];
		$new = [
					"field" => null,
					"label" => null,
					"type" => "inputText",
					"relation_text" => null,
					"relation" => [],
					"options" => [],
					"options_text" => null,
					"validate" => null,
					"column_text" => "3,9",
					"column" => [3,9],
					"info" => null,
					"value" => null,
					"placeholder" => null,
					"event" => [],
					"upload_dir" => null,
					"image_setting_text" => null,
					"image_setting" => [],
					"path" => null,
					"ignore" => false,
					"multifile" => false
				];
		array_push($column_add, $new);
		$this->attributes['column_add'] = $column_add;
	}

	public function addColumnEdit()
	{
		$this->uncheckSameAsEdit();
		$column_edit = $this->attributes['column_edit'] ?? [];
		$new = [
					"field" => null,
					"label" => null,
					"type" => "inputText",
					"relation_text" => null,
					"relation" => [],
					"options" => [],
					"options_text" => null,
					"validate" => null,
					"column_text" => "3,9",
					"column" => [3,9],
					"info" => null,
					"value" => null,
					"placeholder" => null,
					"event" => [],
					"upload_dir" => null,
					"image_setting_text" => null,
					"image_setting" => [],
					"path" => null,
					"ignore" => false,
					"multifile" => false
				];
		array_push($column_edit, $new);
		$this->attributes['column_edit'] = $column_edit;
	}

	public function addList()
	{
		$list = $this->attributes['list'] ?? [];
		$new = [
			"field" => "",
			"label" => "",
			"format" => "",
			"image" => false,
			"file" => false,
			"badge" => null,
			"options" => [],
			"options_text" => null,
		];
		array_push($list, $new);
		$this->attributes['list'] = $list;
	}

	public function addFilter()
	{
		$filter = $this->attributes['filter'] ?? [];
		$new = [
			"field" => "",
			"label" => "",
			"operator" => "=",
			"type" => "inputText",
			"relation_text" => null,
			"relation" => [],
			"options_text" => null,
			"options" => []
		];
		array_push($filter, $new);
		$this->attributes['filter'] = $filter;
	}

	public function addShow()
	{
		$show = $this->attributes['show'] ?? [];
		$new = [
			"field" => "",
			"label" => "",
			"format" => "",
			"image" => false,
			"file" => false,
			"badge" => null,
			"options" => [],
			"options_text" => null,
		];
		array_push($show, $new);
		$this->attributes['show'] = $show;
	}

	public function moveColumnAdd($key,$target)
	{
		if($target == 'up'){
			if($key == 0){
				$this->warning = ['move' => "Can't move to above!"];
				return false;
			}
			if(!isset($this->attributes['column_add'][$key-1])){
				$this->warning = ['move' => "Can't move to above!"];
				return false;
			}
			$old = $this->attributes['column_add'][$key-1];
			$this->attributes['column_add'][$key-1] = $this->attributes['column_add'][$key];
			$this->attributes['column_add'][$key] = $old;
		}else{
			$length = count($this->attributes['column_add']);
			if($key >= $length-1){
				$this->warning = ['move' => "Can't move to below!"];
				return false;
			}
			if(!isset($this->attributes['column_add'][$key+1])){
				$this->warning = ['move' => "Can't move to below!"];
				return false;
			}
			$old = $this->attributes['column_add'][$key+1];
			$this->attributes['column_add'][$key+1] = $this->attributes['column_add'][$key];
			$this->attributes['column_add'][$key] = $old;
		}
	}

	public function moveColumnEdit($key,$target)
	{
		if($target == 'up'){
			if($key == 0){
				$this->warning = ['move' => "Can't move to above!"];
				return false;
			}
			if(!isset($this->attributes['column_edit'][$key-1])){
				$this->warning = ['move' => "Can't move to above!"];
				return false;
			}
			$old = $this->attributes['column_edit'][$key-1];
			$this->attributes['column_edit'][$key-1] = $this->attributes['column_edit'][$key];
			$this->attributes['column_edit'][$key] = $old;
		}else{
			$length = count($this->attributes['column_edit']);
			if($key >= $length-1){
				$this->warning = ['move' => "Can't move to below!"];
				return false;
			}
			if(!isset($this->attributes['column_edit'][$key+1])){
				$this->warning = ['move' => "Can't move to below!"];
				return false;
			}
			$old = $this->attributes['column_edit'][$key+1];
			$this->attributes['column_edit'][$key+1] = $this->attributes['column_edit'][$key];
			$this->attributes['column_edit'][$key] = $old;
		}
	}

	public function moveList($key,$target)
	{
		if($target == 'up'){
			if($key == 0){
				$this->warning = ['move' => "Can't move to Top!"];
				return false;
			}
			if(!isset($this->attributes['list'][$key-1])){
				$this->warning = ['move' => "Can't move to above!"];
				return false;
			}
			$old = $this->attributes['list'][$key-1];
			$this->attributes['list'][$key-1] = $this->attributes['list'][$key];
			$this->attributes['list'][$key] = $old;
		}else{
			$length = count($this->attributes['list']);
			if($key >= $length-1){
				$this->warning = ['move' => "Can't move to Top!"];
				return false;
			}
			if(!isset($this->attributes['list'][$key+1])){
				$this->warning = ['move' => "Can't move to below!"];
				return false;
			}
			$old = $this->attributes['list'][$key+1];
			$this->attributes['list'][$key+1] = $this->attributes['list'][$key];
			$this->attributes['list'][$key] = $old;
		}
	}

	public function moveShow($key,$target)
	{
		if($target == 'up'){
			if($key == 0){
				$this->warning = ['move' => "Can't move to Top!"];
				return false;
			}
			if(!isset($this->attributes['show'][$key-1])){
				$this->warning = ['move' => "Can't move to above!"];
				return false;
			}
			$old = $this->attributes['show'][$key-1];
			$this->attributes['show'][$key-1] = $this->attributes['show'][$key];
			$this->attributes['show'][$key] = $old;
		}else{
			$length = count($this->attributes['show']);
			if($key >= $length-1){
				$this->warning = ['move' => "Can't move to Top!"];
				return false;
			}
			if(!isset($this->attributes['show'][$key+1])){
				$this->warning = ['move' => "Can't move to below!"];
				return false;
			}
			$old = $this->attributes['show'][$key+1];
			$this->attributes['show'][$key+1] = $this->attributes['show'][$key];
			$this->attributes['show'][$key] = $old;
		}
	}

	public function moveFilter($key,$target)
	{
		if($target == 'up'){
			if($key == 0){
				$this->warning = ['move' => "Can't move to Top!"];
				return false;
			}
			if(!isset($this->attributes['filter'][$key-1])){
				$this->warning = ['move' => "Can't move to above!"];
				return false;
			}
			$old = $this->attributes['filter'][$key-1];
			$this->attributes['filter'][$key-1] = $this->attributes['filter'][$key];
			$this->attributes['filter'][$key] = $old;
		}else{
			$length = count($this->attributes['filter']);
			if($key >= $length-1){
				$this->warning = ['move' => "Can't move to Top!"];
				return false;
			}
			if(!isset($this->attributes['filter'][$key+1])){
				$this->warning = ['move' => "Can't move to below!"];
				return false;
			}
			$old = $this->attributes['filter'][$key+1];
			$this->attributes['filter'][$key+1] = $this->attributes['filter'][$key];
			$this->attributes['filter'][$key] = $old;
		}
	}

	public function removeColumnAdd($key)
	{
		$column_add = $this->attributes['column_add'];
		unset($column_add[$key]);
		$new_column_add = [];
		foreach ($column_add as $key => $row) {
			array_push($new_column_add, $row);
		}
		$this->attributes['column_add'] = $new_column_add;
	}

	public function removeColumnEdit($key)
	{
		$column_edit = $this->attributes['column_edit'];
		unset($column_edit[$key]);
		$new_column_edit = [];
		foreach ($column_edit as $key => $row) {
			array_push($new_column_edit, $row);
		}
		$this->attributes['column_edit'] = $new_column_edit;
	}

	public function removeList($key)
	{
		$list = $this->attributes['list'];
		unset($list[$key]);

		$new_list = [];
		foreach ($list as $key => $row) {
			array_push($new_list, $row);
		}

		$this->attributes['list'] = $new_list;
	}

	public function removeShow($key)
	{
		$show = $this->attributes['show'];
		unset($show[$key]);

		$new_show = [];
		foreach ($show as $key => $row) {
			array_push($new_show, $row);
		}

		$this->attributes['show'] = $new_show;
	}

	public function removeFilter($key)
	{
		$filter = $this->attributes['filter'];
		unset($filter[$key]);

		$new_filter = [];
		foreach ($filter as $key => $row) {
			array_push($new_filter, $row);
		}
		$this->attributes['filter'] = $new_filter;
	}

	public function saveCreator()
	{
		$this->validate([
			"crud_name" => 'required|unique:admin_seven_crud,crud_name',
			"model" => 'required'
		]);
		$crud_name = $this->crud_name;
		$model = $this->model;
		$this->convertTextSettingToArray();
		$attributes = base64_encode(json_encode($this->attributes));
		$updated_id = \Auth::guard('admin')->user()->id;

		$creator = new AdminSevenCrudModel;
		$creator->crud_name = $crud_name;
		$creator->model = $model;
		$creator->attributes = $attributes;
		$creator->updated_id = $updated_id;
		$creator->save();

		return redirect()->route('backend.creator');
	}

	public function editCreator()
	{
		$this->validate([
			"crud_name" => 'required|unique:admin_seven_crud,crud_name,'.$this->primary_id,
			"model" => 'required'
		]);
		$crud_name = $this->crud_name;
		$model = $this->model;
		$this->convertTextSettingToArray();
		$attributes = base64_encode(json_encode($this->attributes));
		$updated_id = \Auth::guard('admin')->user()->id;

		$creator = AdminSevenCrudModel::where('id',$this->primary_id)->first();
		if(!$creator){
			$this->warning = 'Creator not found!';
			return false;
		}
		$creator->crud_name = $crud_name;
		$creator->model = $model;
		$creator->attributes = $attributes;
		$creator->updated_id = $updated_id;
		$creator->save();

		return redirect()->route('backend.creator');
	}

	protected function convertTextSettingToArray()
	{
		$this->convertText('column_add','column_text','column');
		$this->convertText('column_add','options_text','options');
		$this->convertText('column_add','image_setting_text','image_setting');
		$this->convertText('column_edit','column_text','column');
		$this->convertText('column_edit','options_text','options');
		$this->convertText('column_edit','image_setting_text','image_setting');
		$this->convertText('list','options_text','options');
		$this->convertText('show','options_text','options');
		$this->convertText('filter','options_text','options');
	}

	protected function convertText($type,$text,$array){
		$attributes = $this->attributes;
		foreach($attributes[$type] as $key => $column){
			if($column[$text] != null || $column[$text] != ""){
				$json = "[".$column[$text]."]";
				$data = json_decode($json,true);
				$new_data = [];
				foreach($data as $row){
					if(is_array($row)){
						$new_data[key($row)] = $row[key($row)];
					}else{
						array_push($new_data,$row);
					}
				}
				$attributes[$type][$key][$array] = $new_data;
			}else{
				$attributes[$type][$key][$array] = [];
			}
		}
		$this->attributes = $attributes;
	}

    public function render()
    {
        return view('livewire.backend.creator.form');
    }
}
