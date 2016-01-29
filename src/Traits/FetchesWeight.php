<?php

namespace Iatstuti\SimpleMenu\Traits;

/**
 * As the functionality is repeated, use a trait to
 * fetch the weight from the class' options array.
 *
 * @package    Iatstuti\SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
trait FetchesWeight
{

    abstract public function options($key = null);

    /**
     * If not null, set this menu's weight, else return the current value.
     *
     * @param  int|null $weight
     *
     * @return mixed
     */
    public function weight($weight = null)
    {
        if (is_null($weight)) {
            return (int) $this->options('weight');
        }

        $this->options['weight'] = (int) $weight;

        return $this;
    }
}
