<?php

namespace App\Admin;
use App\Models\Theme;

use Illuminate\Support\Facades\DB;

class AdminSevenHelper{

		public static function navbarSkin()
		{
			if(Theme::first())
			{
				if(Theme::first()->navbar_skin){
					return Theme::first()->navbar_skin;
				}else{
					return 'bg-primary';
				}
			}else{
				return 'bg-primary';
			}
		}

		public static function sidebarSkin()
		{
			if(Theme::first())
			{
				if(Theme::first()->sidebar_skin){
					return Theme::first()->sidebar_skin;
				}else{
					return 'dark bg-primary';
				}
			}else{
				return 'dark bg-primary';
			}
		}

		public static function brandSkin()
		{
			if(Theme::first())
			{
				if(Theme::first()->brand_skin){
					return Theme::first()->brand_skin;
				}else{
					return 'bg-primary';
				}
			}else{
				return 'bg-primary';
			}
		}

		public static function accentSkin()
		{
			if(Theme::first())
			{
				if(Theme::first()->accent_skin){
					return Theme::first()->accent_skin;
				}else{
					return 'bg-primary';
				}
			}else{
				return 'bg-primary';
			}
		}

		public static function colorSkin()
		{
			if(Theme::first())
			{
				if(Theme::first()->accent_skin){
					$bg = Theme::first()->accent_skin;
				}else{
					$bg = 'bg-primary';
				}
			}else{
				$bg = 'bg-primary';
			}
			return str_replace('bg','text', $bg);
		}

		public static function theme($style)
		{
			if(Theme::first())
			{
				switch ($style) {
					case 'is_no_navbar_border':
						if(Theme::first()->is_no_navbar_border){
							return "border-bottom-0";
						}else{
							return "";
						}
					break;

					case 'is_body_small':
						if(Theme::first()->is_body_small){
							return "text-sm";
						}else{
							return "";
						}
					break;

					case 'is_navbar_small':
						if(Theme::first()->is_navbar_small){
							return "text-sm";
						}else{
							return "";
						}
					break;

					case 'is_footer_small':
						if(Theme::first()->is_footer_small){
							return "text-sm";
						}else{
							return "";
						}
					break;

					case 'is_sidebar_small':
						if(Theme::first()->is_sidebar_small){
							return "text-sm";
						}else{
							return "";
						}
					break;

					case 'is_sidebar_flat':
						if(Theme::first()->is_sidebar_flat){
							return "nav-flat";
						}else{
							return "";
						}
					break;

					case 'is_sidebar_legacy':
						if(Theme::first()->is_sidebar_legacy){
							return "nav-legacy";
						}else{
							return "";
						}
					break;

					case 'is_sidebar_compact':
						if(Theme::first()->is_sidebar_compact){
							return "nav-compact";
						}else{
							return "";
						}
					break;

					case 'is_sidebar_child_indent':
						if(Theme::first()->is_sidebar_child_indent){
							return "nav-child-indent";
						}else{
							return "";
						}
					break;

					case 'is_sidebar_child_hide':
						if(Theme::first()->is_sidebar_child_hide){
							return "nav-collapse-hide-child";
						}else{
							return "";
						}
					break;

					case 'is_sidebar_disable_expand':
						if(Theme::first()->is_sidebar_disable_expand){
							return "sidebar-no-expand";
						}else{
							return "";
						}
					break;

					case 'is_brand_small':
						if(Theme::first()->is_brand_small){
							return "text-sm";
						}else{
							return "";
						}
					break;

					case 'is_fixed_navbar':
						if(Theme::first()->is_fixed_navbar){
							return "layout-navbar-fixed";
						}else{
							return "";
						}
					break;

					case 'is_fixed_footer':
						if(Theme::first()->is_fixed_footer){
							return "layout-footer-fixed";
						}else{
							return "";
						}
					break;

					case 'is_sidebar_default_collapse':
						if(Theme::first()->is_sidebar_default_collapse){
							return "sidebar-collapse";
						}else{
							return "";
						}
					break;

					case 'is_fixed_sidebar':
						if(Theme::first()->is_boxed){
							return "layout-fixed";
						}else{
							return "";
						}
					break;

					case 'is_boxed':
						if(Theme::first()->is_boxed){
							return "layout-boxed";
						}else{
							return "";
						}
					break;

					case 'is_top_nav':
						if(Theme::first()->is_top_nav){
							return "layout-top-nav";
						}else{
							return "";
						}
					break;

					default:
						# code...
					break;
				}
			}
		}

