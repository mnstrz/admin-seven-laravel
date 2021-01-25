<?php

namespace App\Providers;

//use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Group;
use App\Models\Permission;

class AdminSevenProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        require_once app_path().'/Admin/AdminSevenHelper.php';
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
      if(!$this->app->runningInConsole()){
          $this->registerPolicies();

          $groups = Group::all();
          foreach($groups as $group){
              Gate::define('is'.\Str::of($group->name)->replace(" ",""), function($user) use ($group) {
                 return $user->thisGroup->id == $group->id;
              });
          }

          $menus = Menu::all();
          foreach ($menus as $menu) {
              Gate::define(\Str::slug($menu->name,"-"), function($user) use ($menu) {
                 $allow = false;
                 foreach($user->thisGroup->hasMenu as $row){
                      if($row->thisMenu->name == $menu->name){
                          $allow = true;
                      }
                 }
                 return $allow;
              });
          }

          $permissons = Permission::all();
          foreach($permissons as $permission){
            Gate::define(\Str::slug($permission->name,"-"), function($user) use ($permission) {
               $allow = false;
               foreach($user->thisGroup->hasPermission as $row){
                    if($row->thisPermission->name == $permission->name){
                        $allow = true;
                    }
               }
               return $allow;
            });
          }
      }
    }
}
