@foreach ($filter_fields as $key => $row)
	@if($row['type'] == "selectOption")
	{!! Form::selectOption(
                      [12,12],
                      $row['label'],
                      [
                        "name" => $row['field'],
                        "placeholder" => $row['label'],
                        "value" => null,
                        "livewire" => true,
                        "wire:model.lazy" => 'filters.'.$row['field'],
                        "setData" => 'filters.'.$row['field'],
                        "autocomplete" => "off"
                      ],
                      (count($row['options']) > 0) ? $row['options'] : $row['relation']
                    ) 
    !!}
	@elseif($row['type'] == "selectRadio")
	{!! Form::selectRadio(
                      [12,12],
                      $row['label'],
                      [
                        "name" => $row['field'],
                        "placeholder" => $row['label'],
                        "value" => null,
                        "wire:model.lazy" => 'filters.'.$row['field']
                      ],
                      $row['relation']
                    ) 
    !!}
	@elseif($row['type'] == "selectCheckbox")
	{!! Form::selectCheckbox(
                      [12,12],
                      $row['label'],
                      [
                        "name" => $row['field'],
                        "placeholder" => $row['label'],
                        "value" => null,
                        "wire:model.lazy" => 'filters.'.$row['field']
                      ],
                      $row['relation']
                    ) 
    !!}
	@else
	{!! Form::{$row['type']}(
								[12,12],
								$row['label'],
								[
									"name" => $row['field'],
									"placeholder" => $row['label'],
									"value" => null,
									"wire:model.lazy" => 'filters.'.$row['field'],
									"key" => $key,
                  "autocomplete" => "off"
								]
		 					) 
	!!}
	@endif
@endforeach
<div class="form-group row">
	<div class="col-12">
		<button class="btn btn-block {{ AdminSeven::accentSkin() }}" wire:click="getFilter">
			<i class="fa fa-search"></i>
			<span>Filter</span>
		</button>
    <button class="btn btn-block bg-secondary" wire:click="resetFilterFields">
      <i class="fa fa-refresh"></i>
      <span>Reset Filter</span>
    </button>
	</div>
</div>