@php
    $id = rand(1,9999999);
@endphp
<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group">
            <input 
                type="password" 
                id="password_{{ $id }}"
                wire:ignore
                class="form-control {!! (isset($attributes['class'])) ? $attributes['class'] : '' !!}"
                @foreach($attributes as $key => $value)
                {{ $key }} = "{{ $value }}"
                @endforeach
            />
            <div class="input-group-append">
                <button class="btn btn-outline-{!! (isset($attributes['color'])) ? $attributes['color'] : 'primary' !!} btn-password" type="button" data-id="password_{{ $id }}">
                    <i class="fa fa-eye-slash"></i>
                </button>
            </div>
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>