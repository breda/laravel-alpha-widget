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
 * This exception is thrown whenever whenever a widget class is being called, while it does
 * not implement the Widget contract.
 */
class IncorrectWidgetClassException extends Exception
{}