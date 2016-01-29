<?php

namespace Iatstuti\SimpleMenu;

use Iatstuti\SimpleMenu\Traits\ObjectOptions;
use Iatstuti\Support\Traits\MethodPropertyAccess;
use Illuminate\Support\Collection;

/**
 * POPO object to wrap a menu collection.
 *
 * @package    Iatstuti\SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
class Menu
{

    use MethodPropertyAccess, ObjectOptions;

    /**
     * Store the menu items.
     *
     * @var \Illuminate\Support\Collection
     */
    protected $items;

    /**
     * Store the menu label.
     *
     * @var null|string
     */
    protected $label;

    /**
     * @var \Iatstuti\SimpleMenu\Presenters\MenuPresenter
     */
    protected $presenter;

    /**
     * @var array
     */
    private $options;


    /**
     * Menu constructor.
     *
     * @param  string|null $label
     * @param  array $options
     */
    public function __construct($label = null, array $options = [ ])
    {
        $this->label   = $label;
        $this->items   = new Collection();
        $this->options = array_merge([ 'weight' => 0, ], $options);
    }


    /**
     * Return this menu's label.
     *
     * @return null|string
     */
    public function label()
    {
        return $this->label;
    }


    /**
     * Add a new link to the menu.
     *
     * @param  string $item
     * @param  string $link
     * @param  array $options
     *
     * @return $this
     */
    public function link($item, $link, array $options = [ ])
    {
        $item = new MenuItem($item, $link, $options);

        $this->items()->push($item);

        $this->sortItems();

        return $item;
    }


    /**
     * Return this menu's items.
     *
     * @return \Illuminate\Support\Collection
     */
    public function items()
    {
        return $this->items;
    }


    /**
     * @return $this
     */
    private function sortItems()
    {
        $this->items = $this->items->sortBy(function ($item) {
            return $item->weight();
        });

        return $this;
    }


    /**
     * Add a new sub menu item to the menu.
     *
     * @param  \Iatstuti\SimpleMenu\Menu $menu
     *
     * @return $this
     */
    public function subMenu(Menu $menu)
    {
        $this->items->push($menu);

        $this->sortItems();

        return $menu;
    }


    /**
     * Return this menu's weight.
     *
     * @return int
     */
    public function weight()
    {
        return $this->options('weight');
    }
}
