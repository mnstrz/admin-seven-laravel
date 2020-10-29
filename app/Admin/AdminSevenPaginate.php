<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;

trait AdminSevenPaginate{

	public $currentPage = 1;
	public $lastPage;
	public $firstPage = 1;
	public $perPage = 10;
	public $option_perpage = [1 => 1,3 => 3,4 => 4];
	public $totalPage;

	public function getPaginate()
	{
		
	}

}