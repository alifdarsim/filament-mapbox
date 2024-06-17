<?php

namespace AlifDarsim\FilamentMapbox\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \AlifDarsim\FilamentMapbox\FilamentMapbox
 */
class FilamentMapbox extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \AlifDarsim\FilamentMapbox\FilamentMapbox::class;
    }
}
