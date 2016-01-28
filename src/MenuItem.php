<?php

namespace Iatstuti\SimpleMenu;

/**
 * POPO object to wrap a menu item.
 *
 * @package    Iatstuti
 * @subpackage SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
class MenuItem
{

    /**
     * @var string
     */
    protected $label;

    /**
     * @var array
     */
    protected $options;

    /**
     * @var string
     */
    protected $link;


    /**
     * MenuItem constructor.
     *
     * @param  $label
     * @param  $link
     * @param  array $options
     */
    public function __construct($label, $link, array $options = [ ])
    {
        $this->label   = $label;
        $this->link    = $link;
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
     * Return this menu item's label.
     *
     * @return string
     */
    public function label()
    {
        return $this->label;
    }


    /**
     * Return this menu item's link.
     *
     * @return string
     */
    public function link()
    {
        return $this->link;
    }


    /**
     * Return this menu item's options.
     *
     * @return array
     */
    public function options()
    {
        return $this->options;
    }


    /**
     * Return this menu item's weight.
     *
     * @return int
     */
    public function weight()
    {
        return $this->options['weight'];
    }
}
