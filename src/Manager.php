<?php

namespace Iatstuti\SimpleMenu;

/**
 * SimpleMenu manager
 *
 * @package    Iatstuti
 * @subpackage SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
class Manager
{

    /**
     * @var array
     */
    protected $menus = [ ];


    /**
     * Initialise a new menu.
     *
     * This will attach the menu to the array of menus,
     * which can later be retrieved for adding items.
     *
     * @param  string $name
     *
     * @return mixed
     */
    public function init($name)
    {
        if (! isset($this->menus[$name])) {
            $this->menus[$name] = new Menu();
        }

        return $this->menus[$name];
    }


    /**
     * Return a new menu item with the given label.
     *
     * @param  string $label
     *
     * @return \Iatstuti\SimpleMenu\Menu
     */
    public function create($label)
    {
        return new Menu($label);
    }


    /**
     * Return the menu for the given name, if available.
     *
     * @param  string $name
     *
     * @return \Iatstuti\SimpleMenu\Menu|null
     */
    public function getMenu($name)
    {
        return isset($this->menus[$name]) ? $this->menus[$name] : null;
    }
}
