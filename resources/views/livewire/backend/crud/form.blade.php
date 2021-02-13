<section class="col-lg-{{ $form_width }} mx-auto">
	@php
		$title = ($form_mode == 'add') ? 'Add New' : 'Edit';
		$title = $title.' '.$modul_name;
	@endphp
	<x-card :title="$title">
		@php
			//dd($form_add,$fileee);
			$render_form = ($form_mode == "add") ? $form_add_setting : $form_edit_setting;
			$state = ($form_mode == "add") ? "form_add." : "form_edit.";
			$state_var = ($form_mode == "add") ? $form_add : $form_edit;
		@endphp
		<form wire:submit.prevent="save">
			@foreach($render_form as $key => $form)
				<!-- set attributes					-->
		    	@php
		    		if($form['type'] == 'selectCheckbox'){
		    			$attributes = [
	                        "name" => $form['field'],
	                        "placeholder" => $form['placeholder'],
	                        "wire:model" => $state.$form['field']
	                    ];
		    		}else if($form['type'] == 'uploadFile'){
		    			$model_name = ($form['multifile']) ? $form['field']."_files" : "form_file.".$form['field'];
		    			$attributes = [
	                        "name" => $form['field'],
	                        "placeholder" => $form['placeholder'],
	                        "wire:model.lazy" => $model_name
	                    ];
		    			if($form['multifile']){
		    				$attributes['multiple'] = 'multiple';
		    			}
		    		}else if($form['type'] == 'inputPassword'){
		    			$attributes = [
	                        "name" => $form['field'],
	                        "placeholder" => $form['placeholder'],
	                        "wire:model.lazy" => $state.$form['field']
	                    ];
		    		}else{
			    		$attributes = [
	                        "name" => $form['field'],
	                        "placeholder" => $form['placeholder'],
	                        "wire:model.lazy" => $state.$form['field']
	                    ];
		    		}
		    		/**/
                    if($form['event']){
                    	foreach($form['event'] as $event){
                    		$e = explode("=",$event);
                    		$attributes[$e[0]] = $e[1];
                    	}
                    }
                    /**/
                    if($form['value']){
                    	$attributes['value'] = $form['value'];
                    }
                    /**/
		    @endphp
				@switch($form['type'])
				    @case('selectOption')
				    	{!! Form::{$form['type']}(
				        	$form['column'],
                     	 	$form['label'],
		                    $attributes,
		                    (count($form['options']) > 0) ? $form['options'] : $form['relation'],
		                    $form['info'],
		                    false
		                    )
      					!!}
      				@break
				    @case('selectRadio')
				        {!! Form::{$form['type']}(
				        	$form['column'],
                     	 	$form['label'],
		                    $attributes,
		                    (count($form['options']) > 0) ? $form['options'] : $form['relation'],
		                    $form['info']
		                    )
      					!!}
				    @break
				    @case('selectCheckbox')
				        {!! Form::{$form['type']}(
				        	$form['column'],
                     	 	$form['label'],
		                    $attributes,
		                    (count($form['options']) > 0) ? $form['options'] : $form['relation'],
		                    [],
		                    $form['info']
		                    )
      					!!}
				    @break
				    @case('uploadFile')
				        {!! Form::{$form['type']}(
				        	$form['column'],
                     	 	$form['label'],
		                    $attributes,
		                    $form['value'],
		                    $form['info']
		                    )
      					!!}
      					@if($form['multifile'])
      						{{ $this->this_filename($form['field']."_files") }}
      					@else
      						{{ $this->this_filename("form_file.".$form['field']) }}
      					@endif
				    @break
				    @case('uploadImage')
				        {!! Form::{$form['type']}(
				        	$form['column'],
                     	 	$form['label'],
		                    $attributes,
		                    $form['image_setting'],
		                    ($form['path']) ? \Storage::url($form['path']) : null
		                    )
      					!!}
				    @break
				    @default
				        {!! Form::{$form['type']}(
				        	$form['column'],
                     	 	$form['label'],
		                    $attributes,
		                    $form['info']
		                    )
      					!!}
				@endswitch
				@error($state.$form['field']) <label class="badge badge-danger"> {{ $message }}</label>@enderror

			@endforeach
		</form>
		<div class="d-flex flex-row justify-content-between mt-3">
			<div>
				<button class="btn btn-sm bg-black" wire:click="cancelForm()">
					<span>Cancel</span>
				</button>
			</div>
			<div wire:loading wire:target="save">
				<label class="badge {{ \AdminSeven::accentSkin() }}">Loading ...</label>
			</div>
			<div wire:loading.remove wire:target="save">
				<button class="btn btn-sm btn-danger" wire:click="resetForm()">
					<span>Reset</span>
				</button>
				<button class="btn btn-sm {{ AdminSeven::accentSkin() }}" wire:click="save()">
					<span>Save</span>
				</button>
			</div>
		</div>
	</x-card>
</section>
<script type="text/javascript">
	window.addEventListener('show-message', event => {
		let message = event.detail.message.message
		let variant = event.detail.message.variant
		if(variant == 'success'){
			toastr.success(message)
		}else if(variant == 'warning'){
			toastr.warning(message)
		}else if(variant == 'info'){
			toastr.info(message)
		}else if(variant == 'danger'){
			toastr.danger(message)
		}else if(variant == 'primary'){
			toastr.primary(message)
		}else if(variant == 'secondary'){
			toastr.secondary(message)
		}else{
			toastr.error(message)
		}
	})
	window.addEventListener('confirm-delete', event => {
		$('#delete-confirm').modal('show');
	})
</script>
