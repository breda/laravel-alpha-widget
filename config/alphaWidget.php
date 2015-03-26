<?php

return [

	/*
	|--------------------------------------------------------------------------
	| Widgets Namespace
	|--------------------------------------------------------------------------
	|
	| This is the Widgets namespace to use when fetching classes,
    | in order to shorten class names.
    | This namespace should always, always end with two back-slashs '\\'
	|
	*/
   'namespace' => 'App\Widgets\\',

	/*
	|--------------------------------------------------------------------------
	| Widget Bindings
	|--------------------------------------------------------------------------
	|
	| This key-value array is represents all the bindings to your widgets
    | classes. Keys represent widget aliases to work with. Values represent
    | the class basename that deals with rendring, and gathring data.
	|
	*/
   'widgets' => [
         'testWidget' => 'TestWidget',
   ]

];