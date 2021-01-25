<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table = 'group';
    protected $fillable = [
		'name'
	];

	/**
     * has user
     */
    public function hasUser()
    {
        return $this->hasMany('App\User', 'group', 'id');
    }

    /**
     * has permission
     */
    public function hasPermission()
    {
        return $this->hasMany('App\Models\GroupPermission', 'group', 'id');
    }

    /**
     * has menu
     */
    public function hasMenu()
    {
        return $this->hasMany('App\Models\GroupMenu', 'group', 'id');
    }
}
