<div class="d-flex flex-row justify-content-end w-100">
	<label class="badge {{ \AdminSeven::accentSkin() }}"  wire:loading wire:target="{{ $state }}">Uploading ...</label>
</div>
@if($file)
	@if(is_string($filename))
	  <div class="d-flex flex-row justify-content-end w-100">
	  	<label class="badge {{ \AdminSeven::accentSkin() }}">{{ $filename }}</label>
	  </div>
	@endif
@endif