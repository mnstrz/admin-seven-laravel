@php
    $color = (isset($attributes['color'])) ? $attributes['color'] : \AdminSeven::color();
    $class = (isset($attributes['class'])) ? $attributes['class'] : '';
    $default = (isset($attributes['value'])) ? $attributes['value'] : '';
    $enable_select2 = ($disable_select2 == true) ? 'select2' : 'custom-select'
@endphp
<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }} {{ (isset($color)) ? 'select2-'.$color : '' }}">
        <select 
            class="form-control {{ $enable_select2 }} {!! ($class) ? $class : '' !!} {{ (isset($color)) ? "select2-".$color : '' }}" 
            width="100%"
            @isset($color)
                data-dropdown-css-class="select2-{{$color}}"
            @endisset
            @foreach($attributes as $key => $value)
                {{ $key }} = "{{ $value }}"
            @endforeach
            data-placeholder="{{ ($attributes['placeholder']) ? $attributes['placeholder'] : '' }}"
        >
            <option hidden>Select One</option>
            @foreach($options as $val => $text)
                @php
                    $text = explode("|", $text);
                @endphp
                <option 
                    value="{{ $val }}" 
                    {{ ($default == $val) ? 'selected' : '' }}
                    @foreach ($text as $d => $i)
                        {{ ($d != 0) ? $i : '' }}
                    @endforeach
                >{{ $text[0] }}</option>
            @endforeach
        </select>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>
@push('js')
    <script type="text/javascript">
        $(document).ready(function() {
            $('.select2').select2()
            @if(isset($attributes['livewire']))
                @if($attributes['livewire'])
                    $('.select2').on('change', function (e) {
                        let elementName = $(this).attr('wire:model.lazy');
                        var data = $(this).select2("val");
                        @this.set(elementName, data);
                        setTimeout(function(){ 
                            $('.select2').select2() }, 
                        1500);
                    });
                @endif
            @endif
        });
    </script>
@endpush