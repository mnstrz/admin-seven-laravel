<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;

trait AdminSevenForm{

	public $form_add_setting = [];
	public $form_edit_setting = [];
	public $form_mode = "add";
	public $form_add = [];
	public $form_edit = [];
	public $form_width = 12;
	public $form_file = [];

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
		$this->form_edit = $this->form_add;
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
		$this->selected_primary_key = null;
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
		if(!$data){
			abort('404');
		}
		$form_edit = ($this->form_edit) ? $this->form_edit : $this->form_add;
		foreach($form_edit as $field => $row){
			$this->form_edit[$field] = null;
		}
		foreach($data as $field => $row)
		{
			if(array_key_exists($field,$form_edit)){
				foreach($this->form_edit_setting as $key => $form){
					if($form['field'] == $field){
						if($form['type'] != 'inputPassword'){
							if($form['value'] === NULL){
								$form_edit[$field] = $row;
							}else{
								$form_edit[$field] = $form['value'];
							}
						}
						if($form['type'] == 'uploadImage'){
							$this->form_edit_setting[$key]['path'] = $row;
						}
						if($form['type'] == 'uploadFile'){
							$this->form_edit_setting[$key]['path'] = $row;
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

		$form = $this->form_add;
		foreach($form as $key => $value)
		{
			$form[$key] = null;
		}
		$this->form_add = $form;

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
		$this->validateStore();
		$this->beforeStore();

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
		$this->validateUpdate();
		$this->beforeUpdate();

		try {
			$this->formUpdating();
			$this->afterUpdate();
			$this->finishUpdate();
			$this->selected_primary_key = null;
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
		foreach($this->form_add as $key => $value){
			$form_setting = $this->getFormAddSetting($key);
			if($form_setting['validate']){
				$this->validate([
					'form_add.'.$key => $form_setting['validate']
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

		foreach($this->form_add as $field => $value){
			$form_setting = $this->getFormAddSetting($field);
			if($form_setting['type'] == "uploadImage"){
				if(is_array($this->form_add[$field])){
					$this->uploadImage($field,$form_setting['upload_dir']);
					$value = $this->form_add[$field];
				}
			}
			if($form_setting['type'] == "uploadFile"){
				if($form_setting['multifile']){
					if(count($this->{$form_setting['field']."_files"}) > 0){
						$this->uploadFile($field,$form_setting['upload_dir']);
						$value = $this->form_add[$field];
					}
				}else{
					if(isset($this->form_file[$field])){
						if($this->form_file[$field]){
							$this->uploadFile($field,$form_setting['upload_dir']);
							$value = $this->form_add[$field];
						}
					}
				}
			}
			if(!$form_setting['ignore']){
				$data->{$field} = $value;
			}
		}
		$data->save();
	}

	/**
	 * uploading file
	 *
	 * @method uploadImage
	 * @return void
	 */
	public function uploadImage($field,$upload_dir)
	{
		# get file extension
		$extension = explode('/', $this->form_add[$field]['type']);
		$extension = end($extension);

		# get image
		$image = $this->form_add[$field]['file'];
		$image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

		# set filename
		$filename = uniqid();

		# set path
		$path_file = $upload_dir.'/'.$filename.".$extension";

		# store into storage
		\Storage::disk('local')->put($path_file, $image);

		# set state to path
		$this->form_add[$field] = $path_file;
	}

	/**
	 * updating image file
	 *
	 * @method imageUpdate
	 * @return void
	 */
	public function imageUpdate($field,$upload_dir,$existing=null)
	{
		# delete existing
		if($existing){
			if(file_exists(\Storage::path($existing))){
				\Storage::delete($existing);
			}
		}

		# get file extension
		$type = explode('/', $this->form_edit[$field]['type']);
		$type = end($type);

		# get image
		$image = $this->form_edit[$field]['file'];
		$image = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image));

		# set filename
		$filename = uniqid();

		# set path
		$path_file = $upload_dir.'/'.$filename.".$type";

		# store into storage
		\Storage::disk('local')->put($path_file, $image);

		# set state to path
		$this->form_edit[$field] = $path_file;
	}

	/**
	 * uploading file
	 *
	 * @method uploadFile
	 * @return void
	 */
	public function uploadFile($field,$upload_dir)
	{
		$form_setting = $this->getFormAddSetting($field);
		if($form_setting['multifile']){
			$path_files = [];
			foreach($this->{$field.'_files'} as $file){
				# get file
				$extension = $file->getClientOriginalExtension();

				# set filename
				$filename = uniqid();

				# set path
				$path_file = $upload_dir.'/'.$filename.".$extension";

				# store into storage
				$file->storeAs($upload_dir, $filename.".$extension");
				array_push($path_files, $path_file);
			}
			# set state to path
			$this->form_add[$field] = json_encode($path_files);
			# set file state to array
			$this->{$field.'_files'} = [];
		}else{
			# get file
			$file = $this->form_file[$field];
			$extension = $file->getClientOriginalExtension();

			# set filename
			$filename = uniqid();

			# set path
			$path_file = $upload_dir.'/'.$filename.".$extension";

			# store into storage
			$file->storeAs($upload_dir, $filename.".$extension");

			# set state to path
			$this->form_add[$field] = $path_file;
			# set file state to array
			$this->form_file[$field] = [];
		}
	}

	/**
	 * uploading file
	 *
	 * @method fileUpdate
	 * @return void
	 */
	public function fileUpdate($field,$upload_dir,$existing=null)
	{
		$form_setting = $this->getFormAddSetting($field);
		if($form_setting['multifile']){
			$path_files = $this->form_edit[$field];
			$path_files = json_decode($path_files);
			$path_files = ($path_files) ? (array) $path_files : [];
			foreach($this->{$field.'_files'} as $file){
				# get file
				$extension = $file->getClientOriginalExtension();

				# set filename
				$filename = uniqid();

				# set path
				$path_file = $upload_dir.'/'.$filename.".$extension";

				# store into storage
				$file->storeAs($upload_dir, $filename.".$extension");
				array_push($path_files, $path_file);
			}
			# set state to path
			$this->form_edit[$field] = json_encode($path_files);
			# set file state to array
			$this->{$field.'_files'} = [];
		}else{
			# delete existing
			if($existing){
				if(file_exists(\Storage::path($existing))){
					\Storage::delete($existing);
				}
			}

			# get image
			$file = $this->form_file[$field];
			$extension = $file->getClientOriginalExtension();

			# set filename
			$filename = uniqid();

			# set path
			$path_file = $upload_dir.'/'.$filename.".$extension";

			# store into storage
			$file->storeAs($upload_dir, $filename.".$extension");
			//\Storage::disk('local')->putFile($path_file, $file);

			# set state to path
			$this->form_edit[$field] = $path_file;
			# set file state to array
			$this->form_file[$field] = [];
		}
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
			$form_edit_setting = $this->getFormEditSetting($field);
			if($form_edit_setting['type'] == "uploadImage"){
				if(is_array($value)){
					$this->imageUpdate($field,$form_edit_setting['upload_dir'],$data->{$field});
					$value = $this->form_edit[$field];
				}
			}
			if($form_edit_setting['type'] == "uploadFile"){
				if($form_edit_setting['multifile']){
					if(count($this->{$form_edit_setting['field']."_files"}) > 0){
						$this->fileUpdate($field,$form_edit_setting['upload_dir'],$data->{$field});
						$value = $this->form_edit[$field];
					}
				}else{
					if(isset($this->form_file[$field])){
						if($this->form_file[$field]){
							$this->fileUpdate($field,$form_edit_setting['upload_dir'],$data->{$field});
							$value = $this->form_edit[$field];
						}
					}
				}
			}
			if(!$form_edit_setting['ignore']){
				$data->{$field} = $value;
			}
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
			"options" => [],
			"validate" => null,
			"column" => [3,9],
			"info" => null,
			"value" => null,
			"placeholder" => $label_name,
			"event" => [],
			"upload_dir" => null,
			"image_setting" => [],
			"path" => null,
			"ignore" => false,
			"multifile" => false
		];
		array_push($form_add_setting, $new_form);
		$this->form_add_setting = $form_add_setting;

		$form = $this->form_add;
		$form[$field_name] = null;
		$this->form_add = $form;

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
	protected function formRelation($relation,$foreign_key,$fields_name,$key_form=null)
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
		if($key_form !== null){
			$form_add_setting[$key_form]['relation'] = $options_relation;
		}else{
			$form_add_setting[$length-1]['relation'] = $options_relation;
		}
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
			$this->form_add[$form_add_setting[$length-1]['field']] = [];
		}
		if($type == 'file'){
			$name = $form_add_setting[$length-1]['field']."_files";
			global $name;
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
	 * set validate on form fields
	 * @method formFileDir
	 * @param string $validate
	 * @return void
	 */
	protected function formFileDir($upload_dir)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['upload_dir'] = $upload_dir;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set setting image on form fields
	 * @method formImageSetting
	 * @param string $setting image
	 * @return void
	 */
	protected function formImageSetting($image_setting)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['image_setting'] = $image_setting;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set path on form fields
	 * @method filePath
	 * @param string $path image
	 * @return void
	 */
	protected function formPath($path)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['path'] = $path;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set ignore on form fields
	 * @method formIgnore
	 * @return void
	 */
	protected function formIgnore()
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['ignore'] = true;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set multifile on form fields
	 * @method formMultiplefile
	 * @return void
	 */
	protected function formMultiplefile()
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['multifile'] = true;
		$this->form_add_setting = $form_add_setting;

		return $this;
	}

	/**
	 * set options on form fields
	 * @method formOptions
	 * @param string $value
	 * @return void
	 */
	protected function formOptions($value)
	{
		$form_add_setting = $this->form_add_setting;
		$length = count($form_add_setting);
		$form_add_setting[$length-1]['options'] = $value;
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
			"options" => [],
			"validate" => null,
			"column" => [3,9],
			"info" => null,
			"value" => null,
			"placeholder" => $label_name,
			"event" => [],
			"upload_dir" => null,
			"image_setting" => [],
			"path" => null,
			"ignore" => false,
			"multifile" => false
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
	protected function formEditRelation($relation,$foreign_key,$fields_name,$key_form=null)
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
		if($key_form !== null){
			$form_edit_setting[$key_form]['relation'] = $options_relation;
		}else{
			$form_edit_setting[$length-1]['relation'] = $options_relation;
		}
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

	/**
	 * set event on form edit fields
	 * @method formEditFileDir
	 * @param string $upload_dir
	 * @return void
	 */
	protected function formEditFileDir($new_upload_dir)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);

		$form_edit_setting[$length-1]['upload_dir'] = $new_upload_dir;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set edit setting image on form fields
	 * @method formFile
	 * @param string $setting image
	 * @return void
	 */
	protected function formEditImageSetting($new_image_setting)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);
		
		$form_edit_setting[$length-1]['image_setting'] = $new_image_setting;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set path on form fields
	 * @method filePath
	 * @param string $path image
	 * @return void
	 */
	protected function formEditPath($path)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);

		$path = $form_edit_setting[$length-1]['path'];
		array_push($path, $path);

		$form_edit_setting[$length-1]['path'] = $path;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set ignore to save on form fields
	 * @method filePath
	 * @return void
	 */
	protected function formEditIgnore()
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);

		$ignore = $form_edit_setting[$length-1]['ignore'];
		array_push($ignore, $ignore);

		$form_edit_setting[$length-1]['ignore'] = true;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set multiple file  on form fields
	 * @method formEditMultiplefile
	 * @return void
	 */
	protected function formEditMultiplefile()
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);

		$multifile = $form_edit_setting[$length-1]['multifile'];
		array_push($multifile, $multifile);

		$form_edit_setting[$length-1]['multifile'] = true;
		$this->form_edit_setting = $form_edit_setting;

		return $this;
	}

	/**
	 * set options on form edit fields
	 * @method formEditOptions
	 * @param string $options
	 * @return void
	 */
	protected function formEditOptions($options)
	{
		$form_edit_setting = $this->form_edit_setting;
		$length = count($form_edit_setting);
		$form_edit_setting[$length-1]['options'] = $options;
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
			case 'image':
				$form = "uploadImage";
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

	/**
	 * cancel form
	 * @method cancelForm
	 */
	public function cancelForm()
	{
		if($this->form_mode == 'add'){
			foreach($this->form_add as $field => $value){
				if(isset($this->{$field."_files"})){
					$this->{$field."_files"} = [];
				}
			}
		}
		if($this->form_mode == 'edit'){
			foreach($this->form_edit as $field => $value){
				if(isset($this->{$field."_files"})){
					$this->{$field."_files"} = [];
				}
			}
		}
		$this->form_file = [];
		$this->lists();
	}

}
