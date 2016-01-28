<?php

namespace Iatstuti\SimpleMenu\Presenters;

use Iatstuti\SimpleMenu\Menu;
use Iatstuti\SimpleMenu\MenuItem;

/**
 * Unordered list presenter for menu objects
 *
 * @package    Iatstuti
 * @subpackage SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
class UnorderedListPresenter
{

    /**
     * Render the given menu as an unordered list.
     *
     * @param  \Iatstuti\SimpleMenu\Menu $menu
     *
     * @return string
     */
    public function render(Menu $menu)
    {
        $output  = '<ul>';

        foreach ($menu->items() as $item) {
            if ($item instanceof Menu) {
                $output .= sprintf('<li>%s%s</li>', $item->label, (new static)->render($item));
            } else if ($item instanceof MenuItem) {
                $output .= sprintf('<li><a href="%1$s" title="%2$s">%2$s</a></li>', $item->link, $item->label);
            }
        }

        $output .= '</ul>';

        return $output;
    }
}
