<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <textarea class="summernote {!! ($class) ? $class : '' !!}" {{ $attributes }} style="min-height: 300px">{{ ($attributes['value']) ? $attributes['value'] : '' }}</textarea>
    	@isset($help)
    	<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>