<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Admin\AdminSevenCrud;
use Illuminate\Support\Facades\Hash;

class BackendUser extends Component
{
	use AdminSevenCrud;

	public $avatar_files = [];

	public function prepare()
	{
		$this->setModel('User');
	}

	public function setView()
	{
		$javascript = "openMenu('Configurations');activeMenu('User');";
		$this->addJavascript($javascript);
	}

	public function setForm()
	{
		$this->formWidth(6);
		$this->formField('avatar','Avatar')
						->formType('image')
						->formFileDir('public/avatar')
						->formImageSetting(["aspectRatio" => "1/1"]);
		$this->formField('username','Username')
						->formValidate('required|unique:users,username');
		$this->formField('email','Email')
						->formType('email')
						->formValidate('required|unique:users,email');
		$this->formField('group','Group')
						->formType('select')
						->formRelation('Models.Group','id','name');
		$this->formField('password','Password')
						->formType('password')
						->formValidate('required|min:6|confirmed')
						->formValue("");
		$this->formField('password_confirmation','Ulangi Password')
						->formType('password')
						->formIgnore();
	}

	public function beforeStore(){
		
	}

	public function validateUpdate()
	{
		$this->validate([
			'form_edit.username' => 'required|unique:users,username,'.$this->selected_primary_key,
			'form_edit.email' => 'required|unique:users,email,'.$this->selected_primary_key,
			'form_edit.group' => 'required'
		]);
		if($this->form_edit['password']){
			$this->validate([
				'form_edit.password' => 'min:6|confirmed'
			]);
		}
	}

	public function setFilter()
	{
		$this->filter('username','Username');
		$this->filter('email','Email');
		$this->filter('thisGroup.id','Group')
			 ->filterType('select')
			 ->filterRelation('Models.Group','id','name');
	}

	public function setLists()
	{
		$this->listRelationTo('thisGroup');
		$this->listField('avatar','Avatar')->listImage();
		$this->listField('username','Username');
		$this->listField('email','Email');
		$this->listField('this_group.name','Group')->listBadge();
	}

	public function setShow()
	{
		$this->showWidth(6);
		$this->showRelationTo('thisGroup');
		$this->showField('avatar','Avatar')->showAsImage();
		$this->showField('username','Username');
		$this->showField('email','Email');
		$this->showField('thisGroup.name','Group')->showAsBadge();
	}

	public function label($value)
	{
		return "<label class='badge bg-primary'>$value</label>";
	}
}
