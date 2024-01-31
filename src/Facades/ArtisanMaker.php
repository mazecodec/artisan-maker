<?php

namespace Mazecodec\ArtisanMaker\Facades;

use Illuminate\Support\Facades\Facade;
use Mazecodec\ArtisanMaker\ArtisanMakerServiceProvider;

class ArtisanMaker extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return ArtisanMakerServiceProvider::PACKAGE_NAME;
    }
}
