<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminSevenCrudModel;

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

    /**
     * admin seven crator
     * @return view
     */
    public function creator()
    {
        $title = 'Creator';
        $breadcrumb = [
            'Configuration' => '#',
            'Creator' => route('backend.creator')
        ];
        $livewire = "creator.admin-seven-creator";
        $plugins = "formAdvance formEditor tableSimple";

        $response = [
            'title','breadcrumb','livewire','plugins'
        ];
        return view('admin-seven',compact($response));
    }

    /**
     * admin seven crator
     * @return view
     */
    public function newCreator()
    {
        $title = 'New Creator';
        $breadcrumb = [
            'Configuration' => '#',
            'Creator' => route('backend.creator'),
            'New' => route('backend.new.creator')
        ];
        $livewire = "creator.admin-seven-form-creator";
        $plugins = "formAdvance formEditor tableSimple";

        $response = [
            'title','breadcrumb','livewire','plugins'
        ];
        return view('admin-seven',compact($response));
    }

    /**
     * admin seven crator
     * @return view
     */
    public function editCreator($id)
    {
        $title = 'Edit Creator';
        $breadcrumb = [
            'Configuration' => '#',
            'Creator' => route('backend.creator'),
            'Edit' => route('backend.edit.creator',[$id])
        ];
        $livewire = "creator.admin-seven-form-creator";
        $plugins = "formAdvance formEditor tableSimple";

        $response = [
            'title','breadcrumb','livewire','plugins'
        ];
        return view('admin-seven',compact($response));
    }

    /**
     * admin seven form creator
     * @method makeCreator
     * @return void
     */
    public function makeCreator($crud_slug)
    {
        $creator = AdminSevenCrudModel::where('crud_slug',$crud_slug)->first();
        if(!$creator){
            abort('404');
        }
        $title = $creator->crud_name;
        $breadcrumb = [
            'Creator' => '#',
            $title => route('backend.creator.make',$crud_slug)
        ];
        $livewire = "creator.make-creator";
        $plugins = "formAdvance formEditor tableSimple";

        $response = [
            'title','breadcrumb','livewire','plugins'
        ];
        return view('admin-seven',compact($response));
    }
}
