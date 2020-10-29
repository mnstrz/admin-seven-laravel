<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group">
          @if(!empty($path)))
            <div class="input-group-prepend">
                <a href="{{ $path }}" class="btn btn-sm btn-outline-{{ $color }} px-3" type="button">
                    <i class="fa fa-download"></i>
                </a>
            </div>
          @endif
          <div class="custom-file">
            <input 
                type="file" 
                id="upload_{{$name}}"
                class="form-control {!! ($class) ? $class : '' !!}"
                {{ $attributes }}
            />
            <label class="custom-file-label" for="upload_{{$name}}">Choose file</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text bg-{{$color}}">Upload</span>
          </div>
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>