@push('js')
	<script type="text/javascript">
		var menu = {!! json_encode($menu) !!};
		var tree_menu = ``;

		function treeMenu(menu)
		{
			$.each(menu,function(key,value){
				if(value.child != null)
				{
					tree_menu += `<li class="nav-item has-treeview menu-${str_slug(value.label)}">
								     <a href="#" class="nav-link menu-${str_slug(value.label)}">
								      <i class="${value.icon} nav-icon"></i>
								      <p>${value.label}</p>
								      <i class="right fas fa-angle-left"></i>
								     </a>
								   <ul class="nav nav-treeview">`;
									 treeMenu(value.child);
					tree_menu +=  `</ul>
								  </li>`;
				}else{
					tree_menu += `<li class="nav-item">
								     <a href="${value.url}" class="nav-link menu-${str_slug(value.label)}">
								      <i class="${value.icon} nav-icon"></i>
								      <p>${value.label}</p>
								     </a>
								   </li>`;
				}
			})
		}
		treeMenu(menu);
		$('#sidebar').append(tree_menu);
	</script>
@endpush