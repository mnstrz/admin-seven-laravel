<div>
    <div class="row">
	  <section class="col-lg-12">
	    <x-card :title="'Admin Seven Creator'">
	    	<div class="row">
	    		<div class="col-12 col-lg-4">
	    		  <a href="{{ route('backend.new.creator') }}" class="btn btn-flat bg-{{\AdminSeven::color()}} btn-sm">
	    		  	<i class="fa fa-plus"></i> Create New
	    		   </a>
	    		</div>
	    		<div class="col-12 col-lg-4 ml-auto">
			      <div class="input-group input-group-sm">
	                  <input type="text" class="form-control" placeholder="Search ...">
	                  <span class="input-group-append">
	                    <button type="button" class="btn bg-{{\AdminSeven::color()}} btn-flat">
	                    	<i class="fa fa-search"></i>
	                    </button>
	                  </span>
	               </div>
	    		</div>
	    	</div>
	    	<div class="row mt-3">
	    		<div class="col-12">
				      <x-table-simple
				        :position="'center'"
				        :class="'table-head-fixed'"
				      >
				      	<thead>
				      		<tr>
				      			<th>No</th>
				      			<th>Creator Name</th>
				      			<th>Model Name</th>
				      			<th>URL</th>
				      			<th>Created At</th>
				      			<th>Updated At</th>
				      			<th>Last Modify</th>
				      			<th>Action</th>
				      		</tr>
				      	</thead>
				      	<tbody>
				      		@foreach($results as $key => $row)
				      		<tr>
				      			<td>{{ $key+1 }}</td>
				      			<td>{{ $row['crud_name'] }}</td>
				      			<td>{{ $row['model'] }}</td>
				      			<td>{{ $row['crud_slug'].'/creator' }}</td>
				      			<td>{{ \Carbon\Carbon::parse($row['created_at'])->format('d F Y h:i') }}</td>
				      			<td>{{ \Carbon\Carbon::parse($row['updated_at'])->format('d F Y h:i') }}</td>
				      			<td>{{ $row['this_user']['username'] }}</td>
				      			<td>
				      				<a href="{{ route('backend.edit.creator',[$row['id']]) }}" class="btn btn-flat btn-sm btn-warning">
				      					<i class="fa fa-edit"></i>
				      				</a>
				      				<button class="btn btn-flat btn-sm btn-danger" wire:click="delete({{ $row['id'] }})">
				      					<i class="fa fa-trash"></i>
				      				</button>
				      			</td>
				      		</tr>
				      		@endforeach
				      	</tbody>
				  	  </x-table-simple>
	    		</div>
	    		<div class="col-12">
	    			{!! $this->paginate() !!}
	    		</div>
	    	</div>
	    </x-card>
	   </section>
	</div>
	<div class="modal fade" id="delete-confirm">
        <div class="modal-dialog modal-sm">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Delete Confirmation</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Sure delete this data ?</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal" wire:click="cancelDelete">Cancel</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal" wire:click="confirmDelete">Yes, delete</button>
            </div>
          </div>
        </div>
     </div>
</div>
<script type="text/javascript">
	window.addEventListener('confirm-delete', event => {
    	$('#delete-confirm').modal('show');
	})
</script>
@push('js')
  <script type="text/javascript">
    activeMenu('Creator');
  </script>
@endpush
