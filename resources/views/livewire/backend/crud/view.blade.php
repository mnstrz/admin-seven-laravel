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
@push('js')
  <script type="text/javascript">
    {!! $javascript !!}
  </script>
@endpush