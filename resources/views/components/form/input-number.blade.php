<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group">
            @isset($before)
                <div class="input-group-prepend">
                    <span class="input-group-text bg-{{ ($color) }}">
                        {!! $before !!}
                    </span>
                </div>
            @endisset
        	<input 
        		type="number" 
        		name="{{ $name }}"
        		class="form-control number {!! ($class) ? $class : '' !!}"
                {{ $attributes }}
        	/>
            @isset($after)
                <div class="input-group-append">
                    <span class="input-group-text bg-{{ ($color) }}">
                        {!! $after !!}
                    </span>
                </div>
            @endisset
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>
@push('js')
    <script type="text/javascript">
        $(document).on('keypress','.number',function(e)
        {
            var charCode = (e.which) ? e.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        })
    </script>
@endpush