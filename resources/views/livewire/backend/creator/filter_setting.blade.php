<div class="table-responsive">
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>No</th>
        <th>Label</th>
        <th>Field</th>
        <th>Type</th>
        <th>Relation</th>
        <th>Options</th>
        <th>Operator</th>
        <th width="150px"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($attributes['filter'] as $key => $show)
      <tr>
        <td>{{ $key+1 }}</td>
        <td>
          {!! Form::inputText(
                        [0,12],
                        "",
                        [
                          "placeholder" => "Label",
                          "wire:model.lazy" => "attributes.filter.$key.label"
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
                          "wire:model.lazy" => "attributes.filter.$key.field"
                        ]
                      ) 
              !!}
        </td>
        <td>
          {!! Form::selectOption(
              [0,12],
              "",
              [
                "placeholder" => "Select One",
                "livewire" => true,
                "wire:model" => "attributes.filter.$key.type"
              ],
              $type
            ) 
          !!}
        </td>
        <td>
          {!! Form::inputText(
                        [0,12],
                        "",
                        [
                          "placeholder" => "Relation",
                          "wire:model.lazy" => "attributes.filter.$key.relation_text"
                        ],
                        "Ex : Models.Group,field_value,field_text"
                      ) 
              !!}
        </td>
        <td>
          {!! Form::inputText(
                  [0,12],
                  "",
                  [
                    "placeholder" => "Options",
                    "wire:model.lazy" => "attributes.filter.$key.options_text"
                  ],
                  'Ex : {"1":"Red"},{"2":"Blue"},{"3":"Green"}'
                ) 
          !!}
        </td>
        <td>
          {!! Form::inputText(
                        [0,12],
                        "",
                        [
                          "placeholder" => "Operator",
                          "wire:model.lazy" => "attributes.filter.$key.operator"
                        ],
                        "=,like,>,<,>=,<="
                      ) 
              !!}
        </td>
        <td>
          @if($key > 0)
          <button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveFilter({{$key}},'up')">
            <i class="fa fa-arrow-up"></i>
          </button>
          @endif
          @if($key < count($attributes['filter'])-1 )
          <button class="btn btn-warning btn-sm mb-1 mr-1" wire:click="moveFilter({{$key}},'down')">
            <i class="fa fa-arrow-down"></i>
          </button>
          @endif
          <button class="btn btn-danger btn-sm mb-1 mr-1" wire:click="removeFilter({{$key}})">
            <i class="fa fa-trash"></i>
          </button>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>