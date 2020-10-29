<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Theme extends Model
{
    protected $table = 'theme';
    protected $fillable = [
    						'navbar_skin',
    						'is_no_navbar_model'
    					  ];
}
