<div class="row">
  <section class="col-lg-12">
    <x-card :title="'Form Admin Seven'">
      <x-form-input-text 
      	:column="'2:6'" {{-- 2 for label width and 6 for field --}}
      	:label="'Text Input'"  {{-- text label --}}
      	:help="'information'" {{-- help information --}}
      	:class="''" {{-- add more class and will be class="form-control [your-class] " --}}
      	require="require"
      	name="text"
      	placeholder="placeholder here"
      />
      <x-form-input-email 
      	:column="'2:6'"
      	:label="'Email'"
      	:help="'information'"
      	:class="''"
      	require="require"
      	name="email"
      	placeholder="Email"
      	value="test@gmail.com"
      />
      <x-form-input-password 
      	:column="'2:6'" 
      	:label="'Password Input'" 
      	:class="''"
      	name="password"
      	placeholder="Password"
      	:color="'info'"
      />
      <x-form-input-date 
      	:column="'2:6'" 
      	:label="'Date'" 
      	:class="''"
      	name="date"
      	placeholder="Date"
      	value="2020-01-01"
      	:color="'success'"
      />
      <x-form-input-date-range
      	:column="'2:6'" 
      	:label="'Date Range'" 
      	:class="''"
      	name="daterange"
      	placeholder="Date"
      	value="2020-01-01"
      	:color="'success'"
      />
      <x-form-input-date-time-range
      	:column="'2:6'" 
      	:label="'Date Time Range'" 
      	:class="''"
      	name="date_time_range"
      	placeholder="Date"
      	value="2020-01-01"
      	:color="'warning'"
      />
      {{-- this PHP script bellow for select options --}}
      @php
      	$options = [
      		'1' => 'One',
      		'2' => 'Two',
      		'3' => 'Three | disabled' /* make sure first string is your option's text and if you want add some attributes for spesific option use | as delimiter */
      	];
      @endphp
      <x-form-select
      	:column="'2:6'" 
      	:label="'Country'" 
      	:class="''"
      	:color="'danger'"
      	:options="$options" {{-- put options as array in PHP variable --}}
      	:default="'2'"
      	placeholder="Pilih"
      	name="select"
      />
      <x-form-input-number 
      	:column="'2:6'"
      	:label="'Number Input'"
      	:class="''"
      	require="require"
      	name="number"
      	placeholder="placeholder here"
      	:before="'$'"
      />
      <x-form-input-text-append 
      	:column="'2:3'"
      	:label="'Text Append'"
      	:class="''"
      	require="require"
      	name="text"
      	placeholder="placeholder here"
      	:before="'AB'"
      	:after="'XY'"
      	:color="'purple'"
      />
      <x-form-input-color
      	:column="'2:6'" 
      	:label="'Color'" 
      	:class="''"
      	name="color"
      	placeholder="Color"
      />
      <x-form-input-time
      	:column="'2:2'" 
      	:label="'Time'" 
      	:class="''"
      	name="time"
      	placeholder="Time"
      />
      {{-- this PHP script bellow for checkbox property --}}
      @php
      	$options = [
      		'1' => 'One',
      		'2' => 'Two',
      		'3' => 'Three | disabled'
      	];
      	$value = ['1','3']; /*because of checkbox is array format value, add :value in your attributes if you want to make default checked*/
      @endphp
      <x-form-checkbox
      	:column="'2:6'" 
      	:label="'Checkbox'" 
      	:class="''"
      	:color="'success'"
      	:options="$options" {{-- put options as array in PHP variable --}}
      	:value="$value" {{-- put value here --}}
      	placeholder="Pilih"
      	name="checkbox"
      />
      {{-- this PHP script bellow for checkbox property --}}
      @php
      	$options = [
      		'1' => 'One',
      		'2' => 'Two',
      		'3' => 'Three | disabled'
      	];
      @endphp
      <x-form-radio
      	:column="'2:6'" 
      	:label="'Radio'" 
      	:class="''"
      	:color="'info'"
      	:options="$options" {{-- put options as array in PHP variable --}}
      	:default="'2'"
      	placeholder="Pilih"
      	name="radio"
      />
      <x-form-upload
      	:column="'2:6'" 
      	:label="'Upload File'" 
      	:class="''"
      	:path="''"
      	placeholder="Pilih"
      	name="file"
      />
      <x-form-text-area
        :column="'2:6'" 
        :label="'Textarea'" 
        :class="''"
        :path="''"
        placeholder="Text here"
        name="textarea"
        value=""
      />
    </x-card>
    <x-card :title="'Stepper'">
      @php
        $steps = ['Logins','Various Information'];
      @endphp
      <x-stepper :steps="$steps" :buttons="true">
        <div id="logins" class="content" role="tabpanel" aria-labelledby="logins-trigger">
          <x-form-input-text 
            :column="'2:6'"
            :label="'Text Input'"
            :help="'information'"
            :class="''"
            require="require"
            name="text"
            placeholder="placeholder here"
          />
          <x-form-input-email 
            :column="'2:6'"
            :label="'Email'"
            :help="'information'"
            :class="''"
            require="require"
            name="email"
            placeholder="Email"
            value="test@gmail.com"
          />
        </div>
        <div id="various-information" class="content" role="tabpanel" aria-labelledby="various-information-trigger">
          <x-form-upload
            :column="'2:6'" 
            :label="'Upload File'" 
            :class="''"
            :path="''"
            placeholder="Pilih"
            name="file"
          />
        </div>
      </x-stepper>
    </x-card>
    <x-card :title="'Dropzone'">
      <x-dropzone :path="'/'" :label="'Upload File'">
      </x-dropzone>
    </x-card>
    <x-card :title="'Summer Note'">
      <x-text-editor
        :column="'2:10'"
        :label="'Text Editor'"
        placeholder="'Text Editor'"
        name="texteditor"
      />
    </x-card>
    <x-card :title="'Code Miror'">
      <x-text-code
        :column="'2:10'"
        :label="'Text Code'"
        placeholder="'Text Code'"
        name="textcode"
        value="<h1> Sample Content </h1>"
      />
    </x-card>
  </section>
</div>
@push('js')
  <script type="text/javascript">
    openMenu('Template');
    activeMenu('Form');
  </script>
@endpush