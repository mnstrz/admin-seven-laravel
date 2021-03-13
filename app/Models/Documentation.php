<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Documentation extends Model
{
    protected $table = 'documentation';

    public function nextPage()
    {
    	return $this->belongsTo('App\Models\Documentation','next','id');
    }

    public function prevPage()
    {
    	return $this->belongsTo('App\Models\Documentation','prev','id');
    }
}
