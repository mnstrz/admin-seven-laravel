<div class="table-responsive">
	<table class="table table-bordered">
		<thead>
			<tr>
				<th>No</th>
				<th>Label</th>
				<th>Field</th>
				<th>File</th>
				<th>Image</th>
				<th>Badge</th>
				<th>Options</th>
				<th width="150px"></th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td colspan="2">Relations</td>
				<td colspan="6">
					{!! Form::inputText(
			              [0,12],
			              "",
			              [
			              	"name" => "list_relation",
			                "placeholder" => "Example : thisGroup,thisCountry",
			                "wire:model.lazy" => "attributes.list_relation"
			              ]
			            )
					!!}
				</td>
			</tr>
			<tr>
				<td colspan="2">Order By</td>
				<td colspan="6">
					{!! Form::inputText(
	                      [0,12],
	                      "",
	                      [
	                        "placeholder" => "Order By",
	                        "wire:model.lazy" => "attributes.order_by"
	                      ],
	                      'Ex : {"id":"asc"},{"username":"asc"},{"address":"desc"}'
	                    ) 
      				!!}
				</td>
			</tr>
			@foreach($attributes['list'] as $key => $list)
			<tr>
				<td>{{ $key+1 }}</td>
				<td>
					{!! Form::inputText(
	                      [0,12],
	                      "",
	                      [
	                        "placeholder" => "Label",
	                        "wire:model.lazy" => "attributes.list.$key.label"
	                      ]
	                    ) 
      				!!}
				</td>
				<td>
					{!! Form::inputText(
	                      [0,12],
	                      "",
	                      [
	                        "placeholder" => "Field",
	                        "wire:model.lazy" => "attributes.list.$key.field"
	                      ]
	                    ) 
      				!!}
				</td>
				<td>
					{!! Form::selectRadio(
				              [0,12],
				              "",
				              [
				                "name" => "file_$key",
				                "wire:model" => "attributes.list.$key.file"
				              ],
				              [true=>"Yes",false=>"No"]
				            ) 
					!!}
				</td>
				<td>
					{!! Form::selectRadio(
				              [0,12],
				              "",
				              [
				                "name" => "image_$key",
				                "wire:model" => "attributes.list.$key.image"
				              ],
				              [true=>"Yes",false=>"No"]
				            ) 
					!!}
				</td>
				<td>
					{!! Form::inputText(
	                      [0,12],
	                      "",
	                      [
	                        "placeholder" => "Badge",
	                        "wire:model.lazy" => "attributes.list.$key.badge"
	                      ],
	                      "Badge strandard bootstrap, Ex: theme, danger, success, info"
	                    ) 
      				!!}
				</td>
				<td>
					{!! Form::inputText(
	                      [0,12],
	                      "",
	                      [
	                        "placeholder" => "Options",
	                        "wire:model.lazy" => "attributes.list.$key.options_text"
	                      ],
	                      'Ex : {"1":"Red"},{"2":"Blue"},{"3":"Green"}'
	                    ) 
      				!!}
				</td>
				<td>
					@if($key > 0)
					<button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveList({{$key}},'up')">
						<i class="fa fa-arrow-up"></i>
					</button>
					@endif
					@if($key < count($attributes['list'])-1 )
					<button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveList({{$key}},'down')">
						<i class="fa fa-arrow-down"></i>
					</button>
					@endif
					<button class="btn btn-danger btn-sm mb-1 mr-1" wire:click="removeList({{$key}})">
						<i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
			@endforeach
			{{-- <tr>
				<td colspan="2">Before List Showed</td>
				<td colspan="6">
					{!! Form::inputTextarea(
			              [0,12],
			              "",
			              [
			                "placeholder" => "Type Script Here",
			                "wire:model.lazy" => "attributes.list_setting.before_list"
			              ]
			            )
					!!}
				</td>
			</tr>
			<tr>
				<td colspan="2">After List Showed</td>
				<td colspan="6">
					{!! Form::inputTextarea(
			              [0,12],
			              "",
			              [
			                "placeholder" => "Type Script Here",
			                "wire:model.lazy" => "attributes.list_setting.after_list"
			              ]
			            )
					!!}
				</td>
			</tr> --}}
		</tbody>
	</table>
</div>