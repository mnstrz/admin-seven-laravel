<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use App\Admin\AdminSevenLists;
use App\Admin\AdminSevenFilters;
use App\Admin\AdminSevenPaginate;
use App\Admin\AdminSevenForm;
use App\Admin\AdminServenMessage;
use App\Admin\AdminSevenMessage;
use App\Admin\AdminSevenFilename;
use App\Admin\AdminSevenFormat;

trait AdminSevenCrud{

	use AdminSevenLists,AdminSevenPaginate,AdminSevenFilters,AdminSevenForm,AdminSevenShow,AdminSevenMessage,WithFileUploads,AdminSevenFilename,AdminSevenFormat;

	public $view = "list";
	public $model = 'App\\Models\\FakeTable';
	public $primary_key = "id";
	public $selected_primary_key = null;
	public $additionalElement = [];
	public $javascript = '';
	public $modul_name = '';
	public $loading = false;
	public $url_permission = true;

	public function mount()
	{
		$this->prepare();
		if($this->url_permission){
			\AdminSeven::urlPermission();
		}
		$this->setRelation();
		$this->setFilter();
		$this->setLists();
		$this->setPagination();
		$this->setAction();
		$this->checkActions();
		$this->setView();
		$this->setForm();
		$this->setFormEdit();
		$this->setShow();
		$this->moduleName();
		$this->getData();
	}

	public function moduleName($name=null){
		if($name){
			$this->modul_name = $name;
		}else{
			$data = new $this->model;
			$table = $data->getTable();
			$this->modul_name = \Str::title(str_replace("_","",$table));
		}
	}

	/**
	 * prepare
	 * @method setModel
	 * @return void
	 */
	protected function prepare()
	{

	}

	/**
	 * set model name
	 * @method setModel
	 * @param string $model
	 * @return void
	 */
	protected function setModel($model)
	{
		$model = str_replace(".",'\\', $model);
		$this->model = 'App\\'.$model;
	}

	/**
	 * set relation table
	 * @method setModel
	 * @return void
	 */
	protected function setRelation()
	{

	}

	/**
	 * set view
	 * @method setView
	 * @return void
	 */
	protected function setView()
	{

	}

	/**
	 * add Element
	 *
	 * @method addElement
	 * @return void
	 */
	public function addElement($path)
	{
		$additionalElement = $this->additionalElement;
		array_push($additionalElement, $path);
		$this->additionalElement = $additionalElement;
	}

	public function render()
    {
        return view('livewire.backend.crud.view');
    }

    public function addJavascript($javascript)
    {
    	$this->javascript = $javascript;
    	return $this;
    }
}
