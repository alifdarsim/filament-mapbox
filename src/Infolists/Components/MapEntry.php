<?php

namespace AlifDarsim\FilamentMapbox\Infolists\Components;

use AlifDarsim\FilamentMapbox\Infolists\Traits;
use Closure;
use Filament\Infolists\Components\Entry;

class MapEntry extends Entry
{
    use Traits\HasStyle;

    protected string $view = 'filament-mapbox::filament-mapbox-infolist';

    protected Closure|string $style = 'mapbox://styles/mapbox/streets-v12';

    protected Closure|string $height = '500px';

    protected Closure|array $center = [2.2945, 48.8583];

    protected Closure|int $zoom = 16;

    protected Closure|int $bearing = 0;

    protected Closure|int $pitch = 0;

    protected Closure|bool $antialias = false;

    protected Closure|bool $addControl = false;

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

    public function center(Closure|array $center): static
    {
        $this->center = $center;

        return $this;
    }

    public function getCenter(): array
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

    public function addControl(Closure|bool $addControl = true): static
    {
        $this->addControl = $addControl;

        return $this;
    }

    public function getAddControl(): bool
    {
        return $this->addControl;
    }
}
