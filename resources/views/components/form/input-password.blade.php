<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group">
            <input 
                type="password" 
                id="password_{{ $name }}"
                class="form-control {!! ($class) ? $class : '' !!}"
                {{ $attributes }}
            />
            <div class="input-group-append">
                <button class="btn btn-outline-{{ $color }}" type="button" id="password_button_{{ $name }}">
                    <i class="fa fa-eye-slash"></i>
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
        $(document).on('click','#password_button_{{ $name }}',function(e){
            let password = $("#password_{{ $name }}");
            if(password.attr("type") == "text"){
                password.attr("type","password");
                $(this).html(`<i class="fa fa-eye"></i>`);
            }else{
                password.attr("type","text");
                $(this).html(`<i class="fa fa-eye-slash"></i>`);
            }
        })
    </script>
@endpush