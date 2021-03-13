<div>
  <div class="row p-3">
    <div cass="col-12">
      <a href="{{ route('backend.documentation') }}" class="btn btn-sm btn-secondary">
        <i class="fas fa-arrow-left"></i> Back
      </a>
      <button class="btn btn-sm {{ AdminSeven::accentSkin() }}" id="save">
        <i class="fas fa-save"></i> Save
      </button>
    </div>
  </div>
  <div class="row p-2">
    <div class="col-12">
      <textarea id="markdown">{!! base64_decode($documentation->content) !!}</textarea>
    </div>
  </div>
</div>
@push('css')
<style type="text/css">
  .CodeMirror {
    height: 400px;
  }
</style>
@endpush
@push('js')
<script type="text/javascript">
  activeMenu('Documentation')
  var simplemde = new SimpleMDE(
      { 
        element: $("#markdown")[0],
        placeholder : 'Type Documentation Here ...'
      }
  );
  $(document).on('click','#save',function(e){
      let value = simplemde.value()
      value = btoa(value)
      saveContent(value)
  })
  function saveContent(value){
      $.ajax({
         url : "{{ route('backend.documentation.save',[$documentation->id]) }}",
         method : "POST",
         data : {
           _token : '{{ csrf_token() }}',
           content : value
         },
         beforeSend : function(e){
            $("#save").html(`Loading ....`)
         },
         error : function(e){
            showToast(e.responseJSON.message,"error")
            $('#save').html(`<i class="fas fa-save"></i> Save`)
         },
         success : function(xhr){
            simplemde.value(atob(xhr.content))
            showToast("Documentation Updated!","success")
            $('#save').html(`<i class="fas fa-save"></i> Save`)
         }
      })
  }
</script>
@endpush