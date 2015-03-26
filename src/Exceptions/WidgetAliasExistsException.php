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
 * This exception is thrown whenever someone is binding a class to an alias, which already exists.
 */
class WidgetAliasExistsException extends Exception
{}