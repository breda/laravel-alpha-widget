<?php
use BReda\AlphaWidget\WidgetContainer;

class WidgetContainerTest extends PHPUnit_Framework_TestCase
{

	/** @var The WidgetContainer */
	protected $container;

	/** SetUp */
	public function setUp()
	{
		$this->container = new WidgetContainer();
	}

	/** @test */
	public function it_can_bind_a_widget_alias()
	{
		$this->container->bindWidget('test', 'TestWidget');
		$aliases = $this->container->getAliases();

		$this->assertCount(1, $aliases);
		$this->assertContains('test', $aliases);
	}

	/** @test */
	public function it_can_bind_a_widget_class()
	{
		$this->container->bindWidget('test', 'TestWidget');
		$classes = $this->container->getClasses();

		$this->assertCount(1, $classes);
		$this->assertContains('TestWidget', $classes);
	}

	/** @test */
	public function it_should_know_if_binding_exists()
	{
		$this->container->bindWidget('test', 'TestWidget');
		$this->assertTrue($this->container->bindingExists('test'));

		$this->assertFalse($this->container->bindingExists('alias-that-does-not-exist'));
	}

	/** @test */
	public function it_should_throw_an_exception_when_duplicate_alias()
	{
		$this->setExpectedException('BReda\AlphaWidget\Exceptions\WidgetAliasExistsException');

		$this->container->bindWidget('test', 'TestWidget');
		$this->container->bindWidget('test', 'TestWidget');
	}

	/** @test */
	public function it_can_remove_an_binding()
	{
		$this->container->bindWidget('test', 'TestWidget');
		$this->container->forgetBinding('test');

		$aliases = $this->container->getAliases();
		$classes = $this->container->getClasses();

		$this->assertCount(0, $aliases);
		$this->assertNotContains('test', $aliases);

		$this->assertCount(0, $classes);
		$this->assertNotContains('test', $classes);
	}

	/** @test  */
	public function it_can_get_widget_class_by_alias()
	{
		$inAlias = 'test';
		$inClass = 'TestWidge';
		$this->container->bindWidget($inAlias, $inClass);

		$outClass = $this->container->getWidgetClass($inAlias);

		$this->assertEquals($inClass, $outClass);
	}

}