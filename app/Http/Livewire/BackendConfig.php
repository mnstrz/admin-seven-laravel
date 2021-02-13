<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Admin\AdminSevenCrud;

class BackendConfig extends Component
{
	use AdminSevenCrud;

	public function prepare()
	{
		$this->setModel('Models.Configuration');
		$this->canAdd(false);
		$this->canDelete(false);
		$this->disableFilter();
	}

	public function setFormEdit()
	{
		$this->formEditField('app_name','Application Name');
		$this->formEditField('website_domain','Website Domain');
		$this->formEditField('favicon','Website Favicon')
					->formEditColumn(3,3)
					->formEditType('image')
					->formEditFileDir('public/app')
					->formEditImageSetting(["aspectRatio" => "1/1"]);
		$this->formEditField('logo','Website Logo')
					->formEditColumn(3,3)
					->formEditType('image')
					->formEditFileDir('public/app')
					->formEditImageSetting(["aspectRatio" => "1/1"]);
		$this->formEditField('smtp_mail_server','SMTP Mail Server');
		$this->formEditField('smtp_mail_port','SMTP Mail Port');
		$this->formEditField('smtp_mail_username','SMTP Mail Username');
		$this->formEditField('smtp_mail_password','SMTP Mail Password');
		$this->formEditField('smtp_mail_name','SMTP Mail Sender Name');
		$this->formEditField('smtp_mail_address','SMTP Mail Address');
	}

	public function setLists()
	{
		$this->listField('logo','Logo')->listImage();
		$this->listField('favicon','Favicon')->listImage();
		$this->listField('app_name','Application Name');
		$this->listField('website_domain','Website Domain');
	}

	public function setView()
	{
		$javascript = "openMenu('Configurations');activeMenu('Application');";
		$this->addJavascript($javascript);
	}
}
