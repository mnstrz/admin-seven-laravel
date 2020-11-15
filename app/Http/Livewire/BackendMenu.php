<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Admin\AdminSevenCrud;

class BackendMenu extends Component
{
	use AdminSevenCrud;

	public function prepare()
	{
		$this->setModel('Models.Menu');
	}
}
