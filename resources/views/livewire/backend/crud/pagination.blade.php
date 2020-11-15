<div class="d-flex flex-row justify-content-between">
	@if(count($list_page) > 0)
	<nav>
	  <ul class="pagination pagination-sm m-0 float-right">
	    <li class="page-item {{ ($page <= 1) ? 'disabled' : ''  }}">
	      <button class="page-link"
	      	 aria-label="Previous"
	      	 wire:click="prevPage"
	      	 {{ ($page <= 1) ? 'disabled' : ''  }}
	      >
	        <span ><i class="fas fa-chevron-left"></i></span>
	      </button>
	    </li>
	    @foreach($list_page as $i)
	    <li class="page-item {{ ($i == $page) ? 'active' : '' }}">
	    	<button class="page-link"
	    	   wire:click="toPage({{$i}})"
	    	   {{ ($i == "...") ? "disabled" : '' }}
	    	>{{ $i }}</button>
	    </li>
	    @endforeach
	    <li class="page-item {{ ($page >= ceil($total/$per_page)) ? 'disabled' : ''  }}">
	      <button class="page-link"
	      	 aria-label="Next"
	      	 wire:click="nextPage"
	      	 {{ ($page >=ceil($total/$per_page)) ? 'disabled' : ''  }}
	      >
	        <span ><i class="fas fa-chevron-right"></i></span>
	      </button>
	    </li>
	  </ul>
	</nav>
	@endif
	<div class="d-flex flex-row">
		<span class="mr-2">Show</span>
		<div class="dropdown shadow">
		  <button class="btn btn-light dropdown-toggle btn-sm" data-toggle="dropdown">
		    {{ $per_page }}
		  </button>
		  <div class="dropdown-menu dropdown-menu-right">
		    @foreach($list_per_page as $row)
		    	<a class="dropdown-item" href="#" script="javascript:void(0)" wire:click="changePerPage({{$row}})">{{ $row }}</a>
		    @endforeach
		  </div>
		</div>
	</div>
</div>