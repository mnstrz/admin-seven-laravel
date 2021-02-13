<div class="row">
  <section class="col-lg-12">
    <x-card :title="'Form Admin Seven'">
      {!! Form::inputText(
                      [2,6],
                      "Text Input",
                      [
                        "name" => "text",
                        "placeholder" => "Text Input",
                        "wire:click" => "doSomething"
                      ],
                      "Information"
                    ) 
      !!}
      <label class="badge badge-danger"> Text Input is required</label>
      {!! Form::inputEmail(
                      [2,6],
                      "Email",
                      [
                        "name" => "email",
                        "placeholder" => "Email Input",
                        "value" => "test@gmail.com"
                      ],
                      "Information"
                    ) 
      !!}
      {!! Form::inputPassword(
                      [2,6],
                      "Password",
                      [
                        "name" => "password",
                        "placeholder" => "Password",
                        "color" => "danger"
                      ],
                      "Information"
                    ) 
      !!}
      {!! Form::inputDate(
                      [2,6],
                      "Date",
                      [
                        "name" => "date",
                        "placeholder" => "Date",
                        "value" => date('Y-m-d'),
                        "color" => "success",
                      ],
                      "Information"
                    ) 
      !!}
      {!! Form::inputDatetime(
                      [2,6],
                      "Date Time",
                      [
                        "name" => "datetime",
                        "placeholder" => "Date time",
                        "value" => date('Y-m-d h:i:s'),
                        "color" => "secondary",
                      ],
                      "Information"
                    ) 
      !!}
      {!! Form::inputDaterange(
                      [2,6],
                      "Date Range",
                      [
                        "name" => "daterange",
                        "placeholder" => "Date",
                        "color" => "info",
                      ],
                      "Information"
                    ) 
      !!}
      {!! Form::inputDatetimerange(
                      [2,6],
                      "Date Time Range",
                      [
                        "name" => "datetimerange",
                        "placeholder" => "Date",
                        "color" => "warning",
                      ],
                      "Information"
                    ) 
      !!}
      @php
      	$options = [
      		'1' => 'One',
      		'2' => 'Two',
      		'3' => 'Three | disabled' /* make sure first string is your option's text and if you want add some attributes for spesific option use | as delimiter */
      	];
      @endphp
      {!! Form::selectOption(
                      [2,6],
                      "Select Option",
                      [
                        "name" => "select",
                        "placeholder" => "Select One",
                        "color" => "danger",
                        "value" => "2",
                        "livewire" => false
                      ],
                      $options,
                      "Information"
                    ) 
      !!}
      {!! Form::inputNumber(
                      [2,6],
                      "Number Input",
                      [
                        "name" => "number",
                        "placeholder" => "Number",
                        "color" => "orange",
                        "value" => "2000",
                        "before" => "$"
                      ],
                      "Information"
                    ) 
      !!}
      {!! Form::inputTextAppend(
                      [2,3],
                      "Text Append",
                      [
                        "name" => "text",
                        "placeholder" => "Text Append",
                        "color" => "purple",
                        "value" => "2000",
                        "before" => "AB",
                        "after" => "XY"
                      ],
                      "Information"
                    ) 
      !!}
      {!! Form::inputButtonAppend(
                      [2,3],
                      "Button Append",
                      [
                        "name" => "text",
                        "placeholder" => "Text Append",
                        "color" => "purple",
                        "value" => "2000",
                        "before" => "<button type='submit' class='btn btn-sm btn-primary'><i class='fa fa-search'></i></button>",
                        "after" => "<button type='submit' class='btn btn-sm btn-info'><i class='fa fa-upload'></i></button>"
                      ],
                      "Information"
                    ) 
      !!}
      {!! Form::inputColor(
                      [2,4],
                      "Color",
                      [
                        "name" => "color",
                        "placeholder" => "Color"
                      ],
                      "Information"
                    ) 
      !!}
      {!! Form::inputTime(
                      [2,4],
                      "Time",
                      [
                        "name" => "time",
                        "placeholder" => "Time"
                      ],
                      "Information"
                    ) 
      !!}
      {{-- this PHP script bellow for checkbox property --}}
      @php
      	$options = [
      		'1' => 'One',
      		'2' => 'Two',
      		'3' => 'Three | disabled'
      	];
      	$values = ['1','3']; /*because of checkbox is array format value, add :value in your attributes if you want to make default checked*/
      @endphp
      {!! Form::selectCheckbox(
                      [2,6],
                      "Select Checkbox",
                      [
                        "name" => "checkbox",
                        "color" => "success"
                      ],
                      $options,
                      $values,
                      "Information"
                    ) 
      !!}
      {{-- this PHP script bellow for checkbox property --}}
      @php
      	$options = [
      		'1' => 'One',
      		'2' => 'Two',
      		'3' => 'Three | disabled'
      	];
      @endphp
      {!! Form::selectRadio(
                      [2,6],
                      "Select Radio",
                      [
                        "name" => "radio",
                        "color" => "pink",
                        "value" => 2
                      ],
                      $options,
                      "Information"
                    ) 
      !!}
      {!! Form::uploadFile(
                      [2,6],
                      "Upload File",
                      [
                        "name" => "upload",
                        "color" => "red"
                      ],
                      "",
                      "Information"
                    ) 
      !!}
      {!! Form::inputTextarea(
                      [2,6],
                      "Text Area",
                      [
                        "name" => "textarea",
                        "placeholder" => "some text here"
                      ],
                      "Information"
                    ) 
      !!}
    </x-card>
    <x-card :title="'Dropzone'">
      {!! Form::dropZone(
                      [
                        "path_upload" => '/'
                      ],
                      [
                        [
                          "name" => "Existing file 1",
                          "size" => 10240,
                          "path" => "upload/existing.file"
                        ],
                        [
                          "name" => "Existing file 2",
                          "size" => 10240,
                          "path" => "upload/existing2.file"
                        ]
                      ]
                    ) 
      !!}
    </x-card>
    <x-card :title="'Summer Note'">
      {!! Form::inputTextEditor(
                      [2,10],
                      "Text Editor",
                      [
                        "name" => "texteditor",
                        "placeholder" => "Some text here"
                      ],
                      "Information"
                    ) 
      !!}
    </x-card>
    <x-card :title="'Code Miror'">
      {!! Form::inputTextCode(
                      [2,10],
                      "Text Code",
                      [
                        "name" => "textcode",
                        "placeholder" => "Some text here",
                        "value" => "<h1> Sample Content </h1"
                      ],
                      "Information"
                    ) 
      !!}
    </x-card>
  </section>
</div>
@push('js')
  <script type="text/javascript">
    openMenu('Template');
    activeMenu('Form Collective');
  </script>
@endpush