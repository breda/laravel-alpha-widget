<?php

/**
 * This file belongs to the AlphaWidget package.
 *
 * @author Reda Bouchaala <bouchaala.reda@gmail.com>
 * @package AlphaWidget
 * @version 0.2.0
*/
namespace BReda\AlphaWidget\Exceptions;

use Exception;

/**
 * When rying to remove a binding from the widget container, while the provided alias does not exist
 * this exception is thrown.
 */
class WidgetAliasNotFound extends Exception
{}