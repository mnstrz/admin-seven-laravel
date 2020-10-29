<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Theme;

class ThemingController extends Controller
{
	protected $title = 'Theming';
	protected $breadcrumb = [
		'Theming' => '#'
	];

    /**
     * use plugins here
     * use space delimiter if wanna use more than one plugin
     * see documentation adminLTE official
     * - dashboard1     --> Dashboard 1
       - dashboard2     --> Dashboard 2
       - dashboard3     --> Dashboard 3
       - chart          --> ChartJs
       - flot           --> Chart Flot
       - inline         --> Chart Inline
       - slider         --> Sliders
       - formGeneral    --> Form General
       - formAdvance    --> Form Advance
       - formEditor     --> Form Editor
       - tableSimple    --> Table Simple
       - tableDatatable --> Datatables
       - tableJsgrid    --> Table JsGrid
       - calendar       --> Calendar
       - galery         --> Galery
     */
    protected $plugins = "";
    /**
     * extended your css here
     * use delimter ; if more than one css
     */
    protected $css = "";
    /**
     * extended your js here
     * use delimter ; if more than one js
     */
    protected $js = "";

    /**
     * @method update
     * @return void
     */
    public function index()
    {
    	$title = $this->title;
    	$breadcrumb = $this->breadcrumb;
    	$livewire = "theming";
      $plugins = "dashboard1";
      $css = $this->css;
      $js = $this->js;

    	$response = [
    		'title','breadcrumb','livewire','plugins','css','js'
    	];
    	return view('admin-seven',compact($response));
    }
}
