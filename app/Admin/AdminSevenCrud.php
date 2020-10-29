<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;
use App\Admin\AdminSevenPaginate;
use App\Admin\AdminSevenFilters;

trait AdminSevenCrud{

	use AdminSevenPaginate,AdminSevenFilters;

	public $form = false;
	public $model = 'FakeTable';
	public $results;

	public function mount()
	{
		$this->getData();
	}

	public function getData()
	{
		if(isset($this->model))
		{
			$data = 'App\\Models\\'.$this->model;
			$data = $data::query();
			$data = $this->getFilter($data);
			$data = $data->paginate($this->perPage);

			$this->results = $data->items();
		}
	}
	
}