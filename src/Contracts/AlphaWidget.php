<?php

/**
 * This file belongs to the AlphaWidget package.
 *
 * @author Reda Bouchaala <bouchaala.reda@gmail.com>
 * @package AlphaWidget
 * @version 0.2.0
*/
namespace BReda\AlphaWidget\Contracts;

interface AlphaWidget
{
	/**
	 * Render the widget contents.
	 * 	
	 * @return mixed
	 */
	public function render();
}