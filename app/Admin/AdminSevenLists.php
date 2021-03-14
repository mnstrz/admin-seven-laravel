<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait AdminSevenLists{

	public $lists_fields = [];
	public $lists_relations = [];
	public $order_by = [];
	public $results = [];

	public $can_add = true;
	public $can_edit = true;
	public $can_delete = true;
	public $can_show = true;
	public $custom_action = [];
	public $action = false;

	/**
	 * set to list
	 *
	 * @method lists
	 * @return void
	 */
	public function lists()
	{
		$this->closeMessage();
		$this->resetForm();
		$this->view = 'list';
		$this->dispatchBrowserEvent('show-tooltip');
	}

	/**
	 * set fields
	 * @method setLists
	 * @return void
	 */
	protected function setLists(){

		$data = new $this->model;
		$table = $data->getTable();

		$columns = DB::getSchemaBuilder()->getColumnListing($table);
		if($columns){
			$fields = $this->lists_fields;
			foreach ($columns as $key => $value) {
				$name = str_replace("_", " ",$value);
				$name = str_replace("-", " ",$name);
				$name = \Str::title($name);
				if($value != "id" && $value != 'created_at' && $value != 'updated_at'){
					$this->listField($value,$name);
				}
			}
		}
	}

	/**
	 * set list relation table
	 * @method listRelationTo
	 * @param string $relation
	 * @return void
	 */
	protected function listRelationTo($relation)
	{
		$relations = $this->lists_relations;
		array_push($relations, $relation);
		$this->lists_relations = $relations;

		return $this;
	}

	/**
	 * set lists field
	 * @method listField
	 * @param string field_name
	 * @param string label_name
	 * @param string relation
	 * @return void
	 */
	protected function listField($field_name,$label_name=null)
	{
		$fields = $this->lists_fields;
		if(!$label_name){
			$label_name = str_replace("_", " ",$field_name);
			$label_name = str_replace("-", " ",$label_name);
			$label_name = \Str::title($label_name);
		}
		$new_lists = [
			"field" => \Str::snake($field_name),
			"label" => $label_name,
			"format" => "",
			"image" => false,
			"file" => false,
			"badge" => null,
			"options" => []
		];
		array_push($fields, $new_lists);
		$this->lists_fields = $fields;

		return $this;
	}

	/**
	 * set format of lists
	 * @method listFormat
	 * @return void
	 */
	protected function listFormat($method)
	{
		$fields = $this->lists_fields;
		$length = count($fields);
		$fields[$length-1]['format'] = $method;
		$this->lists_fields = $fields;

		return $this;
	}

	/**
	 * set file of lists
	 * @method listFile
	 * @return void
	 */
	protected function listFile()
	{
		$fields = $this->lists_fields;
		$length = count($fields);
		$fields[$length-1]['file'] = true;
		$this->lists_fields = $fields;

		return $this;
	}

	/**
	 * set image of lists
	 * @method listImage
	 * @return void
	 */
	protected function listImage()
	{
		$fields = $this->lists_fields;
		$length = count($fields);
		$fields[$length-1]['image'] = true;
		$this->lists_fields = $fields;

		return $this;
	}

	/**
	 * set badge of lists
	 * @method listBadge
	 * @return void
	 */
	protected function listBadge($variant=null)
	{
		if(!$variant){
			$variant = \AdminSeven::accentSkin();
			$variant = str_replace('bg-','', $variant);
		}
		$fields = $this->lists_fields;
		$length = count($fields);
		$fields[$length-1]['badge'] = $variant;
		$this->lists_fields = $fields;

		return $this;
	}

	/**
	 * set options of lists
	 * @method listOptions
	 * @return void
	 */
	protected function listOptions($options)
	{
		$fields = $this->lists_fields;
		$length = count($fields);
		$fields[$length-1]['options'] = $options;
		$this->lists_fields = $fields;

		return $this;
	}

	public function listOptionResult($field,$value){
		$options = $this->getListSetting($field)['options'];
		foreach($options as $key => $option) {
			if(is_array($option)){
				if($value == $option[0]){
					return $option[1];
				}
			}else{
				if($value == $option){
					return $option;
				}
			}
		}
	}

	public function getListSetting($field){
		foreach ($this->lists_fields as $key => $row) {
			if($row['field'] == $field){
				return $row;
			}
		}
	}

	/**
	 * get lists data
	 * @return void
	 */
	protected function getData()
	{
		$this->beforeShowList();
		$this->showingList();
		$this->afterShowList();
	}

	public function showingList(){
		if(isset($this->model))
		{

			$data = $this->model::query();
			foreach($this->lists_relations as $relation){
				if($relation != null || $relation != ""){
					$data = $data->with($relation);
				}
			}
			foreach($this->filters as $key => $row){
				if(is_array($row)){
					foreach ($row as $field => $value) {
						$data = $this->getRelation($data,$key,$field,$value,$key);
					}
				}else{
					$operator = $this->operator($key);
					if($row != null && $row != '' && $row != 'all'){
						switch ($operator) {
							case 'like':
							case 'ilike':
								$data = $data->where($key,$operator,'%'.$row.'%');
								break;
							
							default:
								$data = $data->where($key,$operator,$row);
								break;
						}
					}
				}
			}
			$data = $this->addQuery($data);
			#order by
			if(count($this->order_by) > 0){
				foreach($this->order_by as $order) {
					$data = $data->orderBy($order['field'],$order['sort']);
				}
			}
			$data = $data->paginate($this->per_page,['*'],"page",$this->page)
						 ->toArray();
			$this->results = $data['data'];

			$this->createPagination($data);
		}
	}

	/**
	 * filter relation
	 *
	 * get filter relation
	 * @method getRelation
	 * @param object $data
	 * @param array $row
	 * @return object
	 */
	protected function getRelation($data,$relation,$field,$value,$keyOperator)
	{
		$data->whereHas($relation,function($q) use ($data,$relation,$field,$value,$keyOperator){
			if(is_array($value)){
				foreach ($value as $subfield => $subvalue) {
					$this->getRelation($q,$value,$subfield,$subvalue,$keyOperator.".".$subfield);
				}
			}else{
				$operator = $this->operator($keyOperator.".".$field);
				if($value != null && $value != '' && $value != 'all'){
					switch ($operator) {
						case 'like':
						case 'ilike':
							$q = $q->where($field,$operator,'%'.$value.'%');
							break;
						
						default:
							$q = $q->where($field,$operator,$value);
							break;
					}
				}
			}
		});
		return $data;
	}


	/**
	 * get operator
	 * @method operator
	 * @param string $name
	 * @return string
	 */
	protected function operator($name){
		foreach($this->filter_fields as $row){
			if($row['field'] == $name){
				return ($row['operator']) ? $row['operator'] : "=";
			}
		}
	}

	/**
	 * set action when pagination reload
	 * @param reloadPage
	 * @return void
	 */
	public function reloadPage()
	{
		$this->getData();
	}

	/**
	 * before show lists
	 *
	 * @method beforeShowList
	 * @return void
	 */
	public function beforeShowList($script=null)
	{
	}

	/**
	 * before show lists
	 *
	 * @method afterShowList
	 * @return void
	 */
	public function afterShowList($script=null)
	{
	}

	/**
	 * add Query
	 *
	 * @method addQuery
	 * @return void
	 */
	public function addQuery($data)
	{
		return $data;
	}

	/**
	 * set action
	 *
	 * @method setAction
	 * @return void
	 */
	public function setAction()
	{

	}


	/**
	 * check action
	 *
	 * @method checkActions
	 * @return void
	 */
	protected function checkActions()
	{
		if($this->can_edit){
			$this->action = true;
		}
		if($this->can_delete){
			$this->action = true;
		}
		if($this->can_show){
			$this->action = true;
		}
		if(count($this->custom_action) > 0){
			$this->action = true;
		}
	}

	/**
	 * add action
	 * @method addAction
	 * @param string title
	 * @return void
	 */
	protected function addAction($title)
	{
		$custom_action = $this->custom_action;
		$new_action = [
			"title" => $title,
			"event" => "noAction",
			"icon" => null,
			"label" => null,
			"link" => null,
			"field" => null,
			"color" => null
		];
		array_push($custom_action, $new_action);
		$this->custom_action = $custom_action;

		return $this;
	}

	/**
	 * add icon action 
	 * @method actionIcon
	 * @param string title
	 * @return void
	 */
	protected function actionIcon($name)
	{
		$custom_action = $this->custom_action;
		$length = count($custom_action);
		$custom_action[$length-1]['icon'] = $name;
		$this->custom_action = $custom_action;

		return $this;
	}

	/**
	 * add event action
	 * @method actionEvent
	 * @param string title
	 * @return void
	 */
	protected function actionEvent($name)
	{
		$custom_action = $this->custom_action;
		$length = count($custom_action);
		$custom_action[$length-1]['event'] = $name;
		$this->custom_action = $custom_action;

		return $this;
	}

	/**
	 * add label action
	 * @method actionEvent
	 * @param string title
	 * @return void
	 */
	protected function actionLabel($name)
	{
		$custom_action = $this->custom_action;
		$length = count($custom_action);
		$custom_action[$length-1]['label'] = $name;
		$this->custom_action = $custom_action;

		return $this;
	}

	/**
	 * add field action
	 * @method actionEvent
	 * @param string title
	 * @return void
	 */
	protected function actionField($name)
	{
		$custom_action = $this->custom_action;
		$length = count($custom_action);
		$custom_action[$length-1]['field'] = $name;
		$this->custom_action = $custom_action;

		return $this;
	}

	/**
	 * add color action
	 * @method actionColor
	 * @param string title
	 * @return void
	 */
	protected function actionColor($name)
	{
		$custom_action = $this->custom_action;
		$length = count($custom_action);
		$custom_action[$length-1]['color'] = $name;
		$this->custom_action = $custom_action;

		return $this;
	}

	/**
	 * add link action
	 * @method actionLink
	 * @param string title
	 * @return void
	 */
	protected function actionLink($name,$target=null)
	{
		$custom_action = $this->custom_action;
		$length = count($custom_action);
		$link = ($target) ? $name."|".$target : $name;
		$custom_action[$length-1]['link'] = $link;
		$this->custom_action = $custom_action;

		return $this;
	}

	/**
	 * set no action
	 * @method noAction
	 * @param string $id
	 * @param string $field
	 * @return void
	 */
	public function noAction($id,$field)
	{

	}

	/**
	 * delete
	 * @method delete
	 * @param int $id
	 */
	public function delete($id)
	{
		if(!$this->can_delete){
			abort('403');
		}
		$this->closeMessage();

		$this->selected_primary_key = $id;
		$data = $this->model::where($this->primary_key,$this->selected_primary_key)->first();
		if($data){
			$this->dispatchBrowserEvent('confirm-delete');
		}else{
			$this->showMessage('danger','Data not found !');
		}
	}

	/**
	 * cancel delete
	 * @method cancelDelete
	 */
	public function cancelDelete()
	{
		$this->selected_primary_key = null;
	}

	/**
	 * confirm delete
	 * @method confirmDelete
	 */
	public function confirmDelete()
	{
		$this->beforeDelete();
		$this->deleting();
		$this->afterDelete();

		$this->showMessage('success','Data sucessfuly deleted!');	
		$this->dispatchBrowserEvent('show-tooltip');	
		$this->resetForm();
		$this->resetFilter();
		$this->getFilter();
	}

	/**
	 * before delete
	 * @method beforeDelete
	 */
	public function beforeDelete()
	{
	}

	/**
	 * deleting
	 */
	public function deleting()
	{
		$this->model::where($this->primary_key,$this->selected_primary_key)->delete();
	}

	/**
	 * after delete
	 * @method afterDelete
	 */
	public function afterDelete()
	{
	}

	/**
	 * can edit
	 * @method canEdit
	 * @param bool $can
	 */
	public function canEdit($can){
		$this->can_edit = $can;
	}

	/**
	 * can add
	 * @method canAdd
	 * @param bool $can
	 */
	public function canAdd($can){
		$this->can_add = $can;
	}

	/**
	 * can add
	 * @method canShow
	 * @param bool $can
	 */
	public function canShow($can){
		$this->can_show = $can;
	}

	/**
	 * can add
	 * @method canDelete
	 * @param bool $can
	 */
	public function canDelete($can){
		$this->can_delete = $can;
	}

	/**
	 * order by
	 * @method listOrderBy
	 * @param string $field
	 * @param string $sort
	 */
	public function listOrderBy($field,$sort="asc"){
		$order_by = $this->order_by;
		$new = [
			"field" => $field,
			"sort" => $sort
		];
		array_push($order_by,$new);
		$this->order_by = $order_by;
	}

}