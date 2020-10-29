<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="form-group clearfix">
          @foreach ($options as $val => $text)
              @php
                  $text = explode("|", $text);
              @endphp
              <div class="icheck-{{$color}} d-inline">
                <input 
                    type="checkbox" 
                    id="checkbox_{{$name}}_{{$val}}" 
                    value="{{$val}}"
                    {{ (in_array($val,$value)) ? 'checked' : '' }}
                    @foreach ($text as $d => $i)
                        {{ ($d != 0) ? $i : '' }}
                    @endforeach
                    {{ $attributes }}
                >
                <label for="checkbox_{{$name}}_{{$val}}">
                    {{$text[0]}}
                </label>
              </div>
          @endforeach
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>
@push('js')
    <script type="text/javascript">
        $('.select2').select2()
    </script>
@endpush