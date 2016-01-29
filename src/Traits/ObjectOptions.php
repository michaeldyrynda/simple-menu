<?php

namespace Iatstuti\SimpleMenu\Traits;

/**
 * Trait to handle retrieving all or a specific option.
 *
 * @package    Iatstuti\SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
trait ObjectOptions
{

    /**
     * Return this menu's options, or a single option as specified.
     *
     * @param  string|null $key
     *
     * @return array
     */
    public function options($key = null)
    {
        if (! is_null($key) && array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }

        return $this->options;
    }

}
