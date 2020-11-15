<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="form-group clearfix">
          <input 
            type="checkbox" 
            data-bootstrap-switch 
            data-off-color="{{ $color[0] }}" 
            data-on-color="{{ $color[1] }}"
            {{  ($default) ? 'checked' : '' }}
          >
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