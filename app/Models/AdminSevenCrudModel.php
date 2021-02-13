<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminSevenCrudModel extends Model
{
    protected $table = "admin_seven_crud";

    protected $fillable = [
        'crud_slug','crud_name'
    ];

    public function thisUser()
    {
        return $this->belongsTo('App\User', 'updated_id', 'id');
    }

    public function setCrudNameAttribute($value)
    {
    	$this->attributes['crud_name'] = $value;
        $this->attributes['crud_slug'] = \Str::slug($value);
    }
}
