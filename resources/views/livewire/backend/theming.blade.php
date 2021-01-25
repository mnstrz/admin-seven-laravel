<div class="row">
  <section class="col-lg-3">
	<x-card :title="'Styling'">
		<div class="row">
			<div class="col-12">
				<div>
					<input type="checkbox" wire:model="data_array.is_no_navbar_border" wire:change="updateStyle" id="is_no_navbar_border"> <label>No Navbar Border</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_body_small" wire:change="updateStyle" id="is_body_small"> <label>Body Small Text</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_navbar_small" wire:change="updateStyle" id="is_navbar_small"> <label>Navbar Small Text</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_sidebar_small" wire:change="updateStyle" id="is_sidebar_small"> <label>Sidebar Nav Small Text</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_footer_small" wire:change="updateStyle" id="is_footer_small"> <label>Footer Small Text</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_sidebar_flat" wire:change="updateStyle" id="is_sidebar_flat"> <label>Sidebar Nav Flat Style</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_sidebar_legacy" wire:change="updateStyle" id="is_sidebar_legacy"> <label>Sidebar Nav Legacy Style</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_sidebar_compact" wire:change="updateStyle" id="is_sidebar_compact"> <label>Sidebar Nav Compact</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_sidebar_child_indent" wire:change="updateStyle" id="is_sidebar_child_indent"> <label>Sidebar Nav Child Indent</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_sidebar_child_hide" wire:change="updateStyle" id="is_sidebar_child_hide"> <label>Sidebar Nav Child Hide On Collapse</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_sidebar_disable_expand" wire:change="updateStyle" id="is_sidebar_disable_expand"> <label>Main Sidebar Disable Hover/Focus auto Expand</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_brand_small" wire:change="updateStyle" id="is_brand_small"> <label>Brand Small Text</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_fixed_navbar" wire:change="updateStyle" id="is_fixed_navbar"> <label>Fixed Navbar</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_fixed_footer" wire:change="updateStyle" id="is_fixed_footer"> <label>Fixed Footer</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_fixed_sidebar" wire:change="updateStyle" id="is_fixed_sidebar"> <label>Fixed Sidebar</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_sidebar_default_collapse" wire:change="updateStyle" id="is_sidebar_default_collapse"> <label>Default Sidebar Collapsed</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_boxed" wire:change="updateStyle" id="is_boxed"> <label>Boxed Mode</label>
				</div>
				<div>
					<input type="checkbox" wire:model="data_array.is_top_nav" wire:change="updateStyle" id="is_top_nav"> <label>Top Navigation</label>
				</div>
			</div>
		</div>
	</x-card>
  </section>
  <section class="col-lg-9">
  	<div class="row">
	  <section class="col-lg-4">
		<x-card :title="'Navigation Skin'">
			<div class="row">
				<div class="col-12">
					@foreach($navbarSkin as $skin => $val)
						<button class="change-navbar-skin btn btn-rounded {{ $skin }} py-3 px-4 my-2 border {{ ($data) ? ($data->navbar_skin == $skin) ? 'active-button' : '' : '' }}" wire::model.lazy="navbar_skin" wire:click="updateNavbar('{{$skin}}')" data-skin="{{ $skin }}"></button>
					@endforeach
				</div>
			</div>
		</x-card>
	  </section>
	  <section class="col-lg-8">
		<x-card :title="'Sidebar Skin'">
			<div class="row">
				<div class="col-lg-6">
					@foreach($sidebarSkin as $skin => $val)
						@if(strpos($skin,'light ') !== false)
							<button class="change-sidebar-skin btn btn-rounded {{ $skin }} py-3 px-4 my-2 border {{ ($data) ? ($data->sidebar_skin == $skin) ? 'active-button' : '' : '' }}" wire::model="sidebar_skin" wire:click="updateSidebar('{{$skin}}')" data-skin="{{ $skin }}"></button>
						@endif
					@endforeach
				</div>
				<div class="col-lg-6 bg-dark">
					@foreach($sidebarSkin as $skin => $val)
						@if(strpos($skin,'dark ') !== false)
							<button class="change-sidebar-skin btn btn-rounded {{ $skin }} py-3 px-4 my-2 {{ ($data) ? ($data->sidebar_skin == $skin) ? 'active-button' : '' : '' }}" wire::model="sidebar_skin" wire:click="updateSidebar('{{$skin}}')" data-skin="{{ $skin }}"></button>
						@endif
					@endforeach
				</div>
			</div>
		</x-card>
	  </section>
  	</div>
  	<div class="row">
	  <section class="col-lg-4">
		<x-card :title="'Brand'">
			<div class="row">
				<div class="col-lg-12">
					@foreach($brandSkin as $skin => $val)
						<button class="change-brand-skin btn btn-rounded {{ $skin }} py-3 px-4 my-2 {{ ($data) ? ($data->brand_skin == $skin) ? 'active-button' : '' : '' }}" wire::model="brand_skin" wire:click="updateBrand('{{$skin}}')" data-skin="{{ $skin }}"></button>
					@endforeach
				</div>
			</div>
		</x-card>
	  </section>
	  <section class="col-lg-4">
		<x-card :title="'Accent'">
			<div class="row">
				<div class="col-lg-12">
					@foreach($accentSkin as $skin => $val)
						<button class="change-accent-skin btn btn-rounded {{ $skin }} py-3 px-4 my-2 {{ ($data) ? ($data->accent_skin == $skin) ? 'active-button' : '' : '' }}" wire::model="accent_skin" wire:click="updateAccent('{{$skin}}')" data-skin="{{ $skin }}"></button>
					@endforeach
				</div>
			</div>
		</x-card>
	  </section>
	  <section class="col-lg-4">
		<x-card :title="'Card'">
			<div class="row">
				<div class="col-lg-12">
					@foreach($cardSkin as $skin)
						<button class="btn btn-rounded {{ $skin }} border py-3 px-4 my-2 {{ ($data) ? ($data->card_skin == $skin) ? 'active-button' : '' : '' }}" wire::model="card_skin" wire:click="updateCard('{{$skin}}')" data-skin="{{ $skin }}"></button>
					@endforeach
				</div>
			</div>
		</x-card>
	  </section>
  	</div>
  </section>
