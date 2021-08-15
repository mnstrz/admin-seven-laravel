$(document).ready(function () {

  if($('.date-picker').length > 0){
    $('.date-picker').datetimepicker({
        format: 'L'
    });
  }

	//$('.sidebar-menu').tree()
  if($('.select2').length > 0){
	 $('.select2').select2()
  }

  $('[data-tooltip="true"]').tooltip()


  $(document).on("click",'[data-tooltip="true"]',function(e){
    $(this).tooltip('hide');
  })

  if($('.select2bs4').length > 0){
    $('.select2bs4').select2({
        theme: 'bootstrap4'
    })
  }

  if($('.date-mask').length > 0){
  	$('.date-mask').inputmask('yyyy-dd-mm', { 
  		'placeholder': 'yyyy-dd-mm' 
  	})
  }

  if($('.date-mask2').length > 0){
  	$('.date-mask2').inputmask('yyyy-dd-mm', { 
  		'placeholder': 'yyyy-dd-mm' 
  	})
  }

  if($('[data-mask]').length > 0){
	 $('[data-mask]').inputmask()
  }

  if($('.date-range-picker').length > 0){
  	$('.date-range-picker').daterangepicker({
  		locale: { 
  			format: 'YYYY-MM-DD' 
  		}
  	})
  }

  if($('.date-range-time-picker').length > 0){
  	$('.date-range-time-picker').daterangepicker({ 
  		timePicker: true, 
  		timePickerIncrement: 1, 
  		timePicker24Hour : true,
  		locale: { 
  			format: 'YYYY-MM-DD hh:mm' 
  		}
  	})
  }

  if($('.date-range-btn').length > 0){
  	$('.date-range-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment(),
          locale: { 
  			format: 'YYYY-MM-DD' 
  		}
        },
        function (start, end) {
          $('.date-range-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        }
      )
  }

  if($('.my-colorpicker').length > 0){
    $('.my-colorpicker').colorpicker()
  }

  if($('.my-colorpicker2').length > 0){
    $('.my-colorpicker2').colorpicker()
  }

  if($('input[data-bootstrap-switch]').length > 0){
    $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
    });
  }

  if($('.summernote').length > 0){
    $('.summernote').summernote();
  }

});

function paging(element,data){

    var path = (data.path) ? data.path : '';
    var currentpage = (data.current_page) ? data.current_page : 1;
    var firstpage = (data.first_page) ? data.first_page : 1;
    var lastpage = (data.last_page) ? data.last_page : 10;
    var total = data.total;
    var perpage = (data.per_page) ? data.per_page : 10;

    var prevpage = (currentpage <= 1) ? 1 : currentpage-1;
    var nextpage = (currentpage >= lastpage) ? lastpage : currentpage+1;


    /*paging*/
     var delta = 2;
     var range = [];
     var rangeWithDots = [];
     var l;

     path = (path) ? path : "";
     currentpage = (currentpage) ? currentpage : 1;

      //navigation
      var button = ``;
      button +=`<li class="page-item">
                <button class="page-link nav-btn" data-page="${prevpage}" data-path="${path}">
                  &laquo;
                </button>
              </li>`;
      var active = '';

      for (let i = 1; i <= Math.ceil(total/perpage); i++) {
          if (i == 1 || i == Math.ceil(total/perpage) || i >= currentpage-delta && i < currentpage+delta+1) {
              range.push(i);
          }
      }

      for (let i of range) {
          if (l) {
              if (i - l === 2) {
                  rangeWithDots.push(l + 1);
              } else if (i - l !== 1) {
                  rangeWithDots.push('...');
              }
          }
          rangeWithDots.push(i);
          l = i;
      }

      $.each(rangeWithDots, function( i, v ) {
        active = (v == currentpage) ? "active" : '';
        dataPage = ($.isNumeric(v)) ? `data-page="${v}"` : '';
        button +=`<li class="page-item ${active}">
                    <button class="page-link nav-btn" ${dataPage} data-path="${path}">${v}</button>
                  </li>`;
      });

      button +=`<li class="page-item">
                  <button class="page-link nav-btn" data-page="${nextpage}" data-path="${path}">
                    &raquo;
                  </button>
                </li>`;

      if(total > 0){
        $(element).html(button);
      }

}

$(document).on('click','.nav-btn',function(e)
{
    let path = $(this).data('path');
    let page = $(this).data('page');
    window.location.href=path+'?page='+page;
})

function str_slug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}

function activeMenu(element)
{
  element = str_slug(element);
  setTimeout(function(){ 
    $(".menu-"+element).addClass('active');
  }, 1000);
}

function openMenu(element)
{
  element = str_slug(element);
  setTimeout(function(){ 
    $(".menu-"+element).addClass('active menu-open');
  }, 1000);
}

$(document).on('click','.btn-password',function(e){
    let id = $(this).data('id');
    if($('#'+id).attr("type") == "text"){
        $('#'+id).attr("type","password");
        $(this).html(`<i class="fa fa-eye"></i>`);
    }else{
        $('#'+id).attr("type","text");
        $(this).html(`<i class="fa fa-eye-slash"></i>`);
    }
})

function showToast(message,variant){
  if(variant == 'success'){
    toastr.success(message)
  }else if(variant == 'warning'){
    toastr.warning(message)
  }else if(variant == 'info'){
    toastr.info(message)
  }else if(variant == 'danger'){
    toastr.danger(message)
  }else if(variant == 'primary'){
    toastr.primary(message)
  }else if(variant == 'secondary'){
    toastr.secondary(message)
  }else{
    toastr.error(message)
  }
}