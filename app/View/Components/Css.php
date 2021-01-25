<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Css extends Component
{
    /* @param Array $default */
    protected $this_css = [];

    protected $adminlte = [
        'dist/css/adminlte.min.css',
        'dist/css/adminSeven.css'
    ];

    protected $default = [
        'https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback',
        'plugins/fontawesome-free/css/all.min.css',
        'https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css',
        'plugins/pace-progress/themes/black/pace-theme-flat-top.css',
        'plugins/overlayScrollbars/css/OverlayScrollbars.min.css',
        'plugins/flag-icon-css/css/flag-icon.min.css',
        'plugins/fontawesome-free/css/all.min.css',
        'plugins/sweetalert2/sweetalert2.min.css',
        'plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css',
        'plugins/toastr/toastr.min.css',
        'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
    ];

    protected $dashboard1 = [
        'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'plugins/summernote/summernote-bs4.min.css'
    ];

    protected $dashboard2 = [];

    protected $dashboard3 = [];

    protected $chart = [];

    protected $flot = [];

    protected $inline = [];

    protected $slider = [
        'plugins/ion-rangeslider/css/ion.rangeSlider.min.css',
        'plugins/bootstrap-slider/css/bootstrap-slider.min.css'
    ];

    protected $formGeneral = [];

    protected $formAdvance = [
        'plugins/daterangepicker/daterangepicker.css',
        'plugins/icheck-bootstrap/icheck-bootstrap.min.css',
        'plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css',
        'plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css',
        'plugins/select2/css/select2.min.css',
        'plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css',
        'plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css',
        'plugins/bs-stepper/css/bs-stepper.min.css',
        'plugins/dropzone/min/dropzone.min.css',
        'plugins/cropperjs/dist/cropper.css'
    ];

    protected $formEditor = [
        'plugins/summernote/summernote-bs4.min.css',
        'plugins/codemirror/codemirror.css',
        'plugins/codemirror/theme/monokai.css',
        //'plugins/simplemde/simplemde.min.css'
    ];

    protected $tableSimple = [];

    protected $tableDatatable = [
        'plugins/datatables-bs4/css/dataTables.bootstrap4.min.css',
        'plugins/datatables-responsive/css/responsive.bootstrap4.min.css'
    ];

    protected $tableJsgrid = [
        'plugins/jsgrid/jsgrid.min.css',
        'plugins/jsgrid/jsgrid-theme.min.css'
    ];

    protected $calendar = [
        'plugins/fullcalendar/main.min.css',
        'plugins/fullcalendar-daygrid/main.min.css',
        'plugins/fullcalendar-timegrid/main.min.css',
        'plugins/fullcalendar-bootstrap/main.min.css'
    ];

    protected $galery = [
        'plugins/ekko-lightbox/ekko-lightbox.css'
    ];

    protected $css = [];
    public $renders = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($css=null,$plugins=null)
    {
       $this->css = $css;
       $this->this_css = array_merge($this->this_css, $this->default);
       if($plugins != null)
       {
         $modes = explode(' ', $plugins);
         foreach($modes as $key => $value)
         {
            if(isset($this->{$value})){
                $this->this_css = array_merge($this->this_css, $this->{$value});
            }
         }
       }
       $this->this_css = array_merge($this->this_css, $this->adminlte);
       $this->this_css = array_unique($this->this_css);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        foreach($this->this_css as $key => $value){
            if(strpos($value, 'http') !== false){
                $this->renders .= '<link rel="stylesheet" href="'.$value.'">
                ';
            }else{
                $this->renders .= '<link rel="stylesheet" href="'.asset('admin/'.$value).'">
                ';
            }
        }
        $extended_css = explode(';', $this->css);
        foreach ($extended_css as $key => $value) {
            if($value != '')
            {
                $this->renders .= '<link rel="stylesheet" href="'.$value.'">
                ';
            }
        }
        return view('components.css');
    }
}
