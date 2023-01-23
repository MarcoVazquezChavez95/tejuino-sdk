<?php

namespace Tejuino\Sdk\Console;

use File;
use Illuminate\Console\Command;
use Tejuino\Sdk\Traits\Compilable;

class CloneCommand extends Command
{
    use Compilable;

    protected $signature = 'sdk:clone
                            {--module= : The name of the module}
                            {--rename= : Rename copied package name}';
    protected $description = 'Clone module folder from vendor/tejuino to packages/tejuino';

    protected $files = [
        'composer.json' => [
            [
                'type' => 'prepend',
                'content' => '',
                'before' => '"Tests\\\\": "tests/"'
            ]
        ],
        'config/app.php' => [
            [
                'type' => 'append',
                'content' => '',
                'after' => 'App\Providers\RouteServiceProvider::class,'
            ]
        ]
    ];

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Get or ask module name
        $moduleName = $this->option('module') ?: $this->ask(
            'Module name', ''
        );

        // Get dest package module name
        $newModuleName = $this->option('rename') ? $this->option('rename') : $moduleName;
        Console::log('Cloning [y]/vendor/tejuino/' . $moduleName . '[w] into [y]/packages/tejuino/' . $newModuleName);

        // Check vendor path
        $vendorPath = base_path('vendor/tejuino/' . $moduleName);
        if (!file_exists($vendorPath)) {
            Console::log('Path does not exists: [r]' . $vendorPath);
            return;
        }

        // Check if packages path exists
        if (!file_exists(base_path('packages'))) {
            mkdir(base_path('packages'));
        }

        // Check if packages/tejuino path exists
        if (!file_exists(base_path('packages/tejuino'))) {
            mkdir(base_path('packages/tejuino'));
        }

        // Copy package
        $packagePath = base_path('packages/tejuino/' . $newModuleName);
        if (!File::copyDirectory($vendorPath, $packagePath)) {
            Console::log('Error trying to copy from [r]' . $vendorPath . '[w] to [r]' . $packagePath);
            return;
        }

        // Get package namespace/class
        $autoloadClass = '"Tejuino\\\\' . ucfirst($newModuleName) . '\\\\": "packages/tejuino/' . $newModuleName . '/src",';
        $appProvider = 'Tejuino\\' . ucfirst($newModuleName) . '\\' . ucfirst($newModuleName) . 'ServiceProvider::class,';

        // Ask for composer file modification
        if ($this->ask('Add to composer.json? y/n', 'n') == 'y') {
            // Add composer required dir
            $this->files['composer.json'][0]['content'] = '' . $autoloadClass . '{{enter}}{{tab}}{{tab}}{{tab}}';

            // Add config/app class
            $this->files['config/app.php'][0]['content'] = '{{enter}}{{tab}}{{tab}}' . $appProvider;

            // Compile files
            $this->compileFiles();

            // Remove from composer dependencies
            if ($this->ask('Remove from composer dependencies? y/n', 'n') == 'y') {
                Composer::remove($newModuleName)->dumpOptimized();
            }
        }

        Console::log('\n\nModule cloned successfully: [g]' . $moduleName . '[w] to [g]' . $newModuleName . '\n\n');
    }

}
