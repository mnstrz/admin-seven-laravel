<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Theme;

class Theming extends Component
{
	public $data, $data_array, $navbar_skin, $sidebar_skin, $brand_skin, $accent_skin, $card_skin;
	public $navbarSkin;
	public $sidebarSkin;
	public $brandSkin;
	public $accentSkin;
	public $cardSkin;

	public function mount()
	{
		if(Theme::first())
		{
			$this->data = Theme::first();
			$this->data_array = Theme::first()->toArray();
		}
		$this->navbarSkin = config('adminSeven.navbar');
		$this->sidebarSkin = config('adminSeven.sidebar');
		$this->brandSkin = config('adminSeven.brand');
		$this->accentSkin = config('adminSeven.accent');
		$this->cardSkin = config('adminSeven.bg');
	}

    public function render()
    {
        return view('livewire.backend.theming');
    }

    public function refreshData()
    {
    	if(Theme::first())
		{
			$this->data = Theme::first();
			$this->data_array = Theme::first()->toArray();
		}
    }

    public function updateStyle()
    {
    	if(Theme::first())
		{
			$theme = Theme::first();
		}else{
			$theme = new Theme;
		}
		$theme->is_no_navbar_border = $this->data_array['is_no_navbar_border'];
		$theme->is_body_small = $this->data_array['is_body_small'];
		$theme->is_navbar_small = $this->data_array['is_navbar_small'];
		$theme->is_sidebar_small = $this->data_array['is_sidebar_small'];
		$theme->is_footer_small = $this->data_array['is_footer_small'];
		$theme->is_sidebar_flat = $this->data_array['is_sidebar_flat'];
		$theme->is_sidebar_legacy = $this->data_array['is_sidebar_legacy'];
		$theme->is_sidebar_compact = $this->data_array['is_sidebar_compact'];
		$theme->is_sidebar_child_indent = $this->data_array['is_sidebar_child_indent'];
		$theme->is_sidebar_child_hide = $this->data_array['is_sidebar_child_hide'];
		$theme->is_sidebar_disable_expand = $this->data_array['is_sidebar_disable_expand'];
		$theme->is_brand_small = $this->data_array['is_brand_small'];
		$theme->is_fixed_navbar = $this->data_array['is_fixed_navbar'];
		$theme->is_fixed_footer = $this->data_array['is_fixed_footer'];
		$theme->is_sidebar_default_collapse = $this->data_array['is_sidebar_default_collapse'];
		$theme->is_boxed = $this->data_array['is_boxed'];
		$theme->is_fixed_sidebar = $this->data_array['is_fixed_sidebar'];
		$theme->is_top_nav = $this->data_array['is_top_nav'];
		$theme->save();

		$this->refreshData();
    }

    public function updateNavbar($skin)
    {
    	if(Theme::first())
		{
			$theme = Theme::first();
		}else{
			$theme = new Theme;
		}
		$theme->navbar_skin = $skin;
		$theme->is_no_navbar_border = 0;
		$theme->save();

		$this->refreshData();
    }

    public function updateSidebar($skin)
    {
    	if(Theme::first())
		{
			$theme = Theme::first();
		}else{
			$theme = new Theme;
		}
		$theme->sidebar_skin = $skin;
		$theme->save();

		$this->refreshData();
    }

    public function updateBrand($skin)
    {
    	if(Theme::first())
		{
			$theme = Theme::first();
		}else{
			$theme = new Theme;
		}
		$theme->brand_skin = $skin;
		$theme->save();

		$this->refreshData();
    }

    public function updateAccent($skin)
    {
    	if(Theme::first())
		{
			$theme = Theme::first();
		}else{
			$theme = new Theme;
		}
		$theme->accent_skin = $skin;
		$theme->save();

		$this->refreshData();
    }

    public function updateCard($skin)
    {
    	if(Theme::first())
		{
			$theme = Theme::first();
		}else{
			$theme = new Theme;
		}
		$theme->card_skin = $skin;
		$theme->save();

		$this->refreshData();
    }
}
