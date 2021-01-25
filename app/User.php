<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    /*protected $hidden = [
        'password', 'remember_token',
    ];*/

    /**
     * Group Users
     */

    public function thisGroup()
    {
        return $this->belongsTo('App\Models\Group', 'group', 'id');

    }

    public function setUsernameAttribute($value){
        $value = preg_replace("/[^A-Za-z0-9 ]/", '', $value);
        $this->attributes['username'] = $value;
    }

    public function setPasswordAttribute($value){
        if($value){
            $this->attributes['password'] = \Hash::make($value);
        }
    }
}
