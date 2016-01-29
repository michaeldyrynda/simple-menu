<?php

use Iatstuti\SimpleMenu\Manager;
use Iatstuti\SimpleMenu\Presenters\UnorderedListPresenter;

class SimpleMenuTest extends PHPUnit_Framework_TestCase
{

    /** @test */
    public function it_initialises_a_new_menu()
    {
        $manager = new Manager();

        $manager->init('main-menu');
        $this->assertNotNull($manager->getMenu('main-menu'));
        $this->assertEmpty($manager->getMenu('main-menu')->items());
    }


    /** @test */
    public function it_can_return_a_new_menu_instance()
    {
        $manager = new Manager();

        $menu = $manager->create('test-menu');

        $this->assertNull($manager->getMenu('test-menu'));
        $this->assertEmpty($menu->items());
        $this->assertSame('test-menu', $menu->label());
    }


    /** @test */
    public function it_can_add_links_to_a_menu()
    {
        $manager = new Manager();

        $manager->init('test-menu');
        $manager->getMenu('test-menu')->link('Link One', 'http://test.suite/link-one');
        $manager->getMenu('test-menu')->link('Link Two', 'http://test.suite/link-two');

        $this->assertInstanceOf('Iatstuti\SimpleMenu\Menu', $manager->getMenu('test-menu'));
        $this->assertCount(2, $manager->getMenu('test-menu')->items());
        $this->assertSame(0, $manager->getMenu('test-menu')->items()->first()->weight);
        $this->assertSame(0, $manager->getMenu('test-menu')->items()->last()->weight);
    }


    /** @test */
    public function it_can_add_a_submenu_to_a_menu()
    {
        $manager = new Manager();

        $menu    = $manager->init('test-menu');
        $submenu = $manager->create('sub-menu');
        $submenu->link('Submenu item one', 'http://test.suite/submenu-item-one');
        $submenu->link('Submenu item two', 'http://test.suite/submenu-item-two');

        $menu->subMenu($submenu);

        $this->assertCount(1, $menu->items());

        $this->assertInstanceOf('Iatstuti\SimpleMenu\Menu', $submenu);
        $this->assertCount(2, $submenu->items());
        $this->assertSame('sub-menu', $submenu->label());
        $this->assertSame(0, $submenu->weight);
    }


    /** @test */
    public function it_can_sort_items_by_their_weight()
    {
        $manager = new Manager();

        $menu = $manager->init('test-menu');
        $menu->link('First link', 'http://test.suite/first-link', [ 'weight' => 20, ]);
        $menu->link('Second link', 'http://test.suite/second-link', [ 'weight' => 30, ]);
        $menu->link('Third link', 'http://test.suite/third-link', [ 'weight' => 10, ]);

        $this->assertCount(3, $menu->items());
        $this->assertSame(10, $menu->items()->shift()->weight);
        $this->assertSame(20, $menu->items()->shift()->weight);
        $this->assertSame(30, $menu->items()->shift()->weight);
    }


    /** @test */
    public function it_renders_a_simple_menu_as_an_unordered_list()
    {
        $manager = new Manager();

        $menu = $manager->init('test-menu');
        $menu->link('First link', 'http://test.suite/first-link', [ 'weight' => 20, ]);
        $menu->link('Second link', 'http://test.suite/second-link', [ 'weight' => 30, ]);
        $menu->link('Third link', 'http://test.suite/third-link', [ 'weight' => 10, ]);

        $this->assertCount(3, $menu->items());
        $this->assertSame('<ul><li><a href="http://test.suite/third-link" title="Third link">Third link</a></li><li><a href="http://test.suite/first-link" title="First link">First link</a></li><li><a href="http://test.suite/second-link" title="Second link">Second link</a></li></ul>', $menu->render());
    }


    /** @test */
    public function it_renders_a_complex_menu_as_an_unordered_list()
    {
        $manager = new Manager();

        $menu = $manager->init('test-menu');
        $menu->link('First link', 'http://test.suite/first-link', [ 'weight' => 10, ]);

        $submenu = $manager->create('First submenu link');
        $submenu->link('First submenu link', 'http://test.suite/first-submenu-link', [ 'weight' => 5, ]);

        $menu->subMenu($submenu);

        $this->assertCount(2, $menu->items());
        $this->assertSame('<ul><li>First submenu link<ul><li><a href="http://test.suite/first-submenu-link" title="First submenu link">First submenu link</a></li></ul></li><li><a href="http://test.suite/first-link" title="First link">First link</a></li></ul>', $menu->render());
    }


    /** @test */
    public function it_renders_an_active_menu_item()
    {
        $manager = new Manager();

        $menu = $manager->init('test-menu');
        $menu->link('First link', 'http://test.suite/first-link')->active();
        $menu->link('Second link', 'http://test.suite/second-link', [ 'weight' => 5, ]);

        $this->assertCount(2, $menu->items());
        $this->assertTrue($menu->items()->first()->options('active'));
        $this->assertSame('active', $menu->items()->first()->options('class'));
        $this->assertSame('<ul><li class="active"><a href="http://test.suite/first-link" title="First link">First link</a></li><li><a href="http://test.suite/second-link" title="Second link">Second link</a></li></ul>', $menu->render());
    }


    /** @test */
    public function it_can_fluidly_set_a_weights()
    {
    	$manager = new Manager();

        $menu = $manager->init('test-menu');
        $menu->link('First link', 'http://test.suite/first-link')->weight(5);
        $menu->link('Second link', 'http://test.suite/first-link')->weight(0);
        $submenu = $manager->create('testing')->weight(2);
        $menu->subMenu($submenu);

        $this->assertSame(0, $menu->items()->shift()->weight);
        $this->assertSame(2, $menu->items()->shift()->weight);
        $this->assertSame(5, $menu->items()->shift()->weight);
    }


    /** @test */
    public function it_can_set_weight_via_options()
    {
        $manager = new Manager();

        $menu = $manager->init('test-menu');
        $menu->link('First link', 'http://test.suite/first-link', [ 'weight' => 5, ]);
        $menu->link('Second link', 'http://test.suite/first-link', [ 'weight' => 0, ]);
        $submenu = $manager->create('testing', [ 'weight' => 2, ]);
        $menu->subMenu($submenu);

        $this->assertSame(0, $menu->items()->shift()->weight);
        $this->assertSame(2, $menu->items()->shift()->weight);
        $this->assertSame(5, $menu->items()->shift()->weight);
    }
}
