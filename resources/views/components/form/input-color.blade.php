<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group date" id="date_{{ $name }}" data-target-input="nearest">
            <div class="input-group-prepend">
                <span class="input-group-text px-4" id="bg_color_{{$name}}">
                    
                </span>
            </div>
             <input 
                type="text"
                class="form-control my-colorpicker {!! ($class) ? $class : '' !!}"
                {{ $attributes }}
                id="color_{{$name}}"
            />
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>
@push('js')
    <script type="text/javascript">
        $(document).on("change","#color_{{$name}}",function(e)
        {
            let val = $(this).val();
            $("#bg_color_{{$name}}").attr("style","background-color:"+val);
        })
    </script>
@endpush