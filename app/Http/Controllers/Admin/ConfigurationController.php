<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{
    protected $title = 'Configuration';
  	protected $breadcrumb = [
  		'Configuration' => '#'
  	];

    /**
     * @method config
     * @return void
     */
    public function config()
    {
      $title = $this->title;
      $breadcrumb = [
        'Configuration' => route('backend.config')
      ];
      $livewire = "backend-config";
      $plugins = "formAdvance formEditor tableSimple";

      $response = [
        'title','breadcrumb','livewire','plugins'
      ];
      return view('admin-seven',compact($response));
    }

	  /**
     * @method group
     * @return void
     */
    public function group()
    {
    	$title = 'Group '.$this->title;
    	$breadcrumb = [
    		'Configuration' => '#',
    		'Group' => route('backend.group')
    	];
    	$livewire = "backend-group";
      $plugins = "formAdvance formEditor tableSimple";

    	$response = [
    		'title','breadcrumb','livewire','plugins'
    	];
    	return view('admin-seven',compact($response));
    }

    /**
     * @method user
     * @return void
     */
    public function user()
    {
      $title = 'User '.$this->title;
      $breadcrumb = [
        'Configuration' => '#',
        'User' => route('backend.user')
      ];
      $livewire = "backend-user";
      $plugins = "formAdvance formEditor tableSimple";

      $response = [
        'title','breadcrumb','livewire','plugins'
      ];
      return view('admin-seven',compact($response));
    }

    /**
     * @method menu
     * @return void
     */
    public function menu()
    {
      \AdminSeven::backendGate('authorize','config-menu');
      $title = 'Menu '.$this->title;
      $breadcrumb = [
        'Configuration' => '#',
        'Menu' => route('backend.menu')
      ];
      $livewire = "backend-menu";
      $plugins = "formAdvance formEditor tableSimple";

      $response = [
        'title','breadcrumb','livewire','plugins'
      ];
      return view('admin-seven',compact($response));
    }

    /**
     * @method permission
     * @return void
     */
    public function permission()
    {
      $title = 'Permission '.$this->title;
      $breadcrumb = [
        'Configuration' => '#',
        'Permission' => route('backend.permission')
      ];
      $livewire = "backend-permission";
      $plugins = "formAdvance formEditor tableSimple";

      $response = [
        'title','breadcrumb','livewire','plugins'
      ];
      return view('admin-seven',compact($response));
    }

    /**
     * @method profile
     * @return void
     */
    public function profile()
    {
      $title = 'Profile '.$this->title;
      $breadcrumb = [
        'Configuration' => '#',
        'Profile' => route('backend.profile')
      ];
      $livewire = "backend-profile";
      $plugins = "formAdvance formEditor tableSimple";

      $response = [
        'title','breadcrumb','livewire','plugins'
      ];
      return view('admin-seven',compact($response));
    }
}
