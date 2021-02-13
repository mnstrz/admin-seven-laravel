@php
    $id = rand(1,9999999);
@endphp
<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group date" id="date_{{ $id }}" data-target-input="nearest">
            <div class="input-group-prepend">
                <span class="input-group-text bg-{!! (isset($attributes['color'])) ? $attributes['color'] : \AdminSeven::color() !!}">
                    <i class="fa fa-clock"></i>
                </span>
            </div>
            <input 
                type="text"
                class="form-control date-range-time-picker {!! (isset($attributes['class'])) ? $attributes['class'] : '' !!}"
                @foreach($attributes as $key => $value)
                {{ $key }} = "{{ $value }}"
                @endforeach
            />
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>