<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupPermission extends Model
{
    protected $table = 'group_permission';

    /**
     * group
     */
    public function thisGroup()
    {
        return $this->belongsTo('App\Models\Group', 'group', 'id');
    }

     /**
     * permission
     */
    public function thisPermission()
    {
        return $this->belongsTo('App\Models\Permission', 'permission', 'id');
    }
}
