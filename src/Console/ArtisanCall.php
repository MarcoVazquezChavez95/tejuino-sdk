<?php

namespace Tejuino\Sdk\Console;

class ArtisanCall
{
    public static function exec($command)
    {
        // Log in console
        Console::info('Executing Artisan:', true)->ok($command)->nl();
        $executionInit = microtime(true);

        // Execute command
        shell_exec('cd ' . base_path() . ' && php artisan ' . $command . ' > /dev/null &');

        $executionTime = microtime(true) - $executionInit;
        Console::ok('Executed: ' . $executionTime . 's', true)->nl()->nl();

        return new static;
    }

    public static function configCache()
    {
        return static::exec('config:cache');
    }

    public static function configClear()
    {
        return static::exec('config:clear');
    }

    public static function migrate()
    {
        return static::exec('migrate --step');
    }

    public static function vendorPublish($module, $force = false)
    {
        $moduleProvider = '\'Tejuino\\' . ucfirst($module) . '\\' . ucfirst($module) . 'ServiceProvider\'';
        return static::exec('vendor:publish' . ' --provider=' . $moduleProvider . ($force ? ' --force' : ''));
    }

    public static function keyGenerate()
    {
        return static::exec('key:generate');
    }

    public static function clearCompiled()
    {
        return static::exec('clear-compiled');
    }

    public static function executeDefaultSeeder()
    {
        $seederClass = '\'Tejuino\\Sdk\\Database\\DefaultUsersSeeder\'';
        return static::exec('db:seed --class=' . $seederClass);
    }
}
