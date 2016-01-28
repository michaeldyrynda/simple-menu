<?php

namespace Iatstuti\SimpleMenu\Facades;

use Iatstuti\SimpleMenu\Manager;
use Illuminate\Support\Facades\Facade;

/**
 * Laravel Facade for the SimpleMenu package
 *
 * @package    Iatstuti
 * @subpackage SimpleMenu\Facades
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
class SimpleMenu extends Facade
{

    protected static function getFacadeAccessor()
    {
        return Manager::class;
    }
}
