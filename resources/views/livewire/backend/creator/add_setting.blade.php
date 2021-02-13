{!! Form::inputTextarea(
              [3,9],
              "Before Form Showed",
              [
                "placeholder" => "Type Script Here",
                "wire:model.lazy" => "attributes.add_setting.before_add"
              ]
            )
!!}
{!! Form::inputTextarea(
              [3,9],
              "Before Store",
              [
                "placeholder" => "Type Script Here",
                "wire:model.lazy" => "attributes.add_setting.before_store"
              ]
            )
!!}
{!! Form::inputTextarea(
              [3,9],
              "After Store",
              [
                "placeholder" => "Type Script Here",
                "wire:model.lazy" => "attributes.add_setting.after_store"
              ]
            )
!!}
{!! Form::inputTextarea(
              [3,9],
              "After Form Close",
              [
                "placeholder" => "Type Script Here",
                "wire:model.lazy" => "attributes.add_setting.after_add"
              ]
            )
!!}