<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FakeTable extends Model
{
	protected $table = 'fake_table';
    protected $fillable = [
		'name',
		'email',
		'address',
		'phone'
	];
}
