<?php

namespace Tejuino\Sdk\Console;

use Artisan;
use Tejuino\Sdk\Console\Composer;
use Illuminate\Console\Command;
use Tejuino\Sdk\Traits\Compilable;

class InitCommand extends Command
{
    use Compilable;

    protected $signature = 'sdk:init
                            {app : App name}
                            {--domain= : Project domain}
                            {--database= : Database name}
                            {--user= : Database user}
                            {--password= : Database password}';
    protected $description = 'Init project configuration';
    protected $files = [
        '.env' => [],
        '.gitignore' => [
            [
                'type' => 'append',
                'content' => '{{enter}}.DS_Store{{enter}}/packages{{enter}}/.htaccess{{enter}}/.vscode{{enter}}/.well_known{{enter}}/favicon.gif{{enter}}/favicon.ico',
                'after' => 'yarn-error.log'
            ]
        ],
        'routes/web.php' => [
            [
                'type' => 'append',
                'content' => 'require(\'admin/admin.php\');{{enter}}Auth::routes();',
                'after' => '*/'
            ]
        ],
        'config/app.php' => [
            [
                'type' => 'append',
                'content' => "{{enter}}{{enter}}{{tab}}'domain' => env('APP_DOMAIN', 'tejuino.mx'),",
                'after' => "'name' => env('APP_NAME', 'Laravel'),"
            ]
        ],
        'config/database.php' => [
            [
                'type' => 'replace',
                'content' => 'utf8',
                'instead' => 'utf8mb4'
            ],
            [
                'type' => 'replace',
                'content' => 'utf8_general_ci',
                'instead' => 'utf8mb4_unicode_ci'
            ]
        ],
        'config/auth.php' => [
            [
                'type' => 'replace',
                'content' => '\'model\' => App\Models\Users\User::class',
                'instead' => '\'model\' => App\Models\User::class'
            ]
        ],
        'app/Http/Kernel.php' => [
            [
                'type' => 'replace',
                'content' => '//\App\Http\Middleware\VerifyCsrfToken::class,',
                'instead' => '\App\Http\Middleware\VerifyCsrfToken::class,'
            ],
            [
                'type' => 'replace',
                'content' => '//\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,',
                'instead' => '\Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,'
            ],
            [
                'type' => 'append',
                'content' => '{{enter}}{{tab}}{{tab}}\'admin\' => \App\Http\Middleware\AdminAuthenticated::class,{{enter}}{{tab}}{{tab}}\'super\' => \App\Http\Middleware\SuperAuthenticated::class,',
                'after' => "'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,"
            ]
        ]
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
        $executionInit = microtime(true);
        Console::info('Initializing project configurations...', 1)->nl()->info('---');

        // Initialize env
        if (!$this->configEnv()) {
            return;
        }

        // Execute pre commands
        $this->executePreCommands();

        // Compile files
        $this->compileFiles();

        // Execute post commands
        $this->executePostCommands();

        // Print execution time
        $executionTime = microtime(true) - $executionInit;
        Console::info('Mission completed in')->ok($executionTime)->info('seconds')->nl();
    }

    /**
     * Configurate environment
     *
     * @return void
     */
    protected function configEnv()
    {
        // Ask for app properties
        $app_name = $this->argument('app') ?: $this->ask('App name', '');
        $domain = $this->option('domain') ?: $this->ask('App domain', '');
        $database = $this->option('database') ?: $this->ask('App database', '');
        $user = $this->option('user') ?: $this->ask('Database user', '');
        $password = $this->option('password') ?: $this->ask('Database password', false);

        Console::info('Configuring env file', 1)->nl()->info('---');

        // Check if env file already exists
        if (file_exists(base_path('.env'))) {
            Console::nl()->error('File .env already exists!')->nl();
            return false;
        }

        // Check if env.example exists
        if (!file_exists(base_path('.env.example'))) {
            Console::nl()->error('File .env.example does not exists!')->nl();
            return false;
        }

        // Get example content
        $content = file_get_contents(base_path('.env.example'));

        // Replace parameters
        $content = str_replace('APP_NAME=Laravel', 'APP_NAME="' . $app_name . '"' , $content);
        $content = str_replace('APP_URL=http://localhost', 'APP_URL=http://' . $domain . '.test/' . $this->enter_char . 'APP_DOMAIN=' . $domain, $content);
        $content = str_replace('DB_DATABASE=homestead', 'DB_DATABASE=' . $database, $content);
        $content = str_replace('DB_USERNAME=homestead', 'DB_USERNAME=' . $user, $content);
        $content = str_replace('DB_DATABASE=laravel', 'DB_DATABASE=' . $database, $content);
        $content = str_replace('DB_USERNAME=root', 'DB_USERNAME=' . $user, $content);
        $content = str_replace('DB_PASSWORD=secret', 'DB_PASSWORD=' . $password, $content);

        // Write content
        file_put_contents(base_path('.env'), $content);

        return true;
    }

    /**
     * Execute pre commands
     *
     * @return void
     */
    protected function executePreCommands()
    {
        Console::info('Executing artisan pre commands', 1)->nl()->info('---');

        ArtisanCall::vendorPublish('admin', true);
        ArtisanCall::vendorPublish('assets', true);
        ArtisanCall::vendorPublish('sdk', true);
    }

    /**
     * Execute post commands
     *
     * @return void
     */
    protected function executePostCommands()
    {
        Console::info('Executing composer post commands', 1)->nl()->info('---');
        Composer::installUi();

        Console::info('Executing artisan post commands', 1)->nl()->info('---');

        ArtisanCall::keyGenerate();
        // sleep(2);

        ArtisanCall::configClear();
        ArtisanCall::configCache();
        ArtisanCall::clearCompiled();
        ArtisanCall::migrate();
        ArtisanCall::executeDefaultSeeder();
    }

}
