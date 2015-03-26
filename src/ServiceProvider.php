<?php

/**
 * This file belongs to the AlphaWidget package.
 *
 * @author Reda Bouchaala <bouchaala.reda@gmail.com>
 * @package AlphaWidget
 * @version 0.2.0
*/
namespace BReda\AlphaWidget;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use BReda\AlphaWidget\WidgetFactory;

class ServiceProvider extends BaseServiceProvider
{

    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishConfig();
    }

    /**
     * Publish the config.
     *
     * @return void
     */
    protected function publishConfig()
    {
        $source = realpath(__DIR__ . '/../config/alphaWidget.php');

        $this->publishes([$source => config_path('alphaWidget.php')]);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
    	// Register the AlphaWidgetFactory as a singleton, since we only need one instance of it.
        $this->app->singleton('alphawidget.factory', function($app) {
        	return new WidgetFactory($app, $app['config']);
        });
    }
}