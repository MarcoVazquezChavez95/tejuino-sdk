<?php

namespace Tejuino\Sdk\Console;

use Illuminate\Console\Command;

class PublishCommand extends Command
{
    protected $signature = 'sdk:publish
                            {module : The module name}
                            {--force : Force override files}';
    protected $description = 'Executes artisan vendor:publish';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Perform command
     *
     * @return void
     */
    public function handle()
    {
        // Get or ask module name
        $module = $this->argument('module') ?: $this->ask(
            'Module name', ''
        );

        // Execute vendor publish
        ArtisanCall::vendorPublish($module, $this->option('force'));

        // Ask for migrations execution
        if ($this->ask('Execute migrations? y/n', 'n') == 'y') {
            ArtisanCall::migrate();
        }

        Console::ok('Done!')->nl();
    }

}
