<section class="col {{($with_filter) ? 'col-lg-9' : ''}}">
	@php
		$title ='List '.$modul_name;
	@endphp
	<x-card :title="$title">
		@if($this->can_add)
		<div class="row mb-2">
			<div class="col">
				<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" wire:click="add()">
					<i class="fas fa-plus"></i>
					<span>Add New</span>
				</button>
			</div>
		</div>
		@endif
		<x-table-simple
	        :class="'table-striped'"
	    >
	    	<thead>
	          <tr>
	            <th style="width: 10px">#</th>
	            @foreach($lists_fields as $key => $row)
	            	<th>{{ $row['label'] }}</th>
	            @endforeach
		        @if($action)
		          <th>
		          	Actions
		          </th>
		        @endif
	          </tr>
	        </thead>
	        <tbody>
	        	@if(count($results) > 0)
	        		@php
	        			$no = (($page-1)*$per_page)+1;
	        		@endphp
		        	@foreach ($results as $key => $value)
		        	<tr>
		        		<th>{{ $no++ }}</th>

		        		{{-- show fields --}}
			            @foreach($lists_fields as $keys => $row)

	        				{{-- get array multidimension --}}
	        				@php
	        					$field_nested = explode(".", $row['field']);
	        				@endphp

	        				@if(count($field_nested) == 1)
		            		<td>
		            			@php
		            				$val = $value[$row['field']];
		            				if(count($row['options']) > 0){
		            					if(isset($row['options'][$val])){
		            						$val = $row['options'][$val];
		            					}else{
		            						$val = "<i>Option not found</i>";
		            					}
		            				}
		            			@endphp
		            			{{-- get format --}}
		            			@if($row['format'])
		            				{!! $this->{$row['format']}($val,$value[$primary_key]) !!}
		            			@elseif($row['file'])
		            				{!! $this->format_showFileList($val,$row['field'],$value[$primary_key]) !!}
		            			@elseif($row['image'])
		            				{!! $this->format_showImageList($val,$value[$primary_key]) !!}
		            			@elseif($row['badge'])
		            				{!! $this->format_Label($val,$row['badge'],$value[$primary_key]) !!}
		            			@else
		            				{!! $val !!}
		            			@endif
		            		</td>
		            		@else

		            		@php
		            			$val = $value;
		            			foreach ($field_nested as $key => $sub_field) {
		            				$val = $val[$sub_field];
		            			}
		            			if(count($row['options']) > 0){
	            					if(isset($row['options'][$val])){
	            						$val = $row['options'][$val];
	            					}else{
	            						$val = "<i>Option not found</i>";
	            					}
	            				}
		            		@endphp
		            		<td>
		            			{{-- get format --}}
		            			@if($row['format'])
		            				{!! $this->{$row['format']}($val,$value[$primary_key]) !!}
		            			@elseif($row['file'])
		            				{!! $this->format_showFileList($val,$value[$primary_key]) !!}
		            			@elseif($row['image'])
		            				{!! $this->format_showImageList($val,$value[$primary_key]) !!}
		            			@elseif($row['badge'])
		            				{!! $this->format_Label($val,$row['badge'],$value[$primary_key]) !!}
		            			@else
		            				{{ $val }}
		            			@endif
		            		</td>
		            		@endif
			            @endforeach
		        		@if($action)
				          <td class="d-flex flex-row">

				          	@if($can_show)
				          	<button class="mr-1 btn {{ AdminSeven::accentSkin() }} btn-sm" data-tooltip="true" title="Show" wire:click="show({{ $value[$primary_key] }})">
				          		<i class="fas fa-share"></i>
				          	</button>
				          	@endif

				          	@if($can_edit)
				          	<button class="mr-1 btn {{ AdminSeven::accentSkin() }} btn-sm" data-tooltip="true"title="Edit" wire:click="edit({{ $value[$primary_key] }})">
				          		<i class="fas fa-edit"></i>
				          	</button>
				          	@endif

				          	@if($can_delete)
				          	<button class="mr-1 btn btn-danger btn-sm" data-tooltip="true" title="Delete" wire:click="delete({{ $value[$primary_key] }})">
				          		<i class="fas fa-trash"></i>
				          	</button>
				          	@endif

				          	@if(count($custom_action) > 0)
				          		@foreach ($custom_action as $key => $row)
				          			@if($row['link'])
				          				@php
				          					$link = explode("|", $row['link']);
				          				@endphp
				          				<a href="{{ $link[0] }}" class="mr-1 btn {{ AdminSeven::accentSkin() }} btn-sm {{ ($row['color']) ? 'bg-'.$row['color'] : '' }}" data-tooltip="true" title="{{ $row['title'] }}" target="{{ (isset($link[1])) ? $link[1] : '' }}">
				          					<i class="{{ $row['icon'] }}"></i>
				          					<span>{{ $row['label'] }}</span>
				          				</a>
				          			@else
				          				<button class="mr-1 btn {{ AdminSeven::accentSkin() }} btn-sm {{ ($row['color']) ? 'bg-'.$row['color'] : '' }}" data-tooltip="true" title="{{ $row['title'] }}" wire:click="{{ $row['event']}}('{{ $value[$primary_key] }}'{{ ($row['field']) ? ",'".$value[$row['field']]."'" : "" }})">
				          					<i class="{{ $row['icon'] }}"></i>
				          					<span>{{ $row['label'] }}</span>
				          				</button>
				          			@endif
				          		@endforeach
				          	@endif

				          </td>
				        @endif
		        	</tr>
		        	@endforeach
	        	@endif
	        </tbody>
		</x-table-simple>
		<div class="row mt-2">
			<div class="col-12">
				{!! $this->paginate() !!}
			</div>
		</div>
	</x-card>
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
  </section>
  <script type="text/javascript">
  	let x = 0;
	window.addEventListener('show-message', event => {
		toastr.remove()
		showToast(event.detail.message.message,event.detail.message.variant)
		$('[data-tooltip="true"]').tooltip()
	})
    window.addEventListener('close-message', event => {
    	toastr.remove()
    	toastr.clear()
    	$('[data-tooltip="true"]').tooltip()
	})
    window.addEventListener('confirm-delete', event => {
    	$('#delete-confirm').modal('show');
	})
    window.addEventListener('show-tooltip', event => {
    	$('[data-tooltip="true"]').tooltip()
	})
  </script>
