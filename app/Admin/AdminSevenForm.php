<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;

trait AdminSevenForm{

	public $form_add_setting = [];
	public $form_edit_setting = [];
	public $form_mode = "add";
	public $form = [];
	public $form_edit = [];
	public $form_width = 12;

	/**
	 * set form add
	 * @method setView
	 * @return void
	 */
	protected function setForm()
	{
		$data = new $this->model;
		$table = $data->getTable();

		$columns = DB::getSchemaBuilder()->getColumnListing($table);
		if($columns){
			foreach ($columns as $key => $value) {
				if($value != $this->primary_key && $value != "created_at" && $value != "updated_at"){
					$name = str_replace("_", " ",$value);
					$name = str_replace("-", " ",$name);
					$name = \Str::title($name);
					$this->formField($value,$name);
				}
			}
		}
	}

	/**
	 * set form edit
	 * @method setFormEdit
	 * @return void
	 */
	protected function setFormEdit()
	{
		$this->sameAsFormAddSetting();
	}

	/**
	 * set form edit
	 * @method sameAsFormAddSetting
	 * @return void
	 */
	protected function sameAsFormAddSetting()
	{
		$this->form_edit_setting = $this->form_add_setting;
		$this->form_edit = $this->form;
	}

	/**
	 * set to add
	 *
	 * @method add
	 * @return void
	 */
	public function add()
	{
		$this->beforeAdd();
		if(!$this->can_add){
			abort('403');
		}
		$this->closeMessage();
		$this->view = 'form';
		$this->form_mode = 'add';
		$this->afterAdd();
	}


