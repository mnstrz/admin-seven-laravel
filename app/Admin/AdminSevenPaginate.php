<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;

trait AdminSevenPaginate{

	public $page = 1;
	public $per_page = 10;
	public $list_per_page = [10,20,50,100];
	public $total = 0;
	public $prev_page;
	public $next_page;
	public $list_page = [];

	/**
	 * set default pagination
	 *
	 * @method setPagination
	 * @return void
	 */
	public function setPagination()
	{
	}

	/**
	 * set perpage
	 * @method perPage
	 * @param int $per_page
	 */
	public function perPage($per_page){
		$this->per_page = $per_page;
	}

	/**
	 * set perpage
	 * @method listPerPage
	 * @param int $list_per_page
	 */
	public function listPerPage($list_per_page){
		$this->list_per_page = $list_per_page;
	}

	/**
	 * set perpage
	 * @method defaultPage
	 * @param int $page
	 */
	public function defaultPage($page){
		$this->page = $page;
	}

	/**
	 * next page
	 * @param nextPage
	 * @return void
	 */
	public function nextPage()
	{
		$this->page = $this->next_page;
		$this->reloadPage();
	}

	/**
	 * previous page
	 * @param prevPage
	 * @return void
	 */
	public function prevPage()
	{
		$this->page = $this->prev_page;
		$this->reloadPage();
	}

	/**
	 * to page
	 * @param toPage
	 * @return void
	 */
	public function toPage($page)
	{
		$this->page = $page;
		$this->reloadPage();
	}

	/**
	 * get list page
	 * @param updateListpage
	 * @return void
	 */
	public function updateListpage()
	{
		$pagingList = $this->pagingList($this->page,$this->total,$this->per_page);
		$this->list_page = $pagingList['data'];
		$this->prev_page = $pagingList['prev'];
		$this->next_page = $pagingList['next'];
	}

	/**
	 * change per page
	 * @param changePerPage
	 * @return void
	 */
	public function changePerPage($perpage)
	{
		$this->per_page = $perpage;
		$this->page = 1;
		$this->reloadPage();
	}

	/**
     * for list pagination
     * @param int $page
     * @param int $total
     * @param int $per_page
     * @return array
     */
    public static function pagingList($page,$total,$per_page){

        $current_page = ($page) ? $page : 1;
        $last_page = ceil($total/$per_page);
        $total = $total;
        $prev_page = ($current_page <= 1) ? 1 : $current_page-1;
        $next_page = ($current_page >= $last_page) ? $last_page : $current_page+1;

        $delta = 2;
        $range = [];
        $rangeWithDots = [];
        $l = "";

        $button = '';
        $active = '';

        for ($i = 1; $i <= ceil($total/$per_page); $i++) {
          if($i == 1 || $i == ceil($total/$per_page) || $i >= $current_page-$delta && $i < $current_page+$delta+1) {
              array_push($range, $i);
          }
        }

        foreach($range as $i) {
          if($l){
            if($i - $l === 2){
                array_push($rangeWithDots,$l+1);
            }elseif($i - $l !==1){
                array_push($rangeWithDots,"...");
            }
          }
          array_push($rangeWithDots,$i);
          $l = $i;
        }
        $response = [
            'prev' => $prev_page,
            'next' => $next_page,
            'data' => $rangeWithDots
        ];
        return $response;
    }

    /**
     * reset pagination
     *
     * @method resetPagination
     * @return void
     */
    public function resetPagination()
	{
		$this->page = 1;
		$this->total = 0;
	}

    /**
     * create pagination
     *
     * @method createPagination
     * @return void
     */
    public function createPagination($results)
	{
		$this->total = $results['total'];
		$this->page = $results['current_page'];
    	$this->updateListpage();
	}

    /**
     * paginate
     * @method paginate
     * @return void
     */
    public function paginate()
    {
    	$response = [
    		'page' => $this->page,
    		'per_page' => $this->per_page,
    		'list_per_page' => $this->list_per_page,
    		'total' => $this->total,
    		'prev_page' => $this->prev_page,
    		'next_page' => $this->next_page,
    		'list_page' => $this->list_page
    	];
        return view('livewire.backend.crud.pagination',$response);
    }
}