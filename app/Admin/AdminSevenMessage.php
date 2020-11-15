<?php

namespace App\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

trait AdminSevenMessage{

	public $message = [];

	/**
	 * show message
	 *
	 * @method showMessage
	 * @param string $message
	 * @param string variant
	 * @return void
	 */
	public function showMessage($variant,$message)
	{
		$this->message = [
			"message" => $message,
			"variant" => $variant
		];
		$this->dispatchBrowserEvent('show-message',['message' => $this->message]);
		return $this;
	}

	/**
	 * close message
	 *
	 * @method closeMessage
	 * @return void
	 */
	public function closeMessage()
	{
		$this->message = [];
		$this->dispatchBrowserEvent('close-message');

		return $this;
	}
}