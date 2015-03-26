
# AlphaWidget — Widgets For Laravel 5
----------------------------------------

This is a very simple, easy to use Widget manager for [Laravel 5](http://laravel.com) (A version for Laravel 4.2 might come).

> **Note!** 
> This package won't hit version `1.0.0` until I write the tests for it.
> Which would probably take a while...

## Installation

First, install the package via [Composer](https://getcomposer.org/).
```bash
composer require breda/laravel-alphaWidget
```

in the `config/app.php` file, add the Service Provider

```php
	'providers' => [
		// Other providers...
		'BReda\AlphaWidget\ServiceProvider',
	]
```
And lastly, register the Alias
```php
	'aliases' => [
		// Other aliases...
		'BReda\AlphaWidget\Facades\AlphaWidget',
	]
```

And you're ready to use AlphaWidget!

------------

## Walk Through

Now, when I said that this is a simple Widget manager, I meant it!
It's as simple as registering a widget alias, and it's class inside the configuration file. Like this :

```php
	'widgets' => [
		// Other widgets...
		'myRecentUsersWidget' => 'RecentUsers',
	]
```

> One note to take here before we move on, is that I'am only referencing the class name, not the complete namespace. And that's what the `namespace` field in the `config/alphaWidget.php` file is here for. 

> To shorten class names, put your desired namespace in the config file, just make sure that all of your widget classes declare that namespace, that's all!


And then, calling the widget is as simple as :
```php
	AlphaWidget::render('myRecentUsersWidget');
	
	// Or, a much better way:
	AlphaWidget::myRecentUsersWidget();
```

Now, what does that `RecentUsers` look like, I hear you say!
It's a simple class implementing the `AlphaWidget` Contract (interface), stating that it must have the `render` method. That method, is responsible of rendering the widget contents.

```php
<?php namespace App\Widgets;

use BReda\AlphaWidget\Contracts\AlphaWidget as WidgetContract;

class RecentUsers implements WidgetContract
{

   /**
    * Render the Widget
    *
    * @return string
    */
   public function render(){
		return "Hello from the widget!";
   }

}
```
> One note to take here! Is that the `render` method, should `return` the contents, and NOT `echo` them out!
> Remember! No `echo`! Just `return`.

> Another note 

#### Passing Arguments To Widget Calls
You can of course, pass arguments to widget calls. Like this for example:
```php
	AlphaWidget::render('myRecentUsersWidget', [5]);
	
	// Or, a much better way:
	AlphaWidget::myRecentUsersWidget(5);
```

And then in your class:
```php
<?php namespace App\Widgets;

use BReda\AlphaWidget\Contracts\AlphaWidget as WidgetContract;

class RecentUsers implements WidgetContract
{
	/**
	 * How much should we limit the displayed users.
	 *
	 * @var string
	 */
	protected $limit;

	/**
	 * Create a new RecentUsers Widget instance
	 *
	 * @return void
	 */
	public function __construct($limit)
	{
		$this->limit = $limit;
	}

   /**
    * Render the Widget
    *
    * @return mixed
    */
   public function render(){
		return "Displaying the {$this->limit} recently registerd users...";
   }

}
```

Now! One last thing to note! Since all widgets are resolved through the Laravel's IoC container, you can type-hint any Laravel Service to be used in your Widget class!

#### Practical Example

An good example, would be fetching the 5 recently registered users. 
```php
<?php namespace App\Widgets;

use App\Repositories\UsersRepository;
use BReda\AlphaWidget\Contracts\AlphaWidget as WidgetContract;

class RecentUsers implements WidgetContract
{
	/**
	 * How much should we limit the displayed users.
	 *
	 * @var string
	 */
	protected $limit;

	/**
	 * Create a new RecentUsers Widget instance
	 *
	 * @return void
	 */
	public function __construct($limit, UsersRepository $users)
	{
		$this->limit = $limit;
		$this->users = $users;
	}

   /**
    * Render the Widget
    *
    * @return mixed
    */
   public function render(){
		$users = $this->users->getRecentUsers($this->limit);

		return view('widgets.recent-users', ['users' => $users]);
   }

}
```
And that's it really!

-------------------

## Contributing
Anything from bug fixes,  improvements or anything similar!  Pull requests are welcome! Just make sure to submit them to the `develop` branch, rather to the `master` branch, as this later only has production-ready code.
