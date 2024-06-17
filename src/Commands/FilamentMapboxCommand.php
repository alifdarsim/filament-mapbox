<?php

namespace AlifDarsim\FilamentMapbox\Commands;

use Illuminate\Console\Command;

class FilamentMapboxCommand extends Command
{
    public $signature = 'filament-mapbox';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
