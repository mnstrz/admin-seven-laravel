<div class="modal fade" id="{{ \Str::slug($modal_title,"-") }}" wire:ignore.self>
    <div class="modal-dialog modal-lg">
      <div class="modal-content {{ ($modal_color) ? 'bg-'.$modal_color : '' }}">
        <div class="modal-header">
          <h4 class="modal-title">{{ $modal_title }}</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ $slot }}
        </div>
        <div class="modal-footer justify-content-between">
          @isset($footer)
          	{{ $footer }}
          @else
          	<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          	<button type="button" class="btn {{ AdminSeven::accentSkin() }}">Ok</button>
          @endisset
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->