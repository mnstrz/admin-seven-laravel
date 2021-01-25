<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GroupMenu extends Model
{
    protected $table = 'group_menu';

    /**
     * menu
     */
    public function thisMenu()
    {
        return $this->belongsTo('App\Models\Menu', 'menu', 'id');
    }

    /**
     * group
     */
    public function thisGroup()
    {
        return $this->belongsTo('App\Models\Group', 'group', 'id');
    }
}
