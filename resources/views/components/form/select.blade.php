<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }} {{ (isset($color)) ? 'select2-'.$color : '' }}">
        <select 
            class="form-control select2 {!! ($class) ? $class : '' !!} {{ (isset($color)) ? "select2-".$color : '' }}" 
            width="100%"
            @isset($color)
                data-dropdown-css-class="select2-{{$color}}"
            @endisset
            {{ $attributes }}
            data-placeholder="{{ ($attributes['placeholder']) ? $attributes['placeholder'] : '' }}"
        >
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
            $('.select2').on('change', function (e) {
                let elementName = $(this).attr('name');
                var data = $(this).select2("val");
                @this.set(elementName, data);
                setTimeout(function(){ $('.select2').select2() }, 1000);
            });
        });
    </script>
@endpush