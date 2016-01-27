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

    protected $menus = [ ];


    public function __construct()
    {
        //
    }


    public function menu($name)
    {
        if (! isset($this->menus[$name])) {
            $this->menus[$name] = new Menu();
        }

        return $this->menus[$name];
    }


    public function create($label)
    {
        return new Menu($label);
    }


    public function getMenu($name)
    {
        return isset($this->menus[$name]) ? $this->menus[$name] : null;
    }
}
