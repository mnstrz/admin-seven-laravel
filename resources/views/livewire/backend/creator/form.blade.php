<div>
    <div class="row">
	  <section class="col-lg-12">
	    <x-card :title="$title">
			<div class="row">
				<div class="col-12">
			    	{!! Form::inputText(
		                      [2,6],
		                      "CRUD Name",
		                      [
		                        "placeholder" => "CRUD Name",
		                        "wire:model.lazy" => "crud_name"
		                      ]
		                    ) 
		      		!!}
			    	{!! Form::inputButtonAppend(
		                      [2,6],
		                      "Model Name",
		                      [
		                        "placeholder" => "Model Name",
		                        "wire:model.lazy" => "model",
		                        "after" => "<button wire:click='autoCreateColumn' class='btn btn-sm ".AdminSeven::accentSkin()."'>Auto Create</i></button>"
		                      ],
		                      "Example : Models.FakeTable"
		                    ) 
		      		!!}
		      		<div class="spinner-border" wire:loading wire:target="model">
					  <span class="sr-only"></span>
					</div>
			    	@if(count($warning) > 0)
			    		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			    		  @foreach($warning as $message)
			    		  	{{ $message }} <br>
			    		  @endforeach
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
			    	@endif
			    	@if($errors->any())
			    		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			    		  @foreach($errors->all() as $message)
			    		  	{{ $message }} <br>
			    		  @endforeach
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
			    	@endif
				</div>
			</div>
			@if(count($attributes) > 0)
			<div class="row mt-3">
				<div class="col-2">
					<ul class="list-group">
					  <li class="list-group-item">
					  	<button class="btn btn-sm btn-outline-dark btn-block {{ ($tab == 'general') ? AdminSeven::accentSkin().' text-white' : '' }}" wire:click="changeTab('general')">General</button>
					  </li>
					  <li class="list-group-item">
					  	<button class="btn btn-sm btn-outline-dark btn-block {{ ($tab == 'form') ? AdminSeven::accentSkin().' text-white' : '' }}" wire:click="changeTab('form')">Form</button>
					  </li>
					  <li class="list-group-item">
					  	<button class="btn btn-sm btn-outline-dark btn-block {{ ($tab == 'list') ? AdminSeven::accentSkin().' text-white' : '' }}" wire:click="changeTab('list')">List</button>
					  </li>
					  @if($attributes['general']['can_show'] == true)
					  <li class="list-group-item">
					  	<button class="btn btn-sm btn-outline-dark btn-block {{ ($tab == 'show') ? AdminSeven::accentSkin().' text-white' : '' }}" wire:click="changeTab('show')">Show</button>
					  </li>
					  @endif
					  @if($attributes['general']['with_filter'] == true)
					  <li class="list-group-item">
					  	<button class="btn btn-sm btn-outline-dark btn-block {{ ($tab == 'filter') ? AdminSeven::accentSkin().' text-white' : '' }}" wire:click="changeTab('filter')">Filter</button>
					  </li>
					  @endif
					</ul>
				</div>
				@if($tab == 'general')
				<div class="col-10">
					@if(count($attributes) > 0)
					{!! Form::selectRadio(
				              [2,6],
				              "Create",
				              [
				                "name" => "can_add",
				                "wire:model" => "attributes.general.can_add"
				              ],
				              [true=>"Enable",false=>"Disable"]
				            ) 
					!!}
					{!! Form::selectRadio(
				              [2,6],
				              "Edit",
				              [
				                "name" => "can_edit",
				                "wire:model" => "attributes.general.can_edit"
				              ],
				              [true=>"Enable",false=>"Disable"]
				            ) 
					!!}
					{!! Form::selectRadio(
				              [2,6],
				              "Delete",
				              [
				                "name" => "can_delete",
				                "wire:model" => "attributes.general.can_delete"
				              ],
				              [true=>"Enable",false=>"Disable"]
				            ) 
					!!}
					{!! Form::selectRadio(
				              [2,6],
				              "Show",
				              [
				                "name" => "can_show",
				                "wire:model" => "attributes.general.can_show"
				              ],
				              [true=>"Enable",false=>"Disable"]
				            ) 
					!!}
					{!! Form::selectRadio(
				              [2,6],
				              "Filter",
				              [
				                "name" => "with_filter",
				                "wire:model" => "attributes.general.with_filter"
				              ],
				              [true=>"Enable",false=>"Disable"]
				            ) 
					!!}
					{!! Form::inputText(
		                      [2,3],
		                      "Show List Perpage",
		                      [
		                        "placeholder" => "Per Page",
		                        "wire:model.lazy" => "attributes.general.per_page"
		                      ]
		                    ) 
		      		!!}
					{!! Form::inputText(
		                      [2,5],
		                      "Per Page Options",
		                      [
		                        "placeholder" => "Per Page Options",
		                        "wire:model.lazy" => "attributes.general.list_per_page"
		                      ],
		                      "Add this so, user can change show per page with easy mode"
		                    ) 
		      		!!}
					{!! Form::inputText(
		                      [2,3],
		                      "Form Width",
		                      [
		                        "placeholder" => "Form Width",
		                        "wire:model.lazy" => "attributes.general.form_width"
		                      ],
		                      "Range from 1 - 12"
		                    ) 
		      		!!}
					{!! Form::selectRadio(
				              [2,6],
				              "URL Permisison",
				              [
				                "name" => "url_permission",
				                "wire:model" => "attributes.general.url_permission"
				              ],
				              [true=>"Enable",false=>"Disable"],
				              "Automatic with URL permission configuration"
				            ) 
					!!}
					{!! Form::inputTextarea(
		                      [2,8],
		                      "Javascript",
		                      [
		                        "placeholder" => "Javascript",
		                        "wire:model.lazy" => "attributes.general.javascript"
		                      ],
		                      "Type Javascript Here"
		                    ) 
		      		!!}
					@endif
				</div>
				@elseif($tab == 'form')
					@if(isset($attributes['add_setting']))
						<x-modal :title="'Additional Setting for Form Create'">
							@include('livewire.backend.creator.add_setting')
						</x-modal>
					@endif
					@if(isset($attributes['edit_setting']))
						<x-modal :title="'Additional Setting for Form Edit'">
							@include('livewire.backend.creator.edit_setting')
						</x-modal>
					@endif
				<div class="col-10">
					<div class="row">
						@if($attributes['general']['can_add'] == true)
						<div class="col">
							<h4>Form Create</h4>
							@if(isset($attributes['column_add']))
							<x-modal :title="'Form Create'">
								@if($selected_column_add !== null)
									@include('livewire.backend.creator.add')
								@endif
							</x-modal>
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Label</th>
											<th>Field</th>
											<th>Type</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($attributes['column_add'] as $key => $column_add)
											<tr>
												<td>{{ $key+1 }}</td>
												<td width="200px">
												{!! Form::inputText(
										                      [0,12],
										                      "",
										                      [
										                        "placeholder" => "Label",
										                        "wire:model.lazy" => "attributes.column_add.$key.label"
										                      ]
										                    ) 
										      	!!}
												</td>
												<td width="200px">
												{!! Form::inputText(
										                      [0,12],
										                      "",
										                      [
										                        "placeholder" => "Field",
										                        "wire:model.lazy" => "attributes.column_add.$key.field"
										                      ]
										                    ) 
										      	!!}
												</td>
												<td>
													{{ $type[$attributes['column_add'][$key]['type']] }}
												</td>
												<td width="150px">
													@if($key > 0)
													<button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveColumnAdd({{$key}},'up')">
														<i class="fa fa-arrow-up"></i>
													</button>
													@endif
													<button class="btn {{ AdminSeven::accentSkin() }} btn-sm mb-1 mr-1" data-toggle="modal" data-target="#form-create" wire:click="openSettingAdd({{$key}})">
														<i class="fas fa-cog"></i>
													</button>
													@if($key < count($attributes['column_add'])-1 )
													<button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveColumnAdd({{$key}},'down')">
														<i class="fa fa-arrow-down"></i>
													</button>
													@endif
													<button class="btn btn-danger btn-sm mb-1 mr-1" wire:click="removeColumnAdd({{$key}})">
														<i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@endif
							@if($model)
							<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" wire:click="addColumnAdd">
								<i class="fa fa-plus"></i> Add Column
							</button>
							<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" data-toggle="modal" data-target="#additional-setting-for-form-create">
								<i class="fa fa-cog"></i> Additional Setting
							</button>
							@endif
						</div>
						@endif
						@if($attributes['general']['can_edit'] == true)
						<div class="col">
							<h4>Form Update</h4>
							@if(isset($attributes['column_edit']))
							<x-modal :title="'Form Edit'">
								@if($selected_column_edit !== null)
									@include('livewire.backend.creator.edit')
								@endif
							</x-modal>
							<div class="table-responsive">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>No</th>
											<th>Label</th>
											<th>Field</th>
											<th>Type</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										@foreach($attributes['column_edit'] as $key => $column_edit)
											<tr>
												<td>{{ $key+1 }}</td>
												<td width="200px">
												{!! Form::inputText(
										                      [0,12],
										                      "",
										                      [
										                        "placeholder" => "Label",
										                        "wire:model.lazy" => "attributes.column_edit.$key.label"
										                      ]
										                    ) 
										      	!!}
												</td>
												<td width="200px">
												{!! Form::inputText(
										                      [0,12],
										                      "",
										                      [
										                        "placeholder" => "Field",
										                        "wire:model.lazy" => "attributes.column_edit.$key.field"
										                      ]
										                    ) 
										      	!!}
												</td>
												<td>
													{{ $type[$attributes['column_edit'][$key]['type']] }}
												</td>
												<td width="150px">
													@if($key > 0)
													<button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveColumnEdit({{$key}},'up')">
														<i class="fa fa-arrow-up"></i>
													</button>
													@endif
													<button class="btn {{ AdminSeven::accentSkin() }} btn-sm mb-1 mr-1" data-toggle="modal" data-target="#form-edit" wire:click="openSettingEdit({{$key}})">
														<i class="fas fa-cog"></i>
													</button>
													@if($key < count($attributes['column_edit'])-1 )
													<button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveColumnEdit({{$key}},'down')">
														<i class="fa fa-arrow-down"></i>
													</button>
													@endif
													<button class="btn btn-danger btn-sm mb-1 mr-1" wire:click="removeColumnEdit({{$key}})">
														<i class="fa fa-trash"></i>
													</button>
												</td>
											</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							@endif
							@if($model)
							{!! Form::selectCheckbox(
			                      [0,12],
			                      "",
			                      [
			                        "name" => "edit_same_as_create",
			                        "wire:model" => "attributes.edit_same_as_create"
			                      ],
			                      [true => 'Same As Create'],
			                      []
			                    ) 
		      				!!}
							<button class="btn btn-sm btn-warning" wire:click="copyForm">
								<i class="fa fa-plus"></i> Copy From Form Create
							</button>
							<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" wire:click="addColumnEdit">
								<i class="fa fa-plus"></i> Add Column
							</button>
							<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" data-toggle="modal" data-target="#additional-setting-for-form-edit">
								<i class="fa fa-cog"></i> Additional Setting
							</button>
							@endif
						</div>
						@endif
					</div>
				</div>
				@elseif($tab == 'list')
					<div class="col-10">
						<h4>List</h4>
						@include('livewire.backend.creator.list_setting')
						@if($model)
							<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" wire:click="addList">
								<i class="fa fa-plus"></i> Add List
							</button>
						@endif
					</div>
				@elseif($tab == 'show')
					<div class="col-10">
						<h4>Show</h4>
						@include('livewire.backend.creator.show_setting')
						@if($model)
							<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" wire:click="addShow">
								<i class="fa fa-plus"></i> Add Show
							</button>
						@endif
					</div>
				@elseif($tab == 'filter')
					<div class="col-10">
						<h4>Filter</h4>
						@include('livewire.backend.creator.filter_setting')
						@if($model)
							<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" wire:click="addFilter">
								<i class="fa fa-plus"></i> Add Filter
							</button>
						@endif
					</div>
				@endif
			</div>
			@endif
			@if($model && count($attributes) > 0)
			<div class="row mt-4 pt-4 border-top">
				<div class="col-12">
					@if(count($warning) > 0)
			    		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			    		  @foreach($warning as $message)
			    		  	{{ $message }} <br>
			    		  @endforeach
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
			    	@endif
			    	@if($errors->any())
			    		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			    		  @foreach($errors->all() as $message)
			    		  	{{ $message }} <br>
			    		  @endforeach
						  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
						    <span aria-hidden="true">&times;</span>
						  </button>
						</div>
			    	@endif
				</div>
				<div class="col-12 text-right">
					<a href="{{ route('backend.creator') }}" class="btn btn-secondary">
						<i class="fas fa-times"></i> Cancel
					</a>
					@if($title == 'New')
					<button class="btn {{ AdminSeven::accentSkin() }}" wire:click="saveCreator">
						<i class="fas fa-save"></i> Save
					</button>
					@else
					<button class="btn {{ AdminSeven::accentSkin() }}" wire:click="editCreator">
						<i class="fas fa-save"></i> Save
					</button>
					@endif
				</div>
			</div>
			@endif
	    </x-card>
	  </section>
	</div>
</div>
@push('js')
  <script type="text/javascript">
    activeMenu('Creator');
  </script>
@endpush
