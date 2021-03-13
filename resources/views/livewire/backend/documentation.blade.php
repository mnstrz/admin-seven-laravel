<div>
	<div class="row mb-3">
		<div class="col-12">
			<button class="btn {{ AdminSeven::accentSkin() }} btn-sm" wire:click="addChild()">
				<i class="fa fa-plus"></i> Add New Main Documentation
			</button>
		</div>
	</div>
    {!! $result !!}
    {{-- form add --}}
	<div wire:ignore.self class="modal fade" id="form-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Documentation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	{!! 
            		Form::inputText(
                      [3,9],
                      "Name",
                      [
                        "name" => "name",
                        "placeholder" => "On Menu Name",
                        "wire:model" => "name",
                        "autocomplete" => "off"
                      ]
                    ) 
                !!}
                @error('name') <label class="badge badge-danger"> {{ $message }}</label>@enderror
            	{!! 
            		Form::inputText(
                      [3,9],
                      "Title",
                      [
                        "name" => "title",
                        "placeholder" => "Title",
                        "wire:model" => "title",
                        "autocomplete" => "off"
                      ]
                    ) 
                !!}
                @error('title') <label class="badge badge-danger"> {{ $message }}</label>@enderror
                {!! 
                  Form::selectOption(
                    [3,9],
                    "Previous",
                    [
                      "name" => "prev",
                      "placeholder" => "Select One",
                      "value" => "2",
                      "livewire" => true,
                      "wire:model" => 'prev'
                    ],
                    $list_other,
                    "Previous Page"
                    ) 
                !!}
                @error('prev') <label class="badge badge-danger"> {{ $message }}</label>@enderror
              	{!! 
                  Form::selectOption(
                    [3,9],
                    "Next",
                    [
                      "name" => "next",
                      "placeholder" => "Select One",
                      "value" => "2",
                      "livewire" => true,
                      "wire:model" => 'next'
                    ],
                    $list_other,
                    "Next Page"
                    ) 
                !!}
                @error('next') <label class="badge badge-danger"> {{ $message }}</label>@enderror
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" wire:click="resetForm">Cancel</button>
              <button type="button" class="btn {{ AdminSeven::accentSkin() }}" wire:click="saveMenu">Save</button>
            </div>
          </div>
        </div>
      </div>
    {{-- form add --}}

    {{-- form edit --}}
	<div wire:ignore.self class="modal fade" id="form-edit">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Menu</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              {!! 
                Form::inputText(
                      [3,9],
                      "Name",
                      [
                        "name" => "name",
                        "placeholder" => "On Menu Name",
                        "wire:model" => "name",
                        "autocomplete" => "off"
                      ]
                    ) 
                !!}
                @error('name') <label class="badge badge-danger"> {{ $message }}</label>@enderror
              {!! 
                Form::inputText(
                      [3,9],
                      "Title",
                      [
                        "name" => "title",
                        "placeholder" => "Title",
                        "wire:model" => "title",
                        "autocomplete" => "off"
                      ]
                    ) 
                !!}
                @error('title') <label class="badge badge-danger"> {{ $message }}</label>@enderror
                {!! 
                  Form::selectOption(
                    [3,9],
                    "Previous",
                    [
                      "name" => "prev",
                      "placeholder" => "Select One",
                      "value" => "2",
                      "livewire" => true,
                      "wire:model" => 'prev'
                    ],
                    $list_other,
                    "Previous Page"
                    ) 
                !!}
                @error('prev') <label class="badge badge-danger"> {{ $message }}</label>@enderror
                {!! 
                  Form::selectOption(
                    [3,9],
                    "Next",
                    [
                      "name" => "next",
                      "placeholder" => "Select One",
                      "value" => "2",
                      "livewire" => true,
                      "wire:model" => 'next'
                    ],
                    $list_other,
                    "Next Page"
                    ) 
                !!}
                @error('next') <label class="badge badge-danger"> {{ $message }}</label>@enderror
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" wire:click="resetForm">Cancel</button>
              <button type="button" class="btn {{ AdminSeven::accentSkin() }}" wire:click="updateMenu">Save</button>
            </div>
          </div>
        </div>
      </div>
      {{-- form edit --}}

      {{-- delete --}}
	   <div class="modal fade" id="delete-confirm">
	        <div class="modal-dialog modal-sm">
	          <div class="modal-content">
	            <div class="modal-header">
	              <h4 class="modal-title">Delete Confirmation</h4>
	              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	                <span aria-hidden="true">&times;</span>
	              </button>
	            </div>
	            <div class="modal-body">
	              <p>Sure delete this data ?</p>
	            </div>
	            <div class="modal-footer justify-content-between">
	              <button type="button" class="btn btn-default" data-dismiss="modal" wire:click="cancelDelete">Cancel</button>
	              <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="confirmDelete">Yes, delete</button>
	            </div>
	          </div>
	        </div>
	    </div>
	    {{-- delete --}}

      <script type="text/javascript">
		    window.addEventListener('add', event => {
		    	$('#form-add').modal('show');
  			})
  		    window.addEventListener('close-add', event => {
  		    	$('#form-add').modal('hide');
  			})
  		    window.addEventListener('edit', event => {
  		    	$('#form-edit').modal('show');
  			})
  		    window.addEventListener('close-edit', event => {
  		    	$('#form-edit').modal('hide');
  			})
  		    window.addEventListener('delete', event => {
  		    	$('#delete-confirm').modal('show');
  			})
      </script>
</div>
@push('js')
  <script type="text/javascript">
    activeMenu('Documentation');
  </script>
@endpush
