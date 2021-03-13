<div>
	<div class="row mb-3">
		<div class="col-12">
			<button class="btn {{ AdminSeven::accentSkin() }} btn-sm" wire:click="addChild()">
				<i class="fa fa-plus"></i> Add New Main Menu
			</button>
		</div>
	</div>
    {!! $result !!}
    {{-- form add --}}
	<div wire:ignore.self class="modal fade" id="form-add">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Menu</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            	{!! 
            		Form::inputText(
                      [3,9],
                      "Menu Name",
                      [
                        "name" => "name",
                        "placeholder" => "Menu Name",
                        "wire:model" => "name",
                        "autocomplete" => "off"
                      ]
                    ) 
                !!}
                @error('name') <label class="badge badge-danger"> {{ $message }}</label>@enderror
            	{!! 
            		Form::inputText(
                      [3,9],
                      "URL",
                      [
                        "name" => "url",
                        "placeholder" => "Menu URL",
                        "wire:model" => "url",
                        "autocomplete" => "off"
                      ]
                    ) 
                !!}
                @error('url') <label class="badge badge-danger"> {{ $message }}</label>@enderror
            	{!! 
            		Form::inputText(
                      [3,9],
                      "Icon",
                      [
                        "name" => "icon",
                        "placeholder" => "Menu Icon",
                        "wire:model" => "icon",
                        "autocomplete" => "off"
                      ],
                      'Check at Font Awesome for Icon List'
                    ) 
                !!}
                @error('icon') <label class="badge badge-danger"> {{ $message }}</label>@enderror
                {!! Form::selectCheckbox(
                      [3,9],
                      "Group",
                      [
                        "name" => "group",
                        "wire:model" => "group"
                      ],
                      $list_group,
                      $group
                    ) 
      			!!}
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
                      "Menu Name",
                      [
                        "name" => "name",
                        "placeholder" => "Menu Name",
                        "wire:model" => "name",
                        "autocomplete" => "off"
                      ]
                    ) 
                !!}
                @error('name') <label class="badge badge-danger"> {{ $message }}</label>@enderror
            	{!! 
            		Form::inputText(
                      [3,9],
                      "URL",
                      [
                        "name" => "url",
                        "placeholder" => "Menu URL",
                        "wire:model" => "url",
                        "autocomplete" => "off"
                      ]
                    ) 
                !!}
                @error('url') <label class="badge badge-danger"> {{ $message }}</label>@enderror
            	{!! 
            		Form::inputText(
                      [3,9],
                      "Icon",
                      [
                        "name" => "icon",
                        "placeholder" => "Menu Icon",
                        "wire:model" => "icon",
                        "autocomplete" => "off"
                      ],
                      'Check at Font Awesome for Icon List'
                    ) 
                !!}
                @error('icon') <label class="badge badge-danger"> {{ $message }}</label>@enderror
                {!! Form::selectCheckbox(
                      [3,9],
                      "Group",
                      [
                        "name" => "group",
                        "wire:model" => "group"
                      ],
                      $list_group,
                      $group
                    ) 
      			!!}
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
    openMenu('Configurations');
    activeMenu('Menu');
  </script>
@endpush
