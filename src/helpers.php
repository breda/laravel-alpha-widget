<?php

/**
 * This file belongs to the AlphaWidget package.
 *
 * @author Reda Bouchaala <bouchaala.reda@gmail.com>
 * @package AlphaWidget
 * @version 0.2.0
*/


if( ! function_exists('alphaWidget') )
{
	/**
	 * Render a Widget, or just get the WidgetFactory
	 * 
	 * @param  string|null 		$alias
	 * @param  array  			$arguments
	 * @return mixed
	 */
	function alphaWidget($alias = null, $arguments = [])
	{
		if( !is_null($alias) )
			return alphaWidget()->render($alias, $arguments);

		return app('alphawidget.factory');
	}
}