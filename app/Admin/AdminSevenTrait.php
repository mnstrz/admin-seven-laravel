<?php

namespace App\Admin;
use App\Models\Theme;

use Illuminate\Support\Facades\DB;

trait AdminSevenTrait{

	public function response($array=null){

		$respose = ['title','breadcrumb','page','plugins','css','js'];
		if($array != null){
			foreach($respose as $key => $value)
			{
				if(!in_array($key, $array)){
					${$key} = "";
				}
			}
			$respose = array_merge($respose,$array);
		}
		$respose = array_unique($respose);
		return $respose;
	}
}