@php
  $id = rand(1,999999);
@endphp
<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="form-group clearfix">
          @foreach ($options as $val => $text)
              @php
                  $text = explode("|", $text);
              @endphp
              <div class="icheck-{!! (isset($attributes['color'])) ? $attributes['color'] : 'primary' !!} d-inline">
                <input 
                    type="checkbox" 
                    id="checkbox_{{$id}}_{{$val}}" 
                    value="{{$val}}"
                    {{ (in_array($val,$values)) ? 'checked' : '' }}
                    @foreach ($text as $d => $i)
                        {{ ($d != 0) ? $i : '' }}
                    @endforeach
                    @foreach($attributes as $key => $value)
                    {{ $key }} = "{{ $value }}"
                    @endforeach
                >
                <label for="checkbox_{{$id}}_{{$val}}">
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