<section class="col-lg-{{ $form_width }} mx-auto">
	@php
		$title = ($form_mode == 'add') ? 'Add New' : 'Edit';
		$title = $title.' '.$modul_name;
	@endphp
	<x-card :title="$title">
		<form wire:submit.prevent="save">
			@php
				$render_form = ($form_mode == "add") ? $form_add_setting : $form_edit_setting;
				$state = ($form_mode == "add") ? "form." : "form_edit."
			@endphp
			@foreach($render_form as $key => $form)
		    	@php
		    		if($form['type'] == 'selectCheckbox'){
		    			$attributes = [
	                        "name" => $form['field'],
	                        "placeholder" => $form['placeholder'],
	                        "wire:model" => $state.$form['field']
	                    ];
		    		}else{
			    		$attributes = [
	                        "name" => $form['field'],
	                        "placeholder" => $form['placeholder'],
	                        "wire:model.lazy" => $state.$form['field']
	                    ];
		    		}
                    if($form['event']){
                    	foreach($form['event'] as $event){
                    		$e = explode("=",$event);
                    		$attributes[$e[0]] = $e[1];
                    	}
                    }
                    if($form['value']){
                    	$attributes['value'] = $form['value'];
                    }
		    	@endphp	
				@switch($form['type'])
				    @case('selectOption')
				    @case('selectRadio')
				        {!! Form::{$form['type']}(
				        	$form['column'],
                     	 	$form['label'],
		                    $attributes,
		                    $form['relation'],
		                    $form['info']
		                    ) 
      					!!}
				    @break
				    @case('selectCheckbox')
				        {!! Form::{$form['type']}(
				        	$form['column'],
                     	 	$form['label'],
		                    $attributes,
		                    $form['relation'],
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
				<button class="btn btn-sm bg-black" wire:click="lists()">
					<span>Cancel</span>
				</button>
			</div>
			<div>
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