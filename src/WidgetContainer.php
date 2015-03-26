<?php

/**
 * This file belongs to the AlphaWidget package.
 *
 * @author Reda Bouchaala <bouchaala.reda@gmail.com>
 * @package AlphaWidget
 * @version 0.2.0
*/
namespace BReda\AlphaWidget;

use BReda\AlphaWidget\Exceptions\WidgetAliasExistsException;
use BReda\AlphaWidget\Exceptions\WidgetAliasNotFound;

/**
* This class serves as a container for all our widget aliases and classes.
*/
class WidgetContainer
{

	/**
	 * Registerd Widget aliases.
	 * 
	 * @var array
	 */
	protected $aliases = array();

	/**
	 * Widget Bindings. Key-Value of all Widget aliases, and class names.
	 * Keys represent Aliases. Values represent class base names (Without the namespace).
	 * 
	 * @var array
	 */
	protected $bindings = array();

	/**
	 * Binds a Widget to the container.
	 * 
	 * @param  string $alias 
	 * @param  string $concrete
	 * @throws WidgetAliasExistsException 	This exception is thrown whenever someone 
	 *         								is binding a class to an alias, which already exists.
	 * @return void
	 */
	public function bindWidget($alias, $concrete)
	{
		if( in_array($alias, $this->aliases) )
			throw new WidgetAliasExistsException("Widget with alias [$alias] already exists");

		// Setting up binding
		$this->aliases[] 		= $alias;
		$this->bindings[$alias] = $concrete;
	}

	/**
	 * Determins if a binding exists in the container.
	 * 		
	 * @param  string $alias
	 * @return bool
	 */
	public function bindingExists($alias)
	{
		$exists = ( in_array($alias, $this->aliases) ) && ( !empty($this->bindings[$alias]) );
		
		return $exists;
	}

	/**
	 * Removes a binding from the container.
	 * 
	 * @param  string $alias 
	 * @throws WidgetAliasNotFound
	 * @return void
	 */
	public function forgetBinding($alias)
	{
		if( ! $this->bindingExists($alias) )
			throw new WidgetAliasNotFound("Widget alias [$alias] does not exist.");

		// Removing bindings
		array_diff($this->aliases, [$alias]);	
		unset($this->bindings[$alias]);
	}

	/**
	 * Get the widget class by it's registed alias.
	 * 
	 * @param  string $alias 
	 * @return string
	 */
	public function getWidgetClass($alias)
	{
		if( ! $this->bindingExists($alias) )
			throw new WidgetAliasNotFound("Widget alias [$alias] does not exist.");

		return $this->bindings[$alias];
	}

	/**
	 * Get all registerd aliases.
	 * 
	 * @return array
	 */
	public function getAliases()
	{
		return $this->aliases;
	}

	/**
	 * Get all registerd classes.
	 * 
	 * @return array
	 */
	public function getClasses()
	{
		return array_values($this->bindings);
	}

}