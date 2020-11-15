@php
    $id = rand(1,999999);
@endphp
<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="input-group date" id="date_{{ $id }}" data-target-input="nearest">
            <input 
                type="text"
                date-target="#date_{{ $id }}"
                class="form-control datetimepicker-input {!! (isset($attributes['class'])) ? $attributes['class'] : '' !!}"
                @foreach($attributes as $key => $value)
                {{ $key }} = "{{ $value }}"
                @endforeach
            />
            <div class="input-group-append">
                <button class="btn btn-outline-{!! (isset($attributes['color'])) ? $attributes['color'] : 'primary' !!}" type="button" data-target="#date_{{ $id }}" data-toggle="datetimepicker">
                    <i class="fa fa-clock"></i>
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
        $('#date_{{$id}}').datetimepicker({
            format: 'hh:mm',
            minuteStep : 1
        });
    </script>
@endpush