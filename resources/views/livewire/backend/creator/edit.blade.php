{!! Form::selectOption(
              [3,9],
              "Type",
              [
                "placeholder" => "Select One",
                "livewire" => true,
                "wire:model" => "attributes.column_edit.$selected_column_edit.type"
              ],
              $type
            ) 
!!}
{!! Form::inputText(
              [3,9],
              "Placeholder",
              [
                "placeholder" => "Placeholder",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.placeholder"
              ]
            )
!!}
{!! Form::inputText(
              [3,9],
              "Column",
              [
                "placeholder" => "Column",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.column_text"
              ],
              "With 12 Standard Column, Ex : 3,9"
            )
!!}
@if($attributes['column_edit'][$selected_column_edit]['type'] == "uploadFile" || $attributes['column_edit'][$selected_column_edit]['type'] == "uploadImage")
{!! Form::inputText(
              [3,9],
              "Upload Directory",
              [
                "placeholder" => "Upload Directory",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.upload_dir"
              ]
            )
!!}
{!! Form::inputText(
              [3,9],
              "Default Path File",
              [
                "placeholder" => "Default Path File",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.path"
              ]
            )
!!}
{!! Form::inputText(
              [3,9],
              "Image Setting",
              [
                "placeholder" => "Upload Directory",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.image_setting_text"
              ],
              'See documentation in cropper.js, Ex : {"aspectRatio":"1/1"}'
            )
!!}
@endif
@if($attributes['column_edit'][$selected_column_edit]['type'] == "uploadFile")
{!! Form::selectRadio(
              [3,9],
              "Multiple File",
              [
                "name" => "multifile",
                "wire:model" => "attributes.column_edit.$selected_column_edit.multifile"
              ],
              [false=>"Disable",true=>"Enable"]
            ) 
!!}
@endif
@if($attributes['column_edit'][$selected_column_edit]['type'] == "selectOption" || $attributes['column_edit'][$selected_column_edit]['type'] == "selectRadio" || $attributes['column_edit'][$selected_column_edit]['type'] == "selectCheckbox")
{!! Form::inputText(
              [3,9],
              "Options",
              [
                "placeholder" => "Options",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.options_text"
              ],
              'Ex : {"1":"Red"},{"2":"Blue"},{"3":"Green"}'
            )
!!}
{!! Form::inputText(
              [3,9],
              "Relation",
              [
                "placeholder" => "Relation",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.relation_text"
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
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.validate"
              ],
              "Ex : Watch at Laravel documentation for validation"
            )
!!}
{!! Form::inputText(
              [3,9],
              "Info",
              [
                "placeholder" => "Info",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.info"
              ]
            )
!!}
{!! Form::inputText(
              [3,9],
              "Default Value",
              [
                "placeholder" => "Default Value",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.value"
              ]
            )
!!}
{!! Form::inputTextarea(
              [3,9],
              "Event",
              [
                "placeholder" => "Event",
                "wire:model.lazy" => "attributes.column_edit.$selected_column_edit.event_text"
              ],
              "Watch Livewire Documentation Ex : wire:click='OpenModal'"
            )
!!}
{!! Form::selectRadio(
              [3,9],
              "Ignore",
              [
                "name" => "ignore",
                "wire:model" => "attributes.column_edit.$selected_column_edit.ignore"
              ],
              [false=>"Disable",true=>"Enable"],
              "Ignore this field to save into database"
            ) 
!!}