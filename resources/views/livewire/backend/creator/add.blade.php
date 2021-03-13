{!! Form::selectOption(
              [3,9],
              "Type",
              [
                "placeholder" => "Select One",
                "livewire" => true,
                "wire:model" => "attributes.column_add.$selected_column_add.type"
              ],
              $type
            ) 
!!}
{!! Form::inputText(
              [3,9],
              "Placeholder",
              [
                "placeholder" => "Placeholder",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.placeholder"
              ]
            )
!!}
{!! Form::inputText(
              [3,9],
              "Column",
              [
                "placeholder" => "Column",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.column_text"
              ],
              "With 12 Standard Column, Ex : 3,9"
            )
!!}
@if($attributes['column_add'][$selected_column_add]['type'] == "uploadFile" || $attributes['column_add'][$selected_column_add]['type'] == "uploadImage")
{!! Form::inputText(
              [3,9],
              "Upload Directory",
              [
                "placeholder" => "Upload Directory",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.upload_dir"
              ]
            )
!!}
{!! Form::inputText(
              [3,9],
              "Default Path File",
              [
                "placeholder" => "Default Path File",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.path"
              ]
            )
!!}
@endif
@if($attributes['column_add'][$selected_column_add]['type'] == "uploadImage")
{!! Form::inputText(
              [3,9],
              "Image Setting",
              [
                "placeholder" => "Upload Directory",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.image_setting_text"
              ],
              'See documentation in cropper.js, Ex : {"aspectRatio":"1/1"}'
            )
!!}
@endif
@if($attributes['column_add'][$selected_column_add]['type'] == "uploadFile")
{!! Form::selectRadio(
              [3,9],
              "Multiple File",
              [
                "name" => "multifile",
                "wire:model" => "attributes.column_add.$selected_column_add.multifile"
              ],
              [false=>"Disable",true=>"Enable"]
            ) 
!!}
@endif
@if($attributes['column_add'][$selected_column_add]['type'] == "selectOption" || $attributes['column_add'][$selected_column_add]['type'] == "selectRadio" || $attributes['column_add'][$selected_column_add]['type'] == "selectCheckbox")
{!! Form::inputText(
              [3,9],
              "Options",
              [
                "placeholder" => "Options",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.options_text"
              ],
              'Ex : {"1":"Red"},{"2":"Blue"},{"3":"Green"}'
            )
!!}
{!! Form::inputText(
              [3,9],
              "Relation",
              [
                "placeholder" => "Relation",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.relation_text"
              ],
              "Ex : Models.Group,field_value,field_text"
            )
!!}
@endif
{!! Form::inputTextarea(
              [3,9],
              "Validate",
              [
                "placeholder" => "Validate",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.validate"
              ],
              "Watch at Laravel documentation for validation Ex : required|max:255"
            )
!!}
{!! Form::inputText(
              [3,9],
              "Info",
              [
                "placeholder" => "Info",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.info"
              ]
            )
!!}
{!! Form::inputText(
              [3,9],
              "Default Value",
              [
                "placeholder" => "Default Value",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.value"
              ]
            )
!!}
{{-- {!! Form::inputTextarea(
              [3,9],
              "Event",
              [
                "placeholder" => "Event",
                "wire:model.lazy" => "attributes.column_add.$selected_column_add.event_text"
              ],
              "Watch Livewire Documentation Ex : wire:click='OpenModal'"
            )
!!} --}}
{!! Form::selectRadio(
              [3,9],
              "Ignore",
              [
                "name" => "ignore",
                "wire:model" => "attributes.column_add.$selected_column_add.ignore"
              ],
              [false=>"Disable",true=>"Enable"],
              "Ignore this field to save into database"
            ) 
!!}