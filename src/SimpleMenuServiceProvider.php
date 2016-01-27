<?php

namespace Iatstuti\SimpleMenu;

use Iatstuti\SimpleMenu\Manager;
use Illuminate\Support\ServiceProvider;

/**
 * Laravel service provider for the SimpleMenu package
 *
 * @package    Iatstuti
 * @subpackage SimpleMenu
 * @copyright  2016 IATSTUTI
 * @author     Michael Dyrynda <michael@iatstuti.net>
 */
class SimpleMenuServiceProvider extends ServiceProvider
{

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Manager::class, function () {
            return new Manager();
        });
    }
}
