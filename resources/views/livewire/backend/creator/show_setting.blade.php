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
			              	"name" => "show_relation",
			                "placeholder" => "Example : thisGroup,thisCountry",
			                "wire:model.lazy" => "attributes.show_relation"
			              ]
			            )
					!!}
				</td>
			</tr>
			@foreach($attributes['show'] as $key => $show)
			<tr>
				<td>{{ $key+1 }}</td>
				<td>
					{!! Form::inputText(
	                      [0,12],
	                      "",
	                      [
	                        "placeholder" => "Label",
	                        "wire:model.lazy" => "attributes.show.$key.label"
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
	                        "wire:model.lazy" => "attributes.show.$key.field"
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
				                "wire:model" => "attributes.show.$key.file"
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
				                "wire:model" => "attributes.show.$key.image"
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
	                        "wire:model.lazy" => "attributes.show.$key.badge"
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
	                        "wire:model.lazy" => "attributes.show.$key.options_text"
	                      ],
	                      'Ex : {"1":"Red"},{"2":"Blue"},{"3":"Green"}'
	                    ) 
      				!!}
				</td>
				<td>
					@if($key > 0)
					<button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveShow({{$key}},'up')">
						<i class="fa fa-arrow-up"></i>
					</button>
					@endif
					@if($key < count($attributes['show'])-1 )
					<button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveShow({{$key}},'down')">
						<i class="fa fa-arrow-down"></i>
					</button>
					@endif
					<button class="btn btn-danger btn-sm mb-1 mr-1" wire:click="removeShow({{$key}})">
						<i class="fa fa-trash"></i>
					</button>
				</td>
			</tr>
			@endforeach
			{{-- <tr>
				<td colspan="2">Before Showed</td>
				<td colspan="6">
					{!! Form::inputTextarea(
			              [0,12],
			              "",
			              [
			                "placeholder" => "Type Script Here",
			                "wire:model.lazy" => "attributes.show_setting.before_show"
			              ]
			            )
					!!}
				</td>
			</tr>
			<tr>
				<td colspan="2">After Showed</td>
				<td colspan="6">
					{!! Form::inputTextarea(
			              [0,12],
			              "",
			              [
			                "placeholder" => "Type Script Here",
			                "wire:model.lazy" => "attributes.show_setting.after_show"
			              ]
			            )
					!!}
				</td>
			</tr> --}}
		</tbody>
	</table>
</div>