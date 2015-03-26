<?php

/**
 * This file belongs to the AlphaWidget package.
 *
 * @author Reda Bouchaala <bouchaala.reda@gmail.com>
 * @package AlphaWidget
 * @version 0.2.0
*/
namespace BReda\AlphaWidget\Facades;

use Illuminate\Support\Facades\Facade;

class AlphaWidget extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'alphawidget.factory'; }

}