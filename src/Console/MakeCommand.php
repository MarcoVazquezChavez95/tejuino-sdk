<?php

namespace Tejuino\Sdk\Console;

use File;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Tejuino\Sdk\Traits\Compilable;

class MakeCommand extends Command
{
    use Compilable;

    protected $signature = 'sdk:make
                            {class : The classname}
                            {--compose : Indicates if package must be added to composer.json }
                            {--publish : Compose & Publish package}
                            {--migrate : Execute migrations after publish}
                            {--open : Open in Firefox after publish package}
                            {--all : Perform all tasks without questions}';
    protected $description = 'Make new module in packages/tejuino';
    protected $title = null;
    protected $module = null;
    protected $entity = null;
    protected $entities = null;
    protected $time_string = null;
    protected $stubs_dir = 'stubs/module/';
    protected $folders = [
        'src',
        'src/publishes',
        'src/publishes/admin_assets',
        'src/publishes/assets_css',
        'src/publishes/assets_js',
        'src/publishes/assets_js/{{module}}',
        'src/publishes/config',
        'src/publishes/controllers',
        'src/publishes/middleware',
        'src/publishes/migrations',
        'src/publishes/models',
        'src/publishes/models/{{Module}}',
        'src/publishes/routes',
        'src/publishes/seeds',
        'src/publishes/views',
        'src/publishes/views/{{module}}',
        'src/publishes/files',
        'src/publishes/files/{{module}}'
    ];
    protected $stubs = [
        'composer.stub' => 'composer.json',
        'src/AdminmoduleServiceProvider.stub' => 'src/{{Module}}ServiceProvider.php',
        'src/config.stub' => 'src/config.php',
        'src/publishes/assets_js/module/edit.stub' => 'src/publishes/assets_js/{{module}}/edit.js',
        'src/publishes/assets_js/module/list.stub' => 'src/publishes/assets_js/{{module}}/list.js',
        'src/publishes/controllers/ModuleController.stub' => 'src/publishes/controllers/{{Module}}Controller.php',
        'src/publishes/migrations/migration_timestamp_module_module.stub' => 'src/publishes/migrations/{{migration_timestamp}}_{{module}}_module.php',
        'src/publishes/models/Module/Entity.stub' => 'src/publishes/models/{{Module}}/{{Entity}}.php',
        'src/publishes/routes/module.stub' => 'src/publishes/routes/{{module}}.php',
        'src/publishes/views/module/edit.blade.stub' => 'src/publishes/views/{{module}}/edit.blade.php',
        'src/publishes/views/module/list.blade.stub' => 'src/publishes/views/{{module}}/list.blade.php',
        'src/publishes/files/module/.gitignore.stub' => 'src/publishes/files/{{module}}/.gitignore',
        'src/publishes/files/module/default.stub' => 'src/publishes/files/{{module}}/default.png',
    ];
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
        $this->time_string = Carbon::now()->format('Y_m_d_His');
    }

    /**
     * Perform command action
     *
     * @return void
     */
    public function handle()
    {
        // Get or ask module name
        $executionInit = microtime(true);
        $this->entity = strtolower($this->argument('class') ?: $this->ask(
            'Class name', ''
        ));

        // Create default titles
        $this->title = $this->module = $this->entities = (function_exists('str_plural') ? str_plural($this->entity) : \Str::plural($this->entity));

        // Get dest package module name
        Console::tab('Creating module')->ok('packages/tejuino/' . $this->module)->nl();

        // Packages folders
        $this->createPackagesDirectories();

        // Check if module directory already exists
        $packageDir = base_path('packages/tejuino/' . $this->module);
        if (file_exists($packageDir)) {
            Console::tab('Module')->ok($this->module)->error('already exists, mission aborted!')->nl();
            return;
        }

        // Create module directory
        mkdir($packageDir);

        // Create module folders
        $this->createDirectories($packageDir);

        // Create module files
        $this->createFiles($packageDir);

        // Executing extra commands
        $this->askForInclude();

        // Print execution time
        $executionTime = microtime(true) - $executionInit;
        Console::nl()->nl()->info('Mission completed in')->ok($executionTime)->info('seconds')->nl()->nl();
    }

    /**
     * Create empty package directory
     *
     * @return void
     */
    protected function createPackagesDirectories()
    {
        // Check if packages path exists
        if (!file_exists(base_path('packages'))) {
            Console::log('Creating folder [y]/packages/');
            mkdir(base_path('packages'));
        }

        // Check if packages/tejuino path exists
        if (!file_exists(base_path('packages/tejuino'))) {
            Console::log('Creating folder [y]packages/tejuino');
            mkdir(base_path('packages/tejuino'));
        }
    }

    /**
     * Create package directory tree
     *
     * @param string $packageDir
     * @return void
     */
    protected function createDirectories($packageDir)
    {
        Console::nl()->warning('Creating module directories...');

        // Get pack destination (package dir)
        foreach ($this->folders as $folder) {
            Console::nl()->tab()->tab('Creating folder')->ok($this->stubReplace($folder));
            $destPath = $packageDir . '/' . $this->stubReplace($folder);
            mkdir($destPath);
        }

        Console::nl()->tab('Completed')->nl();
    }

    /**
     * Create package files and replace stubs
     *
     * @param [type] $packageDir
     * @return void
     */
    public function createFiles($packageDir)
    {
        Console::nl()->warning('Creating module files and replacing stub code...');

        foreach ($this->stubs as $stubFile => $destFile) {
            // Get stub origin (stubs dir)
            $originPath = __DIR__ . '/' . $this->stubs_dir . $stubFile;

            // Get file destination (packager dir)
            $destPath = $packageDir . '/' . $this->stubReplace($destFile);

            // Copy files
            Console::nl()->tab()->tab('Creating file')->ok($this->stubReplace($destFile));
            if (!File::copy($originPath, $destPath)) {
                Console::nl()->error('Could not copy file')->info($originPath)->error('to')->info($destPath);
                continue;
            }

            // Replace stub content
            file_put_contents($destPath, $this->stubReplace(file_get_contents($originPath)));
        }

        Console::nl()->tab('Completed')->nl();
    }

    /**
     * Stub replacements
     *
     * @param string $text
     * @return string
     */
    protected function stubReplace($text)
    {
        $text = str_replace('{{title}}', $this->title, $text);
        $text = str_replace('{{Module}}', ucfirst($this->module), $text);
        $text = str_replace('{{module}}', $this->module, $text);
        $text = str_replace('{{Entity}}', ucfirst($this->entity), $text);
        $text = str_replace('{{entity}}', $this->entity, $text);
        $text = str_replace('{{Entities}}', ucfirst($this->entities), $text);
        $text = str_replace('{{entities}}', $this->entities, $text);
        $text = str_replace('{{migration_timestamp}}', $this->time_string, $text);

        return $text;
    }

    /**
     * Ask for extra actions
     *
     * @return void
     */
    public function askForInclude()
    {
        // Get package namespace/class
        $autoloadClass = '"Tejuino\\\\' . ucfirst($this->module) . '\\\\": "packages/tejuino/' . $this->module . '/src",';
        $appProvider = 'Tejuino\\' . ucfirst($this->module) . '\\' . ucfirst($this->module) . 'ServiceProvider::class,';

        // Ask for composer file modification
        if ($this->option('all') || $this->option('compose') || $this->option('publish') || $this->ask('Add to composer.json? y/n', 'y') == 'y') {
            // Add composer required dir
            $this->files['composer.json'][0]['content'] = '' . $autoloadClass . PHP_EOL . '             ';

            // Add config/app class
            $this->files['config/app.php'][0]['content'] = '        ' . $appProvider;

            // Compile files
            $this->compileFiles();

            // Autoload
            Composer::dumpAutoload();
            Console::ok('Wait...')->nl();
            sleep(5);

            ArtisanCall::configCache();

            // Publish package
            if ($this->option('all') || $this->option('publish') || $this->ask('Publish this package? y/n', 'y') == 'y') {
                ArtisanCall::vendorPublish($this->module, true);

                // Execute migrations
                if ($this->option('all') || $this->option('migrate') || $this->ask('Execute migrations? y/n', 'y') == 'y') {
                    Composer::dumpAutoload();
                    ArtisanCall::configCache();
                    ArtisanCall::migrate();

                    // Open in Firefox
                    if (file_exists($firefox = '/Applications/Firefox.app/Contents/MacOS/firefox')) {
                        if ($this->option('all') || $this->option('open') || $this->ask('Open in Firefox? y/n', 'y') == 'y') {
                            shell_exec('cd ' . base_path() . ' && ' . $firefox . ' ' . url('admin/' . $this->module));
                        }
                    }
                }
            }
        }
    }
}
