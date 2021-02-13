<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group">
            @isset($attributes['before'])
                <div class="input-group-prepend">
                    {!! $attributes['before'] !!}
                </div>
            @endisset
        	<input 
        		type="text" 
                class="form-control number {!! (isset($attributes['class'])) ? $attributes['class'] : '' !!}"
                @foreach($attributes as $key => $value)
                {{ $key }} = "{{ $value }}"
                @endforeach
        	/>
            @isset($attributes['after'])
                <div class="input-group-append">
                    {!! $attributes['after'] !!}
                </div>
            @endisset
        </div>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>