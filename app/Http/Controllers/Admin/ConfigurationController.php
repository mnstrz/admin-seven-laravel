<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    protected $title = 'Configuration';
	protected $breadcrumb = [
		'Configuration' => '#'
	];

	/**
     * @method group
     * @return void
     */
    public function group()
    {
    	$title = 'Group '.$this->title;
    	$breadcrumb = [
    		'Configuration' => '#',
    		'Group' => route('backend.group')
    	];
    	$livewire = "backend-group";
      	$plugins = "formAdvance formEditor tableSimple";

    	$response = [
    		'title','breadcrumb','livewire','plugins'
    	];
    	return view('admin-seven',compact($response));
    }
}
