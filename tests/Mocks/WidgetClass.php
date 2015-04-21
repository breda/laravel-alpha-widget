<?php

use BReda\AlphaWidget\Contracts\AlphaWidget;

class WidgetClass implements AlphaWidget
{
	private $limit;

	public function __construct($limit = 4){
		$this->limit = $limit;
	}

	public function render()
	{
		return "Showing {$this->limit} recent posts";
	}
}