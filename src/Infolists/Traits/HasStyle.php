<?php

namespace AlifDarsim\FilamentMapbox\Infolists\Traits;

use Closure;

trait HasStyle
{
    protected Closure|string $radius = '12px';

    public function cornerRadius(Closure|string|int $radius): static
    {
        if (is_int($radius)) $radius = "{$radius}px";
        $this->radius = $radius;
        return $this;
    }

    public function getRadius(): string
    {
        return $this->radius;
    }
}
