<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Admin\AdminSevenCrud;
use Illuminate\Support\Facades\Hash;

class BackendUser extends Component
{
	use AdminSevenCrud;

	public function prepare()
	{
		$this->setModel('User');
	}

	public function setView()
	{
		$javascript = "openMenu('Configurations');activeMenu('User');";
		$this->addJavascript($javascript);
	}

	public function setLists()
	{
		$this->listRelationTo('thisGroup');
		$this->listField('username','Username');
		$this->listField('email','Email');
		$this->listField('this_group.name','Group');
	}

	public function setForm()
	{
		$this->formWidth(6);
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
						->formType('password');
	}

	public function formStoring()
	{
		$user = new $this->model;
		$user->username = $this->form['username'];
		$user->email = $this->form['email'];
		$user->group = $this->form['group'];
		$user->password = Hash::make($this->form['password']);
		$user->save();
	}

	public function validateUpdate()
	{
		$this->validate([
			'form_edit.username' => 'required|unique:users,username,'.$this->selected_primary_key,
			'form_edit.email' => 'required|unique:users,email,'.$this->selected_primary_key,
			'form_edit.group' => 'required',
			'form_edit.password' => 'sometimes|min:6|confirmed'
		]);
	}

	public function formUpdating()
	{
		$user = $this->model::where($this->primary_key,$this->selected_primary_key)->first();

		if(!$user){
			abort('404');
		}

		$user->username = $this->form_edit['username'];
		$user->email = $this->form_edit['email'];
		$user->group = $this->form_edit['group'];
		if($this->form_edit['password']){
			$user->password = Hash::make($this->form_edit['password']);
		}
		$user->save();
	}

	public function setFilter()
	{
		$this->filter('username','Username');
		$this->filter('email','Email');
		$this->filter('thisGroup.id','Group')
			 ->filterType('select')
			 ->filterRelation('Models.Group','id','name');
	}

	public function setShow()
	{
		$this->showWidth(6);
		$this->showRelationTo('thisGroup');
		$this->showField('username','Username');
		$this->showField('email','Email');
		$this->showField('thisGroup.name','Group')->showFormat('label');
	}

	public function label($value)
	{
		return "<label class='badge bg-primary'>$value</label>";
	}
}
