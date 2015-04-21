<?php

use BReda\AlphaWidget\WidgetContainer;
use BReda\AlphaWidget\WidgetFactory;

class WidgetFactoryTest extends TestCase
{
	/** SetUp */
	public function setUp()
	{
		$this->app 				= $this->createApplication();
		$this->widget 			= new WidgetClass;
		$this->widget2 			= new WidgetClass(5);
		$this->incorrectWidget 	= new incorrectWidgetClass;

		$configMock = Mockery::mock('Illuminate\Config\Repository')
				->shouldReceive('get')
				->twice()
				->andReturn('', ['myWidget' => 'WidgetClass', 'incorrectWidget' => 'incorrectWidgetClass'])
				->getMock();
		$this->factory = new WidgetFactory($this->app, $configMock);
	}

	/** @test */
	public function it_should_throw_an_exception_when_widget_is_incorrect()
	{
		$this->setExpectedException('BReda\AlphaWidget\Exceptions\IncorrectWidgetClassException');

		$this->factory->make('incorrectWidget');
	}

	/** @test */
	public function it_can_get_the_correct_widget_instance()
	{
		$resolvedWidget = $this->factory->make('myWidget');

		$this->assertEquals($this->widget, $resolvedWidget);
		$this->assertInstanceOf('WidgetClass', $resolvedWidget);
	}

	/** @test */
	public function it_can_render_the_widget()
	{
		$this->assertEquals(
			$this->widget->render(),
			$this->factory->render('myWidget')
		);

		$this->assertEquals(
			$this->widget2->render(),
			$this->factory->render('myWidget', [5])
		);
	}

	/** @test */
	public function it_can_dynamically_render_the_widget()
	{
		$contents = $this->widget->render();
		$contents2 = $this->widget2->render();

		$expectedContents = $this->factory->myWidget();
		$expectedContents2 = $this->factory->myWidget(5);

		$this->assertEquals($contents, $expectedContents);
		$this->assertEquals($contents2, $expectedContents2);
	}
}