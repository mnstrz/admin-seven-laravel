@isset($height)
<div style="height: {{$height}}px; overflow: scroll;">
@else
<div>
@endisset
	<table class="table {!! ($class) ? $class : '' !!}" id="{{$id}}">
		{{ $slot }}
	</table>
</div>
@push('js')
	<script type="text/javascript">
		$('#{{$id}}').DataTable({
	      "paging": true,
	      "lengthChange": false,
	      "ordering": true,
	      "info": true,
	      "autoWidth": false,
	      "responsive": true,
	    });
	</script>
@endpush