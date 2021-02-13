{!! Form::inputTextarea(
              [3,9],
              "Before Form Showed",
              [
                "placeholder" => "Type Script Here",
                "wire:model.lazy" => "attributes.edit_setting.before_edit"
              ]
            )
!!}
{!! Form::inputTextarea(
              [3,9],
              "Before Update",
              [
                "placeholder" => "Type Script Here",
                "wire:model.lazy" => "attributes.edit_setting.before_update"
              ]
            )
!!}
{!! Form::inputTextarea(
              [3,9],
              "After Update",
              [
                "placeholder" => "Type Script Here",
                "wire:model.lazy" => "attributes.edit_setting.after_update"
              ]
            )
!!}
{!! Form::inputTextarea(
              [3,9],
              "After Form Close",
              [
                "placeholder" => "Type Script Here",
                "wire:model.lazy" => "attributes.edit_setting.after_edit"
              ]
            )
!!}