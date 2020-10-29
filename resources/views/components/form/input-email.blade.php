<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <input 
            type="email" 
            class="form-control {!! ($class) ? $class : '' !!}"
            {{ $attributes }}
        />
        @isset($help)
            <small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
        @endisset
    </div>
</div>