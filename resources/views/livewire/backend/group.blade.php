<div class="row">
  <section class="col-lg-3">
	<x-card :title="'Filter'">
		<x-form-input-text 
	      	:column="'12:12'"
	      	:label="'Nama Group'"
	      	require="require"
	      	placeholder="Nama Group"
	      	:wire:model="'filter_name'"
	      />
	      <x-form-select
	      	:column="'12:12'" 
	      	:label="'Per Page'"
	      	:options="$option_perpage"
	      	placeholder="Per Page"
	      	:wire:model="'perpage'"
	      	name="perpage"
	      />
	</x-card>
  </section>

  @if($form)
  <section class="col-lg-9">
	<x-card :title="'Form Group'">
	</x-card>
  </section>
  @endif

  <section class="col-lg-9">
	<x-card :title="'Lists Group'">
		<x-table-simple
	        :class="'table-striped'"
	    >
	    	<thead>
	          <tr>
	            <th style="width: 10px">#</th>
	            <th>Nama Group</th>
	            <th>Action</th>
	          </tr>
	        </thead>
	        <tbody>
	        	@if(count($results) > 0)
		        	@foreach ($results as $key => $value)
		        	<tr>
		        		<td>{{ $key+1 }}</td>
		        		<td>{{ $value->name }}</td>
		        		<td></td>
		        	</tr>
		        	@endforeach
	        	@endif
	        </tbody>
		</x-table-simple>
		<div class="row mt-2">
			<div class="col-12">
				<ul class="pagination pagination-sm m-0 justify-content-center" id="pagination">
		        </ul>
			</div>
		</div>
	</x-card>
  </section>
</div>
@push('js')
  <script type="text/javascript">
    
  </script>
@endpush