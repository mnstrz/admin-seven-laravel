<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;

trait AdminSevenFilters{

	public $filter_fields = [];
	public $filters = [];

	/**
	 * set filter
	 * @method setModel
	 * @return void
	 */
	protected function setFilter()
	{
		$data = new $this->model;
		$table = $data->getTable();

		$columns = DB::getSchemaBuilder()->getColumnListing($table);
		if($columns){
			$fields = $this->lists_fields;
			foreach ($columns as $key => $value) {
				if($value != 'id' && $value != 'created_at' && $value != 'updated_at'){
					$name = str_replace("_", " ",$value);
					$name = str_replace("-", " ",$name);
					$name = \Str::title($name);
					$this->filter($value,$name,'like');
				}
			}
		}
	}

	/**
	 * set filter
	 * @method resetFilter
	 * @return void
	 */
	protected function resetFilter()
	{
		$this->filters = [];
	}

	/**
	 * set filter fields
	 * @method filter
	 * @param string $field
	 * @param string $label
	 * @return void
	 */
	protected function filter($field,$label,$operator=null)
	{
		$filter_fields = $this->filter_fields;
		if($operator == null){
			$operator = "=";
		}
		if(!$label){
			$label = str_replace("_", " ",$field);
			$label = str_replace("-", " ",$label);
			$label = \Str::title($label);
		}
		$new_filter = [
			"field" => $field,
			"label" => $label,
			"type" => "inputText",
			"relation" => [],
			"operator" => $operator
		];
		array_push($filter_fields, $new_filter);
		$this->filter_fields = $filter_fields;

		return $this;
	}

	/**
	 * set filter type
	 * @method filterType
	 * @return void
	 */
	protected function filterType($type)
	{
		$filter_fields = $this->filter_fields;
		$length = count($filter_fields);
		$form = $this->thisFormType($type);
		$filter_fields[$length-1]['type'] = $form;
		if($type == 'checkbox'){
			$this->filter_fields[$filter_fields[$length-1]['field']] = [];
		}
		$this->filter_fields = $filter_fields;

		return $this;
	}

	/**
	 * set relation on filter fields
	 * @method filterRelation
	 * @param string $relation
	 * @param string $foreign_key
	 * @param string $fields_name
	 * @return void
	 */
	protected function filterRelation($relation,$foreign_key,$fields_name)
	{
		$filter_fields = $this->filter_fields;
		$length = count($filter_fields);

		$relation = str_replace(".",'\\', $relation);
		$relation = '\\App\\'.$relation;
		$get_relation = $relation::all();
		$options_relation = ['all' => 'All'];
		foreach($get_relation as $key => $value){
			$options_relation[$value->{$foreign_key}] = $value->{$fields_name};
		}

		$filter_fields[$length-1]['relation'] = $options_relation;
		$this->filter_fields = $filter_fields;

		return $this;
	}

	/**
	 * render view filter
	 *
	 * @method renderFilter
	 * @return view
	 */
	public function renderFilter()
	{
		$filter_fields = $this->filter_fields;
		$response = [
			'filter_fields'
		];
		return view('livewire.backend.crud.filter',compact($response));
	}

	/**
	 * get data filter
	 * 
	 * @method getFilter
	 * @return void
	 */
	public function getFilter()
	{
		$this->resetPagination();
		$this->getData();
	}

	/**
	 * reset data filter
	 * 
	 * @method resetFilterFields
	 * @return void
	 */
	public function resetFilterFields()
	{
		foreach($this->filters as $key => $filter){
			$this->filters[$key] = null;
		}
		$this->resetPagination();
		$this->getData();
	}

}