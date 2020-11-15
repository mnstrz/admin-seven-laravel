@isset($height)
<div style="height: {{$height}}px; overflow: scroll;">
@else
<div class="table-responsive">
@endisset
	<table class="table {!! ($class) ? $class : '' !!}">
		{{ $slot }}
	</table>
</div>
@isset($pagination)
<div class="row mt-2">
	<div class="col-12">
		<ul class="pagination pagination-sm m-0 justify-content-{{$position}}" id="{{ $id }}">
        </ul>
	</div>
</div>
@push('js')
	<script type="text/javascript">
		paging('#{{$id}}',{!! json_encode($pagination) !!});
	</script>
@endpush
@endisset