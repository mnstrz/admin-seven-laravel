<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Admin\AdminSevenCrud;
use App\Models\GroupPermission;

class BackendPermission extends Component
{
	use AdminSevenCrud;

	public function prepare()
	{
		$this->setModel('Models.Permission');

		$this->listRelationTo('hasGroup');
		$this->listRelationTo('hasGroup.thisGroup');

		$this->showRelationTo('hasGroup');
		$this->showRelationTo('hasGroup.thisGroup');

		$this->formWidth(6);
		$this->showWidth(6);
	}

	public function setView()
	{
		$javascript = "openMenu('Configurations');activeMenu('Permission');";
		$this->addJavascript($javascript);
	}

	public function setShow()
	{
		$this->showField('name','Permission Name');
		$this->showField('url','URL');
		$this->showField('hasGroup','Group')
				->showFormat('getGroup');
	}

	public function setLists()
	{
		$this->listField('name','Permission Name');
		$this->listField('url','URL');
		$this->listField('hasGroup','Group')
						->listFormat('getGroup');
	}

	public function getGroup($groups)
	{
		$display = '';
		foreach($groups as $group){
			$name = $group['this_group']['name'];
			$display .= "<label class='badge bg-info mr-1'>$name</label>";
		}
		return $display;
	}

	public function setForm()
	{
		$this->formField('name','Permission Name');
		$this->formField('url','URL');
		$this->formField('group','Group')
						->formType('checkbox')
						->formRelation('Models.Group','id','name');
	}

	public function formStoring()
	{
		$data = new $this->model;
		$data->name = $this->form_add['name'];
		$data->url = $this->form_add['url'];
		$data->save();

		foreach($this->form_add['group'] as $group){
			$group_permission = new GroupPermission;
			$group_permission->permission = $data->id;
			$group_permission->group = $group;
			$group_permission->save();
		}
	}

	public function beforeAdd()
	{
		$this->form_add['group'] = [];
	}

	public function beforeEdit()
	{
		$group_permission = GroupPermission::where('permission',$this->selected_primary_key)->get();
		$form_group = [];
		foreach($group_permission as $group)
		{
			array_push($form_group, (string)$group->group);
		}
		$this->form_edit['group'] = $form_group;
	}

	public function formUpdating()
	{
		$data = $this->model::where($this->primary_key,$this->selected_primary_key)->first();
		if(!$data){
			abort('404');
		}
		$data->name = $this->form_edit['name'];
		$data->url = $this->form_edit['url'];
		$data->save();

		$group_permission = GroupPermission::where('permission',$data->id)->delete();
		foreach($this->form_edit['group'] as $group){
			$group_permission = new GroupPermission;
			$group_permission->permission = $data->id;
			$group_permission->group = $group;
			$group_permission->save();
		}
	}

	public function validateStore()
	{
		$this->validate([
			'form_add.name' => 'required|unique:permission,name'
		]);
	}

	public function validateUpdate()
	{
		$this->validate([
			'form_edit.name' => 'required|unique:permission,name,'.$this->selected_primary_key
		]);
	}

	public function afterDelete()
	{
		GroupPermission::where('permission',$this->selected_primary_key)->delete();
	}

	public function updatedFormAdd()
	{
		$this->form_add['group'] = $this->form_add['group'];
	}

	public function updatedFormEdit()
	{
		$this->form_edit['group'] = $this->form_edit['group'];
	}
}
