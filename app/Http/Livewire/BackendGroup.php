<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Group;
use App\Admin\AdminSevenCrud;

class BackendGroup extends Component
{
	use AdminSevenCrud;

	public function __construct(){
		
		/**
		 * you can change default in here
		 * -------model-----------
		 * $this->model = '';

		 * -------pagination------
		 * $this->perPage = 10;
		 * $this->option_perpage = [1 => 1,3 => 3,4 => 4];
		 */
		$this->model = 'Group';
		$this->filter()->field('name');
	}

	/*
	 * filters
	 */
	public $filters = [
		'name' => 'text|like'
	];
	public $filter_name = '';

    public function render()
    {
        return view('livewire.backend.group');
    }
}
