<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminSevenController extends Controller
{
	/**
     * download file
     * @param $metafile
     * @return file
	 */
    public function download($metafile){
    	$metafile = base64_decode($metafile);
    	$metafile = json_decode($metafile);

    	$model = $metafile->model;
    	$primary_key = $metafile->primary_key;
    	$selected_primary_key = $metafile->selected_primary_key;
    	$field = $metafile->field;
    	$key = isset($metafile->key) ? $metafile->key : null;

    	$data = $model::where($primary_key,$selected_primary_key)->first();
    	if(!$data){
    		abort('404');
    	}
    	if($key){
    		$data_path = json_decode($data->{$field});
    		$data_path = $data_path[$key];
    	}else{
    		$data_path = $data->{$field};
    	}
    	return \Storage::download($data_path);
    }
}
