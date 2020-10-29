<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group date" id="date_{{ $name }}" data-target-input="nearest">
            <div class="input-group-prepend">
                <span class="input-group-text bg-{{ $color }}">
                    <i class="fa fa-calendar-alt"></i>
                </span>
            </div>
            <input 
                type="text"
                class="form-control date-range-picker {!! ($class) ? $class : '' !!}"
                {{ $attributes }}
            />
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>