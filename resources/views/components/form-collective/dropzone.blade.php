@php
  $name = rand(1,9999);
@endphp
<div id="dropzone_{{$name}}">
  <div id="actions_{{$name}}" class="row">
      <div class="col-lg-6">
        <div class="btn-group w-100">
          <span class="btn btn-success col fileinput-button">
            <i class="fas fa-plus"></i>
            <span>Add files</span>
          </span>
          <button type="submit" class="btn btn-primary col start">
            <i class="fas fa-upload"></i>
            <span>Start upload</span>
          </button>
          <button type="reset" class="btn btn-warning col cancel">
            <i class="fas fa-times-circle"></i>
            <span>Cancel upload</span>
          </button>
        </div>
      </div>
      <div class="col-lg-6 d-flex align-items-center">
        <div class="fileupload-process w-100">
          <div id="total-progress_{{$name}}" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
          </div>
        </div>
      </div>
    </div>
    <div class="table table-striped files" id="previews_{{$name}}">
      <div id="template_{{$name}}" class="row mt-2">
        <div class="col-auto">
            <span class="preview"><img src="data:," alt="" data-dz-thumbnail /></span>
        </div>
        <div class="col d-flex align-items-center">
            <p class="mb-0">
              <span class="lead" data-dz-name></span>
              (<span data-dz-size></span>)
            </p>
            <strong class="error text-danger" data-dz-errormessage></strong>
        </div>
        <div class="col-4 d-flex align-items-center">
            <div class="progress progress-striped active w-100" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
              <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
            </div>
        </div>
        <div class="col-auto d-flex align-items-center">
          <div class="btn-group">
            <button class="btn btn-primary start">
              <i class="fas fa-upload"></i>
              <span>Start</span>
            </button>
            <button data-dz-remove class="btn btn-warning cancel">
              <i class="fas fa-times-circle"></i>
              <span>Cancel</span>
            </button>
            <button data-dz-remove class="btn btn-danger delete">
              <i class="fas fa-trash"></i>
              <span>Delete</span>
            </button>
          </div>
        </div>
      </div>
    </div>
</div>
@push('js')
  <script type="text/javascript">
    // DropzoneJS Demo Code Start
    Dropzone.autoDiscover = false;

    // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
    var previewNode = document.querySelector("#template_{{$name}}");
    previewNode.id = "";
    var previewTemplate = previewNode.parentNode.innerHTML;
    previewNode.parentNode.removeChild(previewNode);

    var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
      url: "{{ (isset($attributes['path_upload'])) ? $attributes['path_upload'] : '/' }}", // Set the url
      thumbnailWidth: 80,
      thumbnailHeight: 80,
      parallelUploads: 20,
      previewTemplate: previewTemplate,
      autoQueue: false, // Make sure the files aren't queued until manually added
      previewsContainer: "#previews_{{$name}}", // Define the container to display the previews
      clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
    });

    myDropzone.on("addedfile", function(file) {
      // Hookup the start button
      file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
    });

    // Update the total progress bar
    myDropzone.on("totaluploadprogress", function(progress) {
      document.querySelector("#total-progress_{{$name}} .progress-bar").style.width = progress + "%";
    });

    myDropzone.on("sending", function(file) {
      // Show the total progress bar when upload starts
      document.querySelector("#total-progress_{{$name}}").style.opacity = "1";
      // And disable the start button
      file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
    });

    // Hide the total progress bar when nothing's uploading anymore
    myDropzone.on("queuecomplete", function(progress) {
      document.querySelector("#total-progress_{{$name}}").style.opacity = "0";
    });

    // Setup the buttons for all transfers
    // The "add files" button doesn't need to be setup because the config
    // `clickable` has already been specified.
    document.querySelector("#actions_{{$name}} .start").onclick = function() {
      myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
    };
    document.querySelector("#actions_{{$name}} .cancel").onclick = function() {
      myDropzone.removeAllFiles(true);
    };
    // DropzoneJS Demo Code End

    @if(count($existing) > 0)
      var mockFile = {};
      @foreach($existing as $value)
        mockFile = { name: '{{ $value['name'] }}', size: '{{ $value['size'] }}' };
        myDropzone.options.addedfile.call(myDropzone, mockFile);
        //$('.cancel').remove();
        /*$('.start').replaceWith(`<a href="{{ $value['path'] }}" target="_blank" class="btn btn-primary">
                                  <i class="fa fa-download"></i>
                                  <span>Download</span>
                                </a>
                                `);*/
      @endforeach
    @endif
  </script>
@endpush