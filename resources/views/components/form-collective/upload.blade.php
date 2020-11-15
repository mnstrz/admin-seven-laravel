@php
  $id = rand(1,999999);
@endphp
<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group">
          @if(!empty($path))
            <div class="input-group-prepend">
                <a href="{{ $path }}" class="btn btn-sm btn-outline-{!! (isset($attributes['color'])) ? $attributes['color'] : 'primary' !!} px-3" type="button">
                    <i class="fa fa-download"></i>
                </a>
            </div>
          @endif
          <div class="custom-file">
            <input 
                type="file" 
                id="upload_{{$id}}"
                class="form-control {!! (isset($attributes['class'])) ? $attributes['class'] : '' !!}"
                @foreach($attributes as $key => $value)
                  {{ $key }} = "{{ $value }}"
                @endforeach
            />
            <label class="custom-file-label" for="upload_{{$id}}">Choose file</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text bg-{!! (isset($attributes['color'])) ? $attributes['color'] : 'primary' !!}">Upload</span>
          </div>
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>