<?php

namespace App\Http\Livewire\Creator;

use Livewire\Component;
use App\Admin\AdminSevenCrud;
use App\Models\AdminSevenCrudModel;

class MakeCreator extends Component
{
	use AdminSevenCrud;

	public $attributes = [];

	public function prepare()
	{
		$crud_slug = \Request::segment(2);
		$creator = AdminSevenCrudModel::where('crud_slug',$crud_slug)->first();
		if(!$creator){
			abort('404');
		}
		$model = str_replace(".",'\\', $creator->model);
		$model = 'App\\'.$model;
		$attributes = collect(json_decode(base64_decode($creator->attributes),true))->toArray();

		$this->model = $model;
		$this->attributes = $attributes;

		# general settings
		$this->can_edit = (isset($this->attributes['general']['can_edit'])) ? $this->attributes['general']['can_edit'] : true;
		$this->can_delete = (isset($this->attributes['general']['can_delete'])) ? $this->attributes['general']['can_delete'] : true;
		$this->can_add = (isset($this->attributes['general']['can_add'])) ? $this->attributes['general']['can_add'] : true;
		$this->can_show = (isset($this->attributes['general']['can_show'])) ? $this->attributes['general']['can_show'] : true;
		$this->with_filter = (isset($this->attributes['general']['with_filter'])) ? $this->attributes['general']['with_filter'] : true;
		$this->form_width = (isset($this->attributes['general']['form_width'])) ? $this->attributes['general']['form_width'] : 12;
		$this->show_width = (isset($this->attributes['general']['show_width'])) ? $this->attributes['general']['show_width'] : 12;
		$this->url_permission = (isset($this->attributes['general']['url_permission'])) ? $this->attributes['general']['url_permission'] : true;
		$this->javascript = $this->attributes['general']['javascript'];
		$this->per_page = ($this->attributes['general']['per_page']) ? $this->attributes['general']['per_page'] : 10;
		$this->list_per_page = ($this->attributes['general']['list_per_page']) ? explode(",",$this->attributes['general']['list_per_page']) : [10,25,50,100];

		# set form
		if(count($attributes['column_add']) > 0){
			$this->setForm();
		}
		if(count($attributes['column_edit']) > 0){
			$this->setFormEdit();
		}
		# set show
		if(count($attributes['show']) > 0){
			$this->setShow();
		}
		# set list
		if(count($attributes['list']) > 0){
			$this->setLists();
		}
		# set filter
		if(count($attributes['filter']) > 0){
			$this->setFilter();
		}
	}

	public function setForm()
	{
		$this->form_add_setting = $this->attributes['column_add'];
		$form_add = [];
		foreach($this->form_add_setting as $key => $row){
			$form_add[$row['field']] = null;

			#relation
			if($row['relation_text'] != null){
				$relation = explode(",",$row['relation_text']);
				$this->formRelation($relation[0],$relation[1],$relation[2],$key);
			}
		}
		$this->form_add = $form_add;
	}

	public function setFormEdit()
	{
		if($this->attributes['edit_same_as_create'] == true){
			$this->sameAsFormAddSetting();
		}else{
			$this->form_edit_setting = $this->attributes['column_edit'];
			$form_edit = [];
			foreach($this->form_edit_setting as $key => $row){
				$form_edit[$row['field']] = null;
			}
			$this->form_edit = $form_edit;
		}
	}

	public function setShow()
	{
		$this->row_show = $this->attributes['show'];
		if($this->attributes['show_relation']){
			$relations = explode(",",$this->attributes['show_relation']);
			$this->show_relations = $relations;
		}
	}

	public function setLists()
	{
		$this->lists_fields = $this->attributes['list'];
		if($this->attributes['list_relation']){
			$relations = explode(",",$this->attributes['list_relation']);
			$this->lists_relations = $relations;
		}
		if(isset($this->attributes['order_by'])){
			if($this->attributes['order_by']){
				$order_by = [];
				$json = "[".$this->attributes['order_by']."]";
				$data = json_decode($json,true);
				if($data){
					if(is_array($data)){
						foreach($data as $key => $row){
							$new = [
								"field" => key($row),
								"sort" => $row[key($row)]
							];
							array_push($order_by, $new);
						}
					}else{
						$new = [
							"field" => key($data),
							"sort" => $data[key($data)]
						];
						array_push($order_by, $new);
					}
					$this->order_by = $order_by;
				}
			}
		}
	}

	public function setFilter()
	{
		$this->filter_fields = $this->attributes['filter'];
		$filter_fields = [];
		foreach($this->filter_fields as $key => $row){
			#relation
			if($row['relation_text'] != null){
				$relation = explode(",",$row['relation_text']);
				$this->filterRelation($relation[0],$relation[1],$relation[2],$key);
			}
		}
	}
}
