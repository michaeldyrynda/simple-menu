# Simple menu manager v1.2.0

[![Build Status](https://travis-ci.org/deringer/simple-menu.svg?branch=master)](https://travis-ci.org/deringer/simple-menu)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/deringer/simple-menu/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/deringer/simple-menu/?branch=master)

A simple menu manager.

There are a number of existing packages available that handle menus, but they all tend to be over-complicated for simple scenarios where all you want to do is define one or more menus.

This package allows you to define multiple menus via a manager, then add links across your project before rendering using a given presenter.

## Installation

```
composer require iatstuti/simple-menu=~1.0
```

## Basic usage

```php
<?php

use Iatstuti\SimpleMenu\Manager;

$manager = new Manager();
$menu = $manager->init('main-menu');

$menu->link('Link label', 'http://example.com/link-label');
$menu->link('Another link', 'http://example.com/another-link');

$submenu = $manager->create('First sub menu')
$submenu->link('First sub menu link', 'http://example.com/first-sub-menu-link');
$submenu->link('Second sub menu link', 'http://example.com/second-sub-menu-link');

$menu->addSubMenu($submenu);

```

## Menu options

If you are defining menu options at different times, you can define the sort order by passing the `weight` key/value pair as options to the `link` and `subMenu` methods. Your menu will automatically be sorted by the weights you define.

```php
$menu->link('Third link', 'http://example.com/third-link', [ 'weight' => 10, ]);
$menu->link('Fourth link', 'http://example.com/fourth-link', [ 'weight' => 5, ]);
```

When rendered, `Fourth Link` will before ahead of `Third Link` and both will appear after `Link label`, `Another link`, and `First sub menu` as defined above. Sub menu items will also be sorted in a similar way.

### Active menu item

There are two ways of marking an item as active; either via options, or by chaining the `active` method to a menu link.

```php
// Via options
$menu->link('Active link', 'http://example.com/active-link', [ 'active' => true, 'class' => 'active', ]);

// Fluid interface
$menu->link('Active link', 'http://example.com/active-link')->active();
```

## Menu presenters

The package ships with a default unordered list presenter.

Should you want to create your own, you may do so by implementing the `Iatstuti\SimpleMenu\Presenters\MenuPresenter` interface, providing a `render` method. The `Menu` object should be provided via the presenter's constructor.

This method ought to iterate over the items in your menu, recursively rendering any objects of type `Menu` and displaying any of type `MenuItem` directly.

If you want to use different presenter, pass the class path to the `Menu::render()` method.

```php
print $menu->render();
```

```html
<ul>
  <li><a href="http://example.com/link-label" title="Link label">Link label</a></li>
  <li><a href="http://example.com/another-link" title="Another link">Another link</a></li>
  <li>First sub menu
    <ul>
      <li><a href="http://example.com/first-sub-menu-link" title="First sub menu link">First sub menu link</a></li>
      <li><a href="http://example.com/second-sub-menu-link" title="Second sub menu link">Second sub menu link</a></li>
    </ul>
  </li>
  <li><a href="http://example.com/fourth-link" title="Fourth link">Fourth link</a></li>
  <li><a href="http://example.com/third-link" title="Third link">Third link</a></li>
</ul>
```
 
## Usage in Laravel

This package includes a service provider and facade, which can be used within the Laravel Framework. This is useful if you want to define a main menu in your main `AppServiceProvider`, but want to define additional menu items in other parts of your applications i.e. in different modules with their own service providers.

**Note** You *must* include the `SimpleMenuServiceProvider` *before* any other providers that may need to use the functionality.

First, add the service provider to your `config/app.php` providers array:

```php
'providers' => [
    // ...
    Iatstuti\SimpleMenu\SimpleMenuServiceProvider::class,
]
```

If you wish, you can then add the `SimpleMenu` facade to your aliases array:

```php
'aliases' => [
    // ...
    Iatstuti\SimpleMenu\Facades\SimpleMenu::class,
]
```

You can then register your first menu in your `AppServiceProvider`:

```php
public function register()
{
    SimpleMenu::init('main-navigation');
}
```

You can define as many different menus as you need in your application; for example, you might also have a `sidebar-navigation` with its own menu items.

When adding items to your navigation menu, you'll need to do this in your provider's `boot` method:

```php
class AnotherServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $menu = SimpleMenu::getMenu('main-navigation')
        $menu->link('First item', 'http://example.com/first-item');
        $menu->link('Second item', 'http://example.com/second-item');
    }
}
```
