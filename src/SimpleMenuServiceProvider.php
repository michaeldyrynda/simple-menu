<?php

namespace Iatstuti\SimpleMenu;

use Illuminate\Support\ServiceProvider;

/**
 * Laravel service provider for the SimpleMenu package
 *
 * @package    Iatstuti\SimpleMenu
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
        $this->app->singleton('Iatstuti\SimpleMenu\Manager', function () {
            return new Manager();
        });
    }
}
