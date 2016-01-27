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
     * @var \Illuminate\Support\Collection
     */
    protected $items;

    /**
     * @var null|string
     */
    protected $label;


    /**
     * Menu constructor.
     *
     * @param string|null $label
     */
    public function __construct($label = null)
    {
        $this->label = $label;
        $this->items = new Collection();
    }


    /**
     * Get the menu label.
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
    public function addLink($item, $link, array $options = [ ])
    {
        if (! array_key_exists('weight', $options)) {
            $options['weight'] = 0;
        }

        $this->items->push(compact('item', 'link', 'options'));

        $this->items = $this->items->sortBy('options.weight');

        return $this;
    }


    /**
     * Add a new sub menu item to the menu.
     *
     * @param  \Iatstuti\SimpleMenu\Menu $menu
     * @param  array $options
     *
     * @return $this
     */
    public function addSubMenu(Menu $menu, array $options = [ ])
    {
        if (! array_key_exists('weight', $options)) {
            $options['weight'] = 0;
        }

        $this->items()->push([ 'item' => $menu, 'options' => $options, ]);

        $this->items = $this->items->sortBy('options.weight');

        return $this;
    }


    /**
     * Retrieve the menu items.
     *
     * @return \Illuminate\Support\Collection
     */
    public function items()
    {
        return $this->items;
    }
}