</div>

@push('js')
	<script type="text/javascript">
		let navbar_skin = JSON.parse('{!! json_encode($navbarSkin) !!}');
		let sidebar_skin = JSON.parse('{!! json_encode($sidebarSkin) !!}');
		let brand_skin = JSON.parse('{!! json_encode($brandSkin) !!}');
		let accent_skin = JSON.parse('{!! json_encode($accentSkin) !!}');

		$(document).on('click','.change-navbar-skin',function(e){
			let skin = $(this).data('skin');
			$('#adminSeven_navbar').removeAttr('class');
			$('#adminSeven_navbar').attr('class',navbar_skin[skin]);
		})
		$(document).on('click','.change-sidebar-skin',function(e){
			let skin = $(this).data('skin');
			$('#adminSeven_sidebar').removeClass(function (index, css) {
			    return (css.match (/\bsidebar-\S+/g) || []).join(' ');
			});
			$('#adminSeven_sidebar').addClass(sidebar_skin[skin]);
		})
		$(document).on('click','.change-brand-skin',function(e){
			let skin = $(this).data('skin');
			$('.adminSeven_brand').removeClass(function (index, css) {
			    return (css.match (/\bbg-\S+/g) || []).join(' ');
			});
			$('.adminSeven_brand').addClass(brand_skin[skin]);
		})
		$(document).on('click','.change-accent-skin',function(e){
			let skin = $(this).data('skin');
			$('body').removeClass(function (index, css) {
			    return (css.match (/\baccent-\S+/g) || []).join(' ');
			});
			$('body').addClass(accent_skin[skin]);
		})
		$(document).on('change','#is_no_navbar_border',function(e){
			if($(this).is(":checked")){
				$('#adminSeven_navbar').addClass("border-bottom-0");
			}else{
				$('#adminSeven_navbar').removeClass("border-bottom-0");
			}
		})
		$(document).on('change','#is_body_small',function(e){
			if($(this).is(":checked")){
				$('body').addClass("text-sm");
			}else{
				$('body').removeClass("text-sm");
			}
		})

		$(document).on('change','#is_navbar_small',function(e){
			if($(this).is(":checked")){
				$('#adminSeven_navbar').addClass("text-sm");
			}else{
				$('#adminSeven_navbar').removeClass("text-sm");
			}
		})

		$(document).on('change','#is_sidebar_small',function(e){
			if($(this).is(":checked")){
				$('.nav-sidebar').addClass("text-sm");
			}else{
				$('.nav-sidebar').removeClass("text-sm");
			}
		})

		$(document).on('change','#is_footer_small',function(e){
			if($(this).is(":checked")){
				$('.main-footer').addClass("text-sm");
			}else{
				$('.main-footer').removeClass("text-sm");
			}
		})

		$(document).on('change','#is_sidebar_flat',function(e){
			if($(this).is(":checked")){
				$('.nav-sidebar').addClass("nav-flat");
			}else{
				$('.nav-sidebar').removeClass("nav-flat");
			}
		})

		$(document).on('change','#is_sidebar_legacy',function(e){
			if($(this).is(":checked")){
				$('.nav-sidebar').addClass("nav-legacy");
			}else{
				$('.nav-sidebar').removeClass("nav-legacy");
			}
		})

		$(document).on('change','#is_sidebar_compact',function(e){
			if($(this).is(":checked")){
				$('.nav-sidebar').addClass("nav-compact");
			}else{
				$('.nav-sidebar').removeClass("nav-compact");
			}
		})

		$(document).on('change','#is_sidebar_child_indent',function(e){
			if($(this).is(":checked")){
				$('.nav-sidebar').addClass("nav-child-indent");
			}else{
				$('.nav-sidebar').removeClass("nav-child-indent");
			}
		})

		$(document).on('change','#is_sidebar_child_hide',function(e){
			if($(this).is(":checked")){
				$('.nav-sidebar').addClass("nav-collapse-hide-child");
			}else{
				$('.nav-sidebar').removeClass("nav-collapse-hide-child");
			}
		})

		$(document).on('change','#is_sidebar_disable_expand',function(e){
			if($(this).is(":checked")){
				$('.main-sidebar').addClass("sidebar-no-expand");
			}else{
				$('.main-sidebar').removeClass("sidebar-no-expand");
			}
		})

		$(document).on('change','#is_brand_small',function(e){
			if($(this).is(":checked")){
				$('#adminSeven_brand').addClass("text-sm");
			}else{
				$('#adminSeven_brand').removeClass("text-sm");
			}
		})

		$(document).on('change','#is_sidebar_default_collapse',function(e){
			if($(this).is(":checked")){
				$('body').addClass("sidebar-collapse");
			}else{
				$('body').removeClass("sidebar-collapse");
			}
		})

		$(document).on('change','#is_fixed_navbar',function(e){
			if($(this).is(":checked")){
				$('body').addClass("layout-navbar-fixed");
			}else{
				$('body').removeClass("layout-navbar-fixed");
			}
		})

		$(document).on('change','#is_fixed_footer',function(e){
			if($(this).is(":checked")){
				$('body').addClass("layout-footer-fixed");
			}else{
				$('body').removeClass("layout-footer-fixed");
			}
		})

		$(document).on('change','#is_boxed',function(e){
			if($(this).is(":checked")){
				$('body').addClass("layout-boxed");
			}else{
				$('body').removeClass("layout-boxed");
			}
		})

		$(document).on('change','#is_fixed_sidebar',function(e){
			if($(this).is(":checked")){
				$('body').addClass("layout-fixed");
			}else{
				$('body').removeClass("layout-fixed");
			}
		})

		$(document).on('change','#is_top_nav',function(e){
			setTimeout(function(){ 
				location.reload();
			}, 1000);
		})
	</script>
@endpush
@push('js')
  <script type="text/javascript">
    openMenu('Configurations');
    activeMenu('Theme');
  </script>
@endpush