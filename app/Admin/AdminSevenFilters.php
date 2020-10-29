<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;

trait AdminSevenFilters{

	public $filter_field = [];
	public $filter_type = [];
	public $filter_relation = [];

	public function filter()
	{
		return $this;
	}

	public function field($name)
	{
		$this->filter_field[] = $name;
		dd($this->filter_field);
		return $this;
	}

	public function getFilter($data)
	{
		foreach($this->filters as $key => $value)
		{
			if(!isset($this->{'filter_'.$key})){
				dd("Variable ".'$'."filter_".$key." doesn't exists OR hasn't default value on your main CRUD controller");
			}
			if($this->{'filter_'.$key} != null && $this->{'filter_'.$key} != '')
			{
				switch ($value) {
					case 'like':
						$data = $data->where($key,$value,'%'.$this->{'filter_'.$key}.'%');
					break;
					default:
						$data = $data->where($key,$value,$this->{'filter_'.$key});
					break;
				}
			}
		}
		return $data;
	}

}