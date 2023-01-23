<?php

namespace Tejuino\Sdk;

use Tejuino\Sdk\Traits\Publishable;
use Illuminate\Support\ServiceProvider;

class SdkServiceProvider extends ServiceProvider
{
    // Implements Tejuino Publishable Trait
    use Publishable;

    // Module settings
    protected $config;

    public function boot()
    {
        $this->commands([
            Console\TestCommand::class,
            Console\PackCommand::class,
            Console\CloneCommand::class,
            Console\PublishCommand::class,
            Console\MakeCommand::class,
            Console\MakeSeederCommand::class,
            Console\InitCommand::class
        ]);

        $this->config = Package::getConfig(__DIR__);
        $this->publishFiles(__DIR__);
    }
}
