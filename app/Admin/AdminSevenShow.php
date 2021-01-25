<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;

trait AdminSevenShow{

	public $row_show = [];
	public $result_show = [];
	public $show_width = 12;
	public $show_relations = [];

	public function setShow(){

		$data = new $this->model;
		$table = $data->getTable();

		$columns = DB::getSchemaBuilder()->getColumnListing($table);
		if($columns){
			foreach ($columns as $key => $value) {
				if($value != $this->primary_key && $value != "created_at" && $value != "updated_at"){
					$name = str_replace("_", " ",$value);
					$name = str_replace("-", " ",$name);
					$name = \Str::title($name);
					$this->showField($value,$name);
				}
			}
		}

	}

	/**
	 * set form field
	 * @method showField
	 * @param string field_name
	 * @param string label_name
	 * @param string relation
	 * @return void
	 */
	protected function showField($field_name,$label_name=null)
	{
		$row_show = $this->row_show;
		if(!$label_name){
			$label_name = str_replace("_", " ",$field_name);
			$label_name = str_replace("-", " ",$label_name);
			$label_name = \Str::title($label_name);
		}
		$new_field = [
			"field" => \Str::snake($field_name),
			"label" => $label_name,
			"format" => null,
			"file" => false,
			"image" => false,
			"badge" => null
		];
		array_push($row_show, $new_field);
		$this->row_show = $row_show;

		return $this;
	}

	/**
	 * set show relation table
	 * @method showRelationTo
	 * @param string $relation
	 * @return void
	 */
	protected function showRelationTo($relation)
	{
		$relations = $this->show_relations;
		array_push($relations, $relation);
		$this->show_relations = $relations;

		return $this;
	}

	/**
	 * set to show
	 *
	 * @method show
	 * @return void
	 */
	public function show($id)
	{
		if(!$this->can_show){
			abort('403');
		}
		$this->closeMessage();
		$this->view = 'show';
		$this->selected_primary_key = $id;
		$this->getDataShow();
	}

	/**
	 * set default value from edit
	 * @method getDataShow
	 * @return void
	 */
	protected function getDataShow()
	{
		$this->beforeShow();
		$data = $this->model::where($this->primary_key,$this->selected_primary_key);

		foreach($this->show_relations as $relation){
			$data = $data->with($relation);
		}
		$this->result_show = $data->first()->toArray();
		$this->afterShow();
	}

	/**
	 * after show
	 *
	 * @method afterShow
	 * @return void
	 */
	public function afterShow($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * before show
	 *
	 * @method beforeShow
	 * @return void
	 */
	public function beforeShow($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * set show format of lists
	 * @method showFormat
	 * @return void
	 */
	protected function showFormat($method)
	{
		$fields = $this->row_show;
		$length = count($fields);
		$fields[$length-1]['format'] = $method;
		$this->row_show = $fields;

		return $this;
	}

	/**
	 * set show file of lists
	 * @method showAsFile
	 * @return void
	 */
	protected function showAsFile()
	{
		$fields = $this->row_show;
		$length = count($fields);
		$fields[$length-1]['file'] = true;
		$this->row_show = $fields;

		return $this;
	}

	/**
	 * set show image of lists
	 * @method showAsImage
	 * @return void
	 */
	protected function showAsImage()
	{
		$fields = $this->row_show;
		$length = count($fields);
		$fields[$length-1]['image'] = true;
		$this->row_show = $fields;

		return $this;
	}

	/**
	 * set show badge of lists
	 * @method showAsBadge
	 * @return void
	 */
	protected function showAsBadge($variant=null)
	{
		if(!$variant){
			$variant = \AdminSeven::accentSkin();
			$variant = str_replace('bg-','', $variant);
		}
		$fields = $this->row_show;
		$length = count($fields);
		$fields[$length-1]['badge'] = $variant;
		$this->row_show = $fields;

		return $this;
	}

	/**
	 * set show width
	 * @method showWidth
	 * @param int $width
	 */
	public function showWidth($width)
	{
		$this->show_width = $width;
	}

	public function deleteFile($key,$field){

		$primary_key = $this->primary_key;
		$selected_primary_key = $this->selected_primary_key;
		$model = $this->model;

		$data = $model::where($primary_key,$selected_primary_key)->first();
		if(!$data){
			abort('404');
		}


		$paths = $data->{$field};
		$paths = (array) json_decode($paths);

		if(is_array($paths)){
			$path = $paths[$key];
			if(file_exists(\Storage::path($path))){
				\Storage::delete($path);
			}
			unset($paths[$key]);
			$path = json_encode($paths);
		}else{
			if(file_exists(\Storage::path($path))){
				\Storage::delete($path);
			}
			$path = null;
		}
		$data->{$field} = $path;
		$data->save();
		$this->showMessage('success','File has been deleted!');
	}

}