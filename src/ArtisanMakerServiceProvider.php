<?php

namespace Mazecodec\ArtisanMaker;

use Mazecodec\ArtisanMaker\Console\ActionMakeCommand;
use Mazecodec\ArtisanMaker\Console\FacadeMakeCommand;
use Mazecodec\ArtisanMaker\Console\InterfaceMakeCommand;
use Mazecodec\ArtisanMaker\Console\ServiceMakeCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ArtisanMakerServiceProvider extends PackageServiceProvider
{
    const PACKAGE_NAME = 'artisan-maker';

    public function configurePackage(Package $package): void
    {
        $package->name(self::PACKAGE_NAME)
            ->hasConfigFile(self::PACKAGE_NAME)
            ->hasCommands([
                ServiceMakeCommand::class,
                ActionMakeCommand::class,
                InterfaceMakeCommand::class,
                FacadeMakeCommand::class
            ]);
    }
}
