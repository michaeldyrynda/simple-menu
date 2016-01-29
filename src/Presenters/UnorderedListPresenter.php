<?php

namespace Iatstuti\SimpleMenu\Presenters;

use Iatstuti\SimpleMenu\Menu;
use Iatstuti\SimpleMenu\MenuItem;

/**
 * Unordered list presenter for menu objects
 *
 * @package    Iatstuti\SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
class UnorderedListPresenter implements MenuPresenter
{

    /**
     * @var \Iatstuti\SimpleMenu\Menu
     */
    protected $menu;


    /**
     * UnorderedListPresenter constructor.
     *
     * @param \Iatstuti\SimpleMenu\Menu $menu
     */
    public function __construct(Menu $menu)
    {
        $this->menu = $menu;
    }

    /**
     * Render the given menu as an unordered list.
     *
     * @return string
     */
    public function render()
    {
        $output  = '<ul>';

        foreach ($this->menu->items() as $item) {
            if ($item instanceof Menu) {
                // Have a new instance of this presenter render the nested/submenu item
                $output .= sprintf('<li>%s%s</li>', $item->label, (new static($item))->render());
            } else if ($item instanceof MenuItem) {
                // Render the link as-is
                $output .= sprintf(
                    '<li%1$s><a href="%2$s" title="%3$s">%3$s</a></li>',
                    $item->options('class') ? sprintf(' class="%s"', $item->options('class')) : null,
                    $item->link,
                    $item->label
                );
            }
        }

        $output .= '</ul>';

        return $output;
    }
}
