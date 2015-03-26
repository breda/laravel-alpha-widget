<?php

/**
 * This file belongs to the AlphaWidget package.
 *
 * @author Reda Bouchaala <bouchaala.reda@gmail.com>
 * @package AlphaWidget
 * @version 0.2.0
*/
namespace BReda\AlphaWidget;

use ReflectionClass;
use BReda\AlphaWidget\WidgetContainer;
use BReda\AlphaWidget\Contracts\AlphaWidget;
use BReda\AlphaWidget\Exceptions\WidgetAliasNotFound;
use BReda\AlphaWidget\Exceptions\IncorrectWidgetClassException;

use Illuminate\Foundation\Application;
use Illuminate\Config\Repository as Config;

/**
* This class is responsible for getting class instances, and returning data from them.
*/
class WidgetFactory extends WidgetContainer
{

	/**
	 * The Widget Contract that all Widget classes must implement.
	 *
	 * @var string
	 */
	const WIDGET_CONTRACT = 'BReda\AlphaWidget\Contracts\AlphaWidget';

	
	/**
	 * Create a new WidgetFactory instance.
	 * @param Application $app    	The Laravel's Application instance.
	 * @param Config      $config 	The Laravel's Config Repository.
	 */
	function __construct(Application $app, Config $config)
	{
		// Set up
		$this->app 		= $app;
		$this->config 	= $config;

		// Register the bindings.
		$this->registerBindings();
	}

	/**
	 * Register the bindings from the config array.
	 * 
	 * @return void
	 */
	protected function registerBindings()
	{
		$widgetsNamespace 	= $this->config->get('alphaWidget.namespace');
		$bindings 			= $this->config->get('alphaWidget.widgets');

		foreach($bindings as $alias => $className)
		{
			// Some sanitization on the class name
			if( ends_with($widgetsNamespace, "\\") )
				$concrete = $widgetsNamespace . $className;
			else 
				$concrete = $widgetsNamespace . "\\" . $className;

			$this->bindWidget($alias, $concrete);
		}
	}

	/**
	 * Return a new Widget instance.
	 * 
	 * @param  string 				$alias
	 * @param  array  				$arguments
	 * @throws IncorrectWidgetClassException
	 * @return AlphaWidgetContract
	 */
	public function make($alias, $arguments = [])
	{
		$widgetClass = $this->getWidgetClass($alias);
		$reflector   = new ReflectionClass($widgetClass);

		// Checking wether the Widget class implements the correct interface.
		if( ! $reflector->implementsInterface(static::WIDGET_CONTRACT) )
			throw new IncorrectWidgetClassException(
				"Widget class [$widgetClass] must implement the Widget Contract [" . static::WIDGET_CONTRACT . "]"
			);

		// return the Widget object, after resolving all of it's dependencies through the IoC container.
		return $this->app->make($widgetClass, $arguments);
	}

	/**
	 * Dynamically access Widget classes, and get the renderd contents.
	 * 	
	 * @param  string $alias
	 * @param  array  $arguments
	 * @return mixed
	 */
	public function render($alias, $arguments = [])
	{
		if( ! $this->bindingExists($alias) )
			throw new WidgetAliasNotFound("Widget alias [$alias] does not exist.");

		// Create the Widget class instance.
		$widget = $this->make($alias, $arguments);

		// Get the renderd contents.
		return $widget->render();
	}

	/**
	 * Dynamically access Widget classes, and get the renderd contents.
	 * 	
	 * @param  string $widgetAlias
	 * @param  array  $arguments
	 * @return mixed
	 */
	public function __call($widgetAlias, $arguments = [])
	{
		return $this->render($widgetAlias, $arguments);
	}

}





