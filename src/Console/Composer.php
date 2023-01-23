<?php

namespace Tejuino\Sdk\Console;

class Composer
{

    public static function exec($command)
    {
        // Log in console
        Console::info('Executing Composer:', true)->ok($command)->nl();
        $executionInit = microtime(true);

        // Execute command
        shell_exec('cd ' . base_path() . ' composer ' . $command . ' > /dev/null &');

        $executionTime = microtime(true) - $executionInit;
        Console::ok('Executed: ' . $executionTime . 's', true)->nl()->nl();

        return new static;
    }

    public static function remove($module)
    {
        return static::exec('remove tejuino/' . $module);
    }

    public static function dumpAutoload($optimized = false)
    {
        return static::exec('dump-autoload' . ($optimized ? ' -o' : ''));
    }

    public static function dumpOptimized()
    {
        return static::dumpAutoload(true);
    }

    public static function installUi()
    {
        return static::exec('require laravel/ui');
    }
}
