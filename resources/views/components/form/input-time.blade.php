<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group date" id="date_{{ $name }}" data-target-input="nearest">
            <input 
                type="text"
                class="form-control datetimepicker-input {!! ($class) ? $class : '' !!}"
                date-target="#date_{{ $name }}"
                {{ $attributes }}
            />
            <div class="input-group-append">
                <button class="btn btn-outline-{{ $color }}" type="button" data-target="#date_{{ $name }}" data-toggle="datetimepicker">
                    <i class="fa fa-clock"></i>
                </button>
            </div>
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>

@push('js')
    <script type="text/javascript">
        $('#date_{{$name}}').datetimepicker({
            format: 'hh:mm',
            minuteStep : 1
        });
    </script>
@endpush