	/**
	 * set before add
	 * @method beforeAdd
	 * @return void
	 */
	public function beforeAdd($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * set after add
	 * @method afterAdd
	 * @return void
	 */
	public function afterAdd($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * set to edit
	 *
	 * @method add
	 * @return void
	 */
	public function edit($id)
	{
		$this->beforeEdit();
		if(!$this->can_edit){
			abort('403');
		}
		$this->closeMessage();
		$this->view = 'form';
		$this->form_mode = 'edit';
		$this->selected_primary_key = $id;
		$this->getDataEdit();
		$this->afterEdit();
	}


	/**
	 * set before edit
	 * @method beforeEdit
	 * @return void
	 */
	public function beforeEdit($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * set after edit
	 * @method afterEdit
	 * @return void
	 */
	public function afterEdit($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * set default value from edit
	 * @method getDataEdit
	 * @return void
	 */
	protected function getDataEdit()
	{
		$data = $this->model::where($this->primary_key,$this->selected_primary_key)->first()->toArray();
		$form_edit = $this->form_edit;

		foreach($data as $field => $row)
		{
			if(array_key_exists($field,$form_edit)){

				foreach($this->form_edit_setting as $form){

					if($form['field'] == $field){
						if($form['value'] === NULL){
							$form_edit[$field] = $row;
						}else{
							$form_edit[$field] = $form['value'];
						}
					}

				}
			}
		}
		$this->form_edit = $form_edit;
	}

	/**
	 * reset form
	 *
	 * @method resetForm
	 * @return void
	 */
	public function resetForm()
	{

		$form = $this->form;
		foreach($form as $key => $value)
		{
			$form[$key] = null;
		}
		$this->form = $form;

		$form_edit = $this->form_edit;
		foreach($form_edit as $key => $value)
		{
			$form_edit[$key] = null;
		}
		$this->form_edit = $form_edit;
	}

	/**
	 * saving form
	 *
	 * @method save
	 * @return void
	 */
	public function save()
	{
		if($this->form_mode == 'add'){
			$this->storeForm();
		}else{
			$this->updateForm();
		}
	}

	/**
	 * store form
	 *
	 * @method storeForm
	 * @return void
	 */
	protected function storeForm()
	{
		$this->beforeStore();
		$this->validateStore();

		try {
			$this->formStoring();
			$this->afterStore();
			$this->finishStore();
			$this->showMessage('success','Data added successfully!');
		} catch (Exception $e) {
			$this->showMessage('danger','Failed to store data! '. $e);
		}
	}

	/**
	 * store form
	 *
	 * @method updateForm
	 * @return void
	 */
	protected function updateForm()
	{
		$this->beforeUpdate();
		$this->validateUpdate();
		

		try {
			$this->formUpdating();
			$this->afterUpdate();
			$this->finishUpdate();
			$this->showMessage('success','Data updated successfully!');
		} catch (Exception $e) {
			$this->showMessage('danger','Failed to update data! '. $e);
		}
	}

	/**
	 * validate store
	 *
	 * @method validateStore
	 * @return void
	 */
	public function validateStore()
	{
		foreach($this->form as $key => $value){
			$form_setting = $this->getFormAddSetting($key);
			if($form_setting['validate']){
				$this->validate([
					'form.'.$key => $form_setting['validate']
				]);
			}
		}
	}

	/**
	 * validate store
	 *
	 * @method validateUpdate
	 * @return void
	 */
	public function validateUpdate()
	{
		foreach($this->form_edit as $key => $value){
			$form_setting = $this->getFormEditSetting($key);
			if($form_setting['validate']){
				$this->validate([
					'form_edit.'.$key => $form_setting['validate']
				]);
			}
		}
	}

	/**
	 * finish store
	 *
	 * @method finishStore
	 * @return void
	 */
	public function finishStore()
	{
		$this->resetForm();
		$this->view = "list";
		$this->resetFilter();
		$this->getFilter();
		$this->dispatchBrowserEvent('show-tooltip');
	}

	/**
	 * finish update
	 *
	 * @method finishUpdate
	 * @return void
	 */
	public function finishUpdate()
	{
		$this->resetForm();
		$this->view = "list";
		$this->resetFilter();
		$this->getFilter();
		$this->dispatchBrowserEvent('show-tooltip');
	}

	/**
	 * get form setting
	 *
	 * @method getFormAddSetting
	 * @return void
	 */
	public function getFormAddSetting($name)
	{
		foreach($this->form_add_setting as $form){
			if($form['field'] == $name){
				return $form;
			}
		}
	}

	/**
	 * get form setting
	 *
	 * @method getFormEditSetting
	 * @return void
	 */
	public function getFormEditSetting($name)
	{
		foreach($this->form_edit_setting as $form){
			if($form['field'] == $name){
				return $form;
			}
		}
	}

	/**
	 * before store
	 *
	 * @method beforeStore
	 * @return void
	 */
	public function beforeStore($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * before update
	 *
	 * @method beforeUpdate
	 * @return void
	 */
	public function beforeUpdate($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * storing
	 *
	 * @method formStoring
	 * @return void
	 */
	public function formStoring()
	{
		$data = new $this->model;

		foreach($this->form as $field => $value){
			$data->{$field} = $value;
		}
		$data->save();
	}

	/**
	 * updating form
	 *
	 * @method formUpdating
	 * @return void
	 */
	public function formUpdating()
	{
		$data = $this->model::where($this->primary_key,$this->selected_primary_key)->first();

		if(!$data){
			abort('404');
		}

		foreach($this->form_edit as $field => $value){
			$data->{$field} = $value;
		}
		$data->save();
	}

	/**
	 * after store
	 *
	 * @method afterStore
	 * @return void
	 */
	public function afterStore($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * after update
	 *
	 * @method afterUpdate
	 * @return void
	 */
	public function afterUpdate($script=null)
	{
		if($script){
			eval($script);
		}
	}

	/**
	 * set form field
	 * @method formField
	 * @param string field_name
	 * @param string label_name
	 * @param string relation
	 * @return void
	 */
	protected function formField($field_name,$label_name=null)
	{
		$form_add_setting = $this->form_add_setting;
		if(!$label_name){
			$label_name = str_replace("_", " ",$field_name);
			$label_name = str_replace("-", " ",$label_name);
			$label_name = \Str::title($label_name);
		}
		$new_form = [
			"field" => $field_name,
			"label" => $label_name,
			"type" => "inputText",
			"relation" => [],
			"validate" => "required",
			"column" => [3,9],
			"info" => null,
			"value" => null,
			"placeholder" => $label_name,
			"event" => [],
		];
		array_push($form_add_setting, $new_form);
		$this->form_add_setting = $form_add_setting;

		$form = $this->form;
		$form[$field_name] = null;
		$this->form = $form;

		return $this;
	}

	/**
	 * set relation on form fields
	 * @method formRelation
	 * @param string $relation
	 * @param string $foreign_key
	 * @param string $fields_name
	 * @return void
	 */
	protected function formRelation($relation,$foreign_key,$fields_name)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);

		$relation = str_replace(".",'\\', $relation);
		$relation = '\\App\\'.$relation;
		$get_relation = $relation::all();
		$options_relation = [];
		foreach($get_relation as $key => $value){
			$options_relation[$value->{$foreign_key}] = $value->{$fields_name};
		}

		$form_add_setting[$length-1]['relation'] = $options_relation;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set form type
	 * @method formType
	 * @return void
	 */
	protected function formType($type)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form = $this->thisFormType($type);
		$form_add_setting[$length-1]['type'] = $form;
		if($type == 'checkbox'){
			$this->form[$form_add_setting[$length-1]['field']] = [];
		}
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set validate on form fields
	 * @method formValidate
	 * @param string $validate
	 * @return void
	 */
	protected function formValidate($validate)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['validate'] = $validate;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set column on form fields
	 * @method formColumn
	 * @param string $validate
	 * @return void
	 */
	protected function formColumn($left,$right)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['column'] = [$left,$right];
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set info on form fields
	 * @method formInfo
	 * @param string $info
	 * @return void
	 */
	protected function formInfo($info)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['info'] = $info;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set value on form fields
	 * @method formValue
	 * @param string $value
	 * @return void
	 */
	protected function formValue($value)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['value'] = $value;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set placeholder on form fields
	 * @method formPlaceholder
	 * @param string $value
	 * @return void
	 */
	protected function formPlaceholder($placeholder)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['placeholder'] = $placeholder;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set event on form fields
	 * @method formEvent
	 * @param string $value
	 * @return void
	 */
	protected function formEvent($new_event)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);

		$event = $form_add_setting[$length-1]['event'];
		array_push($event, $new_event);

		$form_add_setting[$length-1]['event'] = $event;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set form field
	 * @method formEditField
	 * @param string field_name
	 * @param string label_name
	 * @param string relation
	 * @return void
	 */
	protected function formEditField($field_name,$label_name=null)
	{
		$form_edit_setting = $this->form_edit_setting;
		if(!$label_name){
			$label_name = str_replace("_", " ",$field_name);
			$label_name = str_replace("-", " ",$label_name);
			$label_name = \Str::title($label_name);
		}
		$new_form = [
			"field" => $field_name,
			"label" => $label_name,
			"type" => "inputText",
			"relation" => [],
			"validate" => "required",
			"column" => [3,9],
			"info" => null,
			"value" => null,
			"placeholder" => $label_name,
			"event" => []
		];
		array_push($form_edit_setting, $new_form);
		$this->form_edit_setting = $form_edit_setting;

		$form_edit = $this->form_edit;
		$form_edit[$field_name] = null;
		$this->form_edit = $form_edit;

		return $this;
	}

	/**
	 * set relation on form edit fields
	 * @method formEditRelation
	 * @param string $relation
	 * @param string $foreign_key
	 * @param string $fields_name
	 * @return void
	 */
	protected function formEditRelation($relation,$foreign_key,$fields_name)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);

		$relation = str_replace(".",'\\', $relation);
		$relation = '\\App\\'.$relation;
		$get_relation = $relation::all();
		$options_relation = [];
		foreach($get_relation as $key => $value){
			$options_relation[$value->{$foreign_key}] = $value->{$fields_name};
		}

		$form_edit_setting[$length-1]['relation'] = $options_relation;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set form edit type
	 * @method formEditType
	 * @return void
	 */
	protected function formEditType($type)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);
		$form = $this->thisFormType($type);
		$form_edit_setting[$length-1]['type'] = $form;
		if($type == 'checkbox'){
			$this->form_edit[$form_edit_setting[$length-1]['field']] = [];
		}
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set edit validate on form fields
	 * @method formEditValidate
	 * @param string $validate
	 * @return void
	 */
	protected function formEditValidate($validate)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);
		$form_edit_setting[$length-1]['validate'] = $validate;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set column on form edit fields
	 * @method formEditColumn
	 * @param string $validate
	 * @return void
	 */
	protected function formEditColumn($left,$right)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);
		$form_edit_setting[$length-1]['column'] = [$left,$right];
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set info on form edit fields
	 * @method formEditInfo
	 * @param string $info
	 * @return void
	 */
	protected function formEditInfo($info)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);
		$form_edit_setting[$length-1]['info'] = $info;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set value on form edit fields
	 * @method formEditValue
	 * @param string $value
	 * @return void
	 */
	protected function formEditValue($value)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);
		$form_edit_setting[$length-1]['value'] = $value;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set placeholder on form edit fields
	 * @method formEditPlaceholder
	 * @param string $value
	 * @return void
	 */
	protected function formEditPlaceholder($placeholder)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);
		$form_edit_setting[$length-1]['placeholder'] = $placeholder;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set event on form edit fields
	 * @method formEditEvent
	 * @param string $value
	 * @return void
	 */
	protected function formEditEvent($new_event)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);

		$event = $form_edit_setting[$length-1]['event'];
		array_push($event, $new_event);

		$form_edit_setting[$length-1]['event'] = $event;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	protected function thisFormType($type)
	{
		$form = '';
		switch ($type) {
			case 'text':
				$form = "inputText";
				break;
			case 'email':
				$form = "inputEmail";
				break;
			case 'password':
				$form = "inputPassword";
				break;
			case 'number':
				$form = "inputNumber";
				break;
			case 'select':
				$form = "selectOption";
				break;
			case 'radio':
				$form = "selectRadio";
				break;
			case 'checkbox':
				$form = "selectCheckbox";
				break;
			case 'textarea':
				$form = "inputTextarea";
				break;
			case 'date':
				$form = "inputDate";
				break;
			case 'time':
				$form = "inputTime";
				break;
			case 'datetime':
				$form = "inputDatetime";
				break;
			case 'daterange':
				$form = "inputDaterange";
				break;
			case 'datetimerange':
				$form = "inputDatetimerange";
				break;
			case 'color':
				$form = "inputColor";
				break;
			case 'file':
				$form = "uploadFile";
				break;
			case 'textarea':
				$form = "inputTextarea";
				break;
			case 'texteditor':
				$form = "inputTextEditor";
				break;
			case 'textcode':
				$form = "inputTextCode";
				break;
			default:
				$form = "inputText";
				break;
		}
		return $form;
	}

	/**
	 * set form width
	 * @method formWidth
	 * @param int $width
	 */
	public function formWidth($width)
	{
		$this->form_width = $width;
	}

}