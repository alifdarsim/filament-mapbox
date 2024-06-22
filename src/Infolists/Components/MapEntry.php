<?php

namespace AlifDarsim\FilamentMapbox\Infolists\Components;

use Closure;
use Filament\Infolists\Components\Entry;

class MapEntry extends Entry
{
    //    use Traits\DetectFormat;

    protected string $view = 'filament-mapbox::filament-mapbox-infolist';

    protected Closure|string $style = 'mapbox://styles/mapbox/streets-v12';

    protected Closure|string $height = '500px';

    protected Closure|array|null $center = null;

    protected Closure|int $zoom = 16;

    protected Closure|int $bearing = 0;

    protected Closure|int $pitch = 0;

    protected Closure|bool $antialias = false;

    protected Closure|bool $addNavigationControl = false;

    protected Closure|bool $addFullscreenControl = false;

    protected Closure|bool $isGeoJson = false;

    protected Closure|array $markers = [];

    protected Closure|string $lightPreset = '';

    protected Closure|string $markerUrl = 'https://raw.githubusercontent.com/alifdarsim/filament-mapbox/main/resources/dist/marker/pin-m%2B3bb2d0.png';

    protected Closure|string $dataType = 'point';

    public function style(Closure|string $style): static
    {
        $this->style = $style;

        return $this;
    }

    public function getStyle(): string
    {
        return $this->style;
    }

    public function height(Closure|int $fixed_height, ?int $max_minus_top = null): static
    {

        if (is_int($fixed_height)) {
            $height = "{$fixed_height}px";
        }
        if (is_int($max_minus_top)) {
            $height = "calc(100vh - {$max_minus_top}px)";
        }
        $this->height = $height;

        return $this;
    }

    public function getHeight(): string
    {
        return $this->height;
    }

    public function center(Closure|array|null $center = [0, 0]): static
    {
        $this->center = $center;

        return $this;
    }

    public function getCenter(): ?array
    {
        return $this->center;
    }

    public function zoom(Closure|int $zoom): static
    {
        $this->zoom = $zoom;

        return $this;
    }

    public function getZoom(): int
    {
        return $this->zoom;
    }

    public function bearing(Closure|int $bearing): static
    {
        $this->bearing = $bearing;

        return $this;
    }

    public function getBearing(): int
    {
        return $this->bearing;
    }

    public function pitch(Closure|int $pitch): static
    {
        $this->pitch = $pitch;

        return $this;
    }

    public function getPitch(): int
    {
        return $this->pitch;
    }

    public function antialias(Closure|bool $antialias): static
    {
        $this->antialias = $antialias;

        return $this;
    }

    public function getAntialias(): bool
    {
        return $this->antialias;
    }

    public function addControl(Closure|bool $navigation = true, bool $fullScreen = true): static
    {
        $this->addNavigationControl = $navigation;
        $this->addFullscreenControl = $fullScreen;

        return $this;
    }

    public function getAddNavigationControl(): bool
    {
        return $this->addNavigationControl;
    }

    public function getAddFullscreenControl(): bool
    {
        return $this->addFullscreenControl;
    }

    public function lightPreset(Closure|string $lightPreset): static
    {
        $this->lightPreset = $lightPreset;

        return $this;
    }

    public function getLightPreset(): string
    {
        return $this->lightPreset;
    }

    public function customMarker(Closure|string $markerUrl): static
    {
        $this->markerUrl = $markerUrl;

        return $this;
    }

    public function getMarkerUrl(): string
    {
        return $this->markerUrl;
    }

    public function dataType(string $dataType): static
    {
        if ($dataType === 'point' || $dataType === 'line' || $dataType === 'polygon') {

            $this->dataType = $dataType;

            return $this;
        }

        try {
            throw new \Exception('Data type must be either point, line or polygon');
        } catch (\Exception) {
            return $this;
        }
    }

    public function getDataType(): string
    {
        return $this->dataType;
    }

    public function isGeoJson(Closure|bool $isGeoJson = true): static
    {
        $this->isGeoJson = $isGeoJson;

        return $this;
    }

    public function getIsGeoJson(): bool
    {
        return $this->isGeoJson;
    }
}
