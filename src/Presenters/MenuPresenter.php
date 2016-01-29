<?php

namespace Iatstuti\SimpleMenu\Presenters;

use Iatstuti\SimpleMenu\Menu;

/**
 * Define the interface for a menu presenter.
 *
 * @package    Iatstuti\SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
interface MenuPresenter
{

    /**
     * Render the given menu.
     *
     * @param  \Iatstuti\SimpleMenu\Menu $menu
     *
     * @return mixed
     */
    public function render(Menu $menu);
}
