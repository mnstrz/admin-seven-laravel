<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Js extends Component
{
    protected $this_js = [];

    /* @param Array $default */
    protected $default = [
        'plugins/jquery/jquery.min.js',
        'plugins/jquery-ui/jquery-ui.min.js',
        'plugins/bootstrap/js/bootstrap.bundle.min.js',
        'plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js',
        'plugins/sweetalert2/sweetalert2.min.js',
        'plugins/toastr/toastr.min.js'
    ];

    protected $adminlte = [
        'dist/js/adminlte.js',
        'dist/js/init.js'
        //'dist/js/demo.js'
    ];

    protected $dashboard1 = [
        'plugins/sparklines/sparkline.js',
        'plugins/jqvmap/jquery.vmap.min.js',
        'plugins/jqvmap/maps/jquery.vmap.usa.js',
        'plugins/jquery-knob/jquery.knob.min.js',
        'plugins/moment/moment.min.js',
        'plugins/daterangepicker/daterangepicker.js',
        'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'plugins/summernote/summernote-bs4.min.js',
        //'dist/js/pages/dashboard.js'
    ];

    protected $dashboard2 = [
        'plugins/jquery-mousewheel/jquery.mousewheel.js',
        'plugins/raphael/raphael.min.js',
        'plugins/raphael/raphael.min.js',
        'plugins/jquery-mapael/jquery.mapael.min.js',
        'plugins/jquery-mapael/maps/usa_states.min.js',
        'plugins/chart.js/Chart.min.js',
        //'dist/js/pages/dashboard2.js'
    ];

    protected $dashboard3 = [
        'plugins/chart.js/Chart.min.js',
        //'dist/js/pages/dashboard3.js'
    ];

    protected $chart = [
        'plugins/chart.js/Chart.min.js'
    ];

    protected $flot = [
        'plugins/flot/jquery.flot.js',
        'plugins/flot/plugins/jquery.flot.resize.js',
        'plugins/flot/plugins/jquery.flot.pie.js'
    ];

    protected $inline = [
        'plugins/jquery-knob/jquery.knob.min.js',
        'plugins/sparklines/sparkline.js'
    ];

    protected $slider = [
        'plugins/ion-rangeslider/js/ion.rangeSlider.min.js',
        'plugins/bootstrap-slider/bootstrap-slider.min.js'
    ];

    protected $formGeneral = [
        'plugins/bs-custom-file-input/bs-custom-file-input.min.js',
        'plugins/jquery-validation/jquery.validate.min.js',
        'plugins/jquery-validation/additional-methods.min.js',
    ];

    protected $formAdvance = [
        'plugins/select2/js/select2.full.min.js',
        'plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js',
        'plugins/moment/moment.min.js',
        'plugins/inputmask/jquery.inputmask.min.js',
        'plugins/daterangepicker/daterangepicker.js',
        'plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js',
        'plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js',
        'plugins/bootstrap-switch/js/bootstrap-switch.min.js',
        'plugins/bs-custom-file-input/bs-custom-file-input.min.js',
        'plugins/bs-stepper/js/bs-stepper.min.js',
        'plugins/dropzone/min/dropzone.min.js',
        'plugins/jquery-validation/jquery.validate.min.js',
        'plugins/jquery-validation/additional-methods.min.js',
        'plugins/cropperjs/dist/cropper.js'
    ];

    protected $formEditor = [
        'plugins/summernote/summernote-bs4.min.js',
        'plugins/codemirror/codemirror.js',
        'plugins/codemirror/mode/css/css.js',
        'plugins/codemirror/mode/xml/xml.js',
        'plugins/codemirror/mode/htmlmixed/htmlmixed.js',
        //'dist/js/form-editor.js'
    ];

    protected $tableSimple = [];

    protected $tableDatatable = [
        'plugins/datatables/jquery.dataTables.min.js',
        'plugins/datatables-bs4/js/dataTables.bootstrap4.min.js',
        'plugins/datatables-responsive/js/dataTables.responsive.min.js',
        'plugins/datatables-responsive/js/responsive.bootstrap4.min.js',
        'dist/js/datatable.js'
    ];

    protected $tableJsgrid = [
        'plugins/jsgrid/demos/db.js',
        'plugins/jsgrid/jsgrid.min.js',
        'dist/js/jsgrid.js'
    ];

    protected $calendar = [
        'plugins/moment/moment.min.js',
        'plugins/fullcalendar/main.min.js',
        'plugins/fullcalendar-daygrid/main.min.js',
        'plugins/fullcalendar-timegrid/main.min.js',
        'plugins/fullcalendar-interaction/main.min.js',
        'plugins/fullcalendar-bootstrap/main.min.js'
    ];

    protected $galery = [
        'plugins/ekko-lightbox/ekko-lightbox.min.js',
        'plugins/filterizr/jquery.filterizr.min.js'
    ];

    protected $js = [];
    public $renders = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($js=null,$plugins=null)
    {
       $this->js = $js;
       $this->this_js = array_merge($this->this_js, $this->default);
       if($plugins != null)
       {
         $modes = explode(' ', $plugins);
         foreach($modes as $key => $value)
         {
            if(isset($this->{$value})){
                $this->this_js = array_merge($this->this_js, $this->{$value});
            }
         }
       }
       $this->this_js = array_merge($this->this_js, $this->adminlte);
       $this->this_js = array_unique($this->this_js);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        foreach($this->this_js as $key => $value){
            if(strpos($value, 'http') !== false){
                $this->renders .= '<script src="'.$value.'"></script>
                ';
            }else{
                $this->renders .= '<script src="'.asset('admin/'.$value).'"></script>
                ';
            }
        }
        $extended_css = explode(';', $this->js);
        foreach ($extended_css as $key => $value) {
            if($value != '')
            {
                $this->renders .= '<script src="'.$value.'"></script>
                ';
            }
        }
        return view('components.js');
    }
}
