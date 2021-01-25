<div class="row">

  @if($view == "list")
	<section class="col-lg-3">
		<x-card :title="'Filter'">
			{!! $this->renderFilter() !!}
		</x-card>
	</section>
  	@include('livewire.backend.crud.lists')
  @elseif($view == "form")
	  @include('livewire.backend.crud.form')
  @elseif($view == "show")
    @include('livewire.backend.crud.show')
  @endif


  
  @if(count($additionalElement) > 0)
  	@foreach ($additionalElement as $key => $row)
  	 @include($row);
  	@endforeach
  @endif
</div>
@push('insert-content')
  <div class='modal fade show-image-box' tabindex='-1' role='dialog' aria-hidden='true'>
    <div class='modal-dialog'>
      <div class='modal-content'>
        <div class='modal-header'>
          <h5 class='modal-title'>Image</h5>
          <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
            <span aria-hidden='true'>&times;</span>
          </button>
        </div>
        <div class='modal-body'>
          <div class="row">
            <div class="col">
              <img src='' class='img-fluid img-thumbnail mx-auto w-100' id='show-image-path'>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endpush
@push('js')
  <script type="text/javascript">
    {!! $javascript !!}
    $(document).on("click",'.show-image',function(){
       let path = $(this).data('path')
       $('#show-image-path').attr('src',path)
       $('.show-image-box').modal('show')
    })
  </script>
@endpush