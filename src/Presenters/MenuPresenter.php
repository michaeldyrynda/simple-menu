<?php

namespace Iatstuti\SimpleMenu\Presenters;

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
     * @return string
     */
    public function render();
}
