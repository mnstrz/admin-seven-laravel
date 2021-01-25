@php
  $id = rand(1,999999);
  $name = (isset($attributes['name'])) ? "image" : null;
@endphp
<div class="form-group row">
    <label class="col-12 col-lg-{{ $column[0] }}">{{ $label }}</label>
    <div class="col-12 col-lg-{{ $column[1] }}">
        <div class="mb-2" id="preview_image_{{$id}}" wire:ignore wire:key="{{ (isset($attributes['wire:model'])) ? $attributes['wire:model'] : null }}">
          @if($path)
            <img src="{{ $path }}" class="img-fluid">
          @endif
        </div>
        <div class="input-group">
          {{-- @if(!empty($path))
            <div class="input-group-prepend">
                <a href="{{ $path }}" class="btn btn-sm btn-outline-{!! (isset($attributes['color'])) ? $attributes['color'] : 'primary' !!} px-3" type="button">
                    <i class="fa fa-download"></i>
                </a>
            </div>
          @endif --}}
          <div class="custom-file">
            <input 
                type="file" 
                accept="image/*"
                id="upload_{{$id}}"
                class="upload_image form-control {!! (isset($attributes['class'])) ? $attributes['class'] : '' !!}"
                data-modal="modal_crop_{{$id}}"
                data-image="cropped_image_{{$id}}"
                data-text_blob="upload_croped_{{$id}}"
                data-preview_image="preview_image_{{$id}}"
            />
            <label class="custom-file-label" for="upload_{{$id}}">Choose image</label>
          </div>
          <div class="input-group-append">
            <span class="input-group-text bg-{!! (isset($attributes['color'])) ? $attributes['color'] : 'primary' !!}">
              <i class="far fa-image"></i>
            </span>
          </div>
        </div>
        <textarea 
          type="file"
          id="upload_croped_{{$id}}"
          hidden
          @foreach($attributes as $key => $value)
            {{ $key }} = "{{ $value }}"
          @endforeach
        /></textarea>
    	@isset($help)
    		<small class="form-text text-muted"><i class="fa fa-info-circle mr-2"></i>{{ $help }}</small>
    	@endisset
    </div>
</div>
<div class="modal fade modal-crop" id="modal_crop_{{$id}}">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Crop Image Before Upload</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="img-container">
                <div class="row">
                    <div class="col-md-6 mx-auto">
                        <img src="" id="cropped_image_{{$id}}" />
                    </div>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" id="crop" class="btn btn-primary">Crop</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
      </div>
    </div>
</div>
<script type="text/javascript">
  $(document).ready(function(e){
     var $modal = $('#modal_crop_{{$id}}');
     let image = document.getElementById('cropped_image_{{$id}}')
     var cropper, text_blob, preview_image

     $(document).on('change','.upload_image',function(e){
        var files = e.target.files;

        $modal = $('#'+$(this).data('modal'));
        image = document.getElementById(''+$(this).data('image'))
        text_blob = $(this).data('text_blob')
        preview_image = $(this).data('preview_image')

        var done = function(url){
          image.src = url;
          $modal.modal('show');
        };

        if(files && files.length > 0)
        {
          let reader = new FileReader();
          reader.onload = function(event)
          {
            done(reader.result);
          };
          reader.readAsDataURL(files[0]);
        }
     })

     $(document).on('shown.bs.modal','.modal-crop',function(e){
        cropper = new Cropper(image, {
          viewMode: 0,
          @foreach($setting as $key => $value)
            {{ $key.":".$value."," }}
          @endforeach
        });
     })

     $(document).on('hidden.bs.modal','.modal-crop',function(e){
        cropper.destroy();
        cropper = null;
     })

     $(document).on('click','#crop',function(e){
        let canvas = cropper.getCroppedCanvas().toDataURL();
        let is_livewire = "{{ (isset($attributes['wire:model'])) ? $attributes['wire:model'] : null }}"
        if(!is_livewire){
          is_livewire = "{{ (isset($attributes['wire:model.lazy'])) ? $attributes['wire:model.lazy'] : null }}"
        }
        if(is_livewire){
          let that = @this
          cropper.getCroppedCanvas().toBlob((blob) => {
            let data = {
              "file" : canvas,
              "type" : blob.type
            }
            that.set(is_livewire,data)
          })
        }

        html = '<img src="' + canvas + '" class="img-fluid"/>';
        $("#"+text_blob).val(canvas);
        $("#"+preview_image).html(html);

        $modal.modal('hide');
     })
  })
</script>