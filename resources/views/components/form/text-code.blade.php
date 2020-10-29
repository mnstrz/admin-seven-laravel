<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <textarea id="{{$id}}" class="{!! ($class) ? $class : '' !!}" {{ $attributes }} style="min-height: 300px">{{ ($attributes['value']) ? $attributes['value'] : '' }}</textarea>
    	@isset($help)
    	<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>
@push('js')
    <script type="text/javascript">
        CodeMirror.fromTextArea(document.getElementById("{{$id}}"), {
          mode: "htmlmixed",
          theme: "monokai"
        });
    </script>
@endpush