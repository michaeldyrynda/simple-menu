<?php

namespace Iatstuti\SimpleMenu;

use Illuminate\Support\Collection;

/**
 * POPO object to wrap a menu collection.
 *
 * @package    Iatstuti
 * @subpackage SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
class Menu
{

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
     * Overload the get method to allow property access of methods.
     *
     * @param  string $key
     *
     * @return mixed
     */
    public function __get($key)
    {
        if (method_exists($this, $key)) {
            return $this->{$key}();
        }
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
        $this->items()->push(new MenuItem($item, $link, $options));

        return $this->sortItems();
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
        $this->items = $this->items->sortBy('options.weight');

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

        return $this->sortItems();
    }


    /**
     * Return this menu's options.
     *
     * @return array
     */
    public function options()
    {
        return $this->options;
    }


    /**
     * Return this menu's weight.
     *
     * @return int
     */
    public function weight()
    {
        return $this->options['weight'];
    }
}
