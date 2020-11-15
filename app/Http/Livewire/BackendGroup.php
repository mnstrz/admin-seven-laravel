<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Admin\AdminSevenCrud;

class BackendGroup extends Component
{
	use AdminSevenCrud;

	public function prepare()
	{
		$this->setModel('Models.Group');
	}

	public function setView()
	{
		$javascript = "openMenu('Configurations');activeMenu('Group');";
		$this->addJavascript($javascript);
	}

	public function setForm()
	{
		$this->formWidth(6);
		$this->formField('name','Nama Group');
	}

	public function setFormEdit()
	{
		$this->formEditField('name','Nama Group');
	}

	public function setShow()
	{
		$this->showField('name','Nama Group');
	}
}
