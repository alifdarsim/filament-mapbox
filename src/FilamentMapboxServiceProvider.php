<?php

namespace AlifDarsim\FilamentMapbox;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use AlifDarsim\FilamentMapbox\Commands\FilamentMapboxCommand;

class FilamentMapboxServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('filament-mapbox')
//            ->hasConfigFile()
            ->hasViews();
//            ->hasMigration('create_filament-mapbox_table')
//            ->hasCommand(FilamentMapboxCommand::class);
    }

    public function packageBooted(): void
    {
        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );
    }

    protected function getAssetPackageName(): ?string
    {
        return 'alifdarsim/filament-mapbox';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            Css::make('filament-mapbox-css', __DIR__ . '/../resources/dist/mapbox_v3.4.0.css'),
            Js::make('filament-mapbox-js', __DIR__ . '/../resources/dist/mapbox_v3.4.0.js'),
            Js::make('filament-mapbox-scripts', __DIR__ . '/../resources/dist/scripts.js'),
        ];
    }
}
