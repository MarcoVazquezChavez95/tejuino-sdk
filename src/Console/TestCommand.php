<?php

namespace Tejuino\Sdk\Console;

use Illuminate\Console\Command;

class TestCommand extends Command
{

    protected $signature = 'sdk:test';
    protected $description = 'Tejuino SDK test command';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        Console::log('test:')
            ->ok('ok')
            ->tab('tab')
            ->tab()
            ->info('info')
            ->tab()
            ->warning('warning')
            ->tab()
            ->error('error')
            ->tab()
            ->ok(time())
            ->info('done.')
            ->nl()->nl();
    }
}
