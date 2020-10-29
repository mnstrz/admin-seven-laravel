<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin\AdminSevenTrait;

use App\Models\FakeTable;

class TemplateController extends Controller
{
    use AdminSevenTrait;

	protected $title = 'Template';
    protected $breadcrumb = [
        'Template' => '#'
    ];

    /**
     * use plugins here
     * use space delimiter if want to use more than one plugin
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
    public function dashboard()
    {
        $title = $this->title;
        $breadcrumb = $this->breadcrumb;
        $page = "admin.template.dashboard";
        $plugins = $this->plugins;
        $css = $this->css;
        $js = $this->js;

        $response = [
            'title','breadcrumb','page','plugins','css','js'
        ];
        return view('admin-seven',compact($response));
    }

    /**
     * @method form
     * @return void
     */
    public function form()
    {
        $title = $this->title.' Form';
        $breadcrumb = [
            'Theming' => route('template.dashboard'),
            'Form' => '#'
        ];
        $page = 'admin.template.form';
        $plugins = 'formAdvance formEditor';

        $response = [
            'title','breadcrumb','page','plugins'
        ];
        return view('admin-seven',compact($response));
    }

    /**
     * @method table
     * @return void
     */
    public function table()
    {
        $title = $this->title.' Table';
        $breadcrumb = [
            'Theming' => route('template.dashboard'),
            'Form' => '#'
        ];
        $page = 'admin.template.table';
        $plugins = 'tableSimple tableDatatable tableJsgrid';

        $response = [
            'title','breadcrumb','page','plugins'
        ];
        return view('admin-seven',compact($response));
    }
}
