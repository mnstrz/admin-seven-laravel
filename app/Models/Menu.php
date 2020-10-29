<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = [
		'parent',
		'name',
		'url'
	];

	/**
     * parentnya
     */
    public function thisParent()
    {
        return $this->belongsTo('App\Models\Menu', 'parent', 'id');
    }
}
