<?php

namespace Tejuino\Sdk\Console;

use File;
use Tejuino\Sdk\Package;
use Illuminate\Console\Command;

class PackCommand extends Command
{
    protected $signature = 'sdk:pack {module : The module name}';
    protected $description = 'Pack module files from laravel project directories to packages/tejuino';
    private $publishes = [];
    private $module = null;
    private $results = [
        'files' => 0,
        'directories' => 0,
        'skipped_files' => 0,
        'skipped_directories' => 0,
        'error_files' => 0,
        'error_directories' => 0
    ];

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
        $this->module = $this->argument('module');
        Console::info('Packing: [g]')->ok($this->module)->nl();

        // Get module config
        if (!$config = Package::getModuleConfig($this->module)) {
            return;
        };

        $this->publishes = $config['publishes'];
        $this->resetFolders();
        $this->pack();

        // Print results
        Console::nl()->info('Module packed:', 1)->ok($this->module);
        Console::info('New files:', 1)->ok($this->results['files']);
        Console::info('New directories:', 1)->ok($this->results['directories']);

        // Print errors
        if ($this->results['error_files']) {
            Console::info('Error files:')->error($this->results['error_files']);
        }
        if ($this->results['error_directories']) {
            Console::info('Error directories:')->error($this->results['error_directories']);
        }

        Console::ok('Done.', 1)->nl()->nl();
    }

    /**
     * Reset publish folders
     *
     * @return void
     */
    public function resetFolders()
    {
        // Create publishes folder if does not exist
        $publishFolder = Package::getModuleDir($this->module) . '/publishes';
        if (!file_exists($publishFolder)) {
            Console::info('Creating destination folder', 1)->ok($publishFolder);
            mkdir($publishFolder);
        }

        // Create publishes subfolder based on package configuration
        foreach ($this->publishes as $type => $files) {
            foreach($files as $file) {
                $originPath = Package::getLaravelPath($type, $file);
                $destPathFolder = Package::getModuleDir($this->module) . '/publishes/' . $type;

                if (!File::isDirectory($originPath) && !file_exists($destPathFolder)) {
                    Console::info('Creating destination folder', 1)->ok($destPathFolder);
                    mkdir($destPathFolder);
                }
            }
        }
    }

    /**
     * Copy files from project directories to package
     *
     * @return void
     */
    public function pack()
    {
        // Pack files (reverse copy to /packages/tejuino/<package>/publishes/<type>/<file|directory>)
        foreach ($this->publishes as $type => $files) {
            foreach($files as $file) {
                // Get pack origin (Laravel dir)
                $originPath = Package::getLaravelPath($type, $file);

                // Get pack destination (package dir)
                $destPath = Package::getPackagePath($this->module, $type, $file);

                // Distinguish resource between folder / file
                if (File::isDirectory($originPath)) {
                    Console::info('Copying folder', 1)->ok($destPath);

                    if (!File::copyDirectory($originPath, $destPath)) {
                        $this->results['error_directories']++;
                        Console::error('Could not copy directory')->info($originPath)->error('to')->info($destPath);
                        continue;
                    }

                    $this->results['directories']++;
                }

                else {
                    Console::info('Copying file', 1)->ok($destPath);

                    if (!File::copy($originPath, $destPath)) {
                        $this->results['error_files']++;
                        Console::error('Could not copy file')->info($originPath)->error('to')->info($destPath);
                        continue;
                    }

                    $this->results['files']++;
                }
            }
        }
    }
}