	public static function response($array=null){

		$default = ['title','breadcrumb','page','plugins','css','js'];
		if($array != null){
			foreach($default as $key => $value)
			{
				if(!in_array($key, $array)){
					${$key} = "";
				}
			}
		}
		$respose = array_merge($default,$array);
		$respose = array_unique($respose);
		return $respose;
	}

	/**
	 * creating menu
	 * @method createMenu
	 * @param array $menu
	 * @return string
	 */
	public static function createMenu($menu){
		foreach($menu as $ch){
			if(isset($ch['child']))
			{
				echo '<li class="nav-item has-treeview">
						<a href="#" class="nav-link">
							<i class="fas '.$ch['icon'].' nav-icon"></i>
							<p>'.$ch['label'].'</p>
							<i class="right fas fa-angle-left"></i>
						</a>
	    			  </li>
	    			  <ul class="nav nav-treeview">';
	    			  	Self::createMenu($ch['child']);
				echo '</ul>
				    </li>';
			}else{
				echo '<li class="nav-item">
						<a href="'.$ch['url'].'" class="nav-link">
							<i class="fas '.$ch['icon'].' nav-icon"></i>
							<p>'.$ch['label'].'</p>
						</a>
	    			  </li>';
			}
		}
	}

	/**
     * create tree lists
     * @method createTreeList
     * @param array $items
     */
    public static function createTreeList($items){

        $childs = [];

        foreach ($items as &$item) $childs[$item['parent']][] = &$item;
        unset($item);

        foreach ($items as &$item) if (isset($childs[$item['id']]))
            $item['child'] = $childs[$item['id']];

        if(count($childs) > 0){
          return $childs[""];
        }else{
          return 0;
        }

    }

	public static function backendGate($function,$name){
		$user = \Auth::guard('admin')->user();
	  \Gate::forUser($user)->$function($name);
	}

	public static function urlPermission(){
		$uri = \Request::segments();
		$user = \Auth::guard('admin')->user();
		$user_uri = data_get($user,'thisGroup.hasPermission.*.thisPermission.url');
		$allow = false;

		foreach($user_uri as $row){
				if($row){
					$uris = ['backend'];
					$uris = array_merge($uris,explode('/',$row));
					if(count($uris) == count($uri)){
						$check = 0;
						foreach($uris as $key => $segment){
								if($segment != "*"){
									 if($uri[$key] == $segment){
										 $check++;
									 }
								}else{
									$check++;
								}
						}
						if(count($uri) == $check){
							$allow = true;
						}
					}
				}
		}
		if(!$allow){
			abort('403');
		}
	}

	public static function makePathAsHtml($path,$class=null,$attr=null){
		$ext = explode(".", $path);
		$ext = end($ext);
		if(file_exists(\Storage::path($path))){
			$path = \Storage::url($path);
			switch ($ext) {
				case 'png':
				case 'jpg':
				case 'jpeg':
				case 'gif':
				case 'bmp':
					$id = md5($path);
					return "<a href=#! class='show-image' data-path='$path'><img src='$path' class='$class' $attr></a>";
					break;
				case 'pdf':
					return "<iframe src='$path' class='$class' style='width: 70%;height: 300px;border: none;' $attr></iframe>";
				default:
					return "<div class='mt-2 p-4'><i class='fas fa-file fa-3x ".\AdminSeven::colorSkin()."'></i></div>";
					break;
			}
		}
	}
}
