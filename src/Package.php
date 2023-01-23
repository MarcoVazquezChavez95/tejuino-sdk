<?php

namespace Tejuino\Sdk;

use Tejuino\Sdk\Console\Console;

class Package
{

    /**
     * Get module configuration
     *
     * @param string    $moduleName
     * @return array
     */
    public static function getModuleConfig($moduleName)
    {
        $configFilepath = base_path('packages/tejuino/' . $moduleName . '/src/config.php');

        // Check if file exists
        if (!file_exists($configFilepath)) {
            Console::log('Path does not exist: [r]' . $configFilepath)->nl();
            return false;
        }

        $config = include $configFilepath;

        // Check if config is array
        if (!is_array($config)) {
            Console::log('Config is not array: [r]' . 'module.php')->nl();
            return false;
        }

        return $config;
    }

    /**
     * Get current configuration
     *
     * @param string    $_dir_
     * @return array
     */
    public static function getConfig($_dir_ = null)
    {
        $configFilepath = ($_dir_ ?: __DIR__) . '/config.php';

        // Check if file exists
        if (!file_exists($configFilepath)) {
            Console::error('Path does not exist:')->info($configFilepath)->nl();
            return false;
        }

        $config = include $configFilepath;

        // Check if config is array
        if (!is_array($config)) {
            Console::error('Config is not array:')->info('config.php')->nl();
            return false;
        }

        return $config;
    }

    /**
     * Get real module directory
     *
     * @param string    $moduleName
     * @return string
     */
    public static function getModuleDir($moduleName)
    {
        return base_path('packages/tejuino/' . $moduleName . '/src');
    }

    /**
     * Get Laravel project real path based on resource type
     *
     * @param string    $type
     * @param string    $subdirectory
     * @return string
     */
    public static function getLaravelPath($type, $subdirectory)
    {
        $directoryMap = [
            'config' => 'config/',
            'controllers' => 'app/Http/Controllers/Admin/',
            'auth' => 'app/Http/Controllers/Auth/',
            'middleware' => 'app/Http/Middleware/',
            'migrations' => 'database/migrations/',
            'seeds' => 'database/seeds/',
            'routes' => 'routes/admin/',
            'models' => 'app/Models/',
            'views' => 'resources/views/admin/',
            'view_components' => 'app/View/Components/',
            'assets_css' => 'public/admin_assets/css/',
            'assets_js' => 'public/admin_assets/js/',
            'admin_assets' => 'public/admin_assets/',
            'files' => 'public/files/'
        ];

        return base_path($directoryMap[$type] . $subdirectory);
    }

    /**
     * Get publishable package directory based on resource type
     *
     * @param string    $moduleName
     * @param string    $type
     * @param string    $subdirectory
     * @return string
     */
    public static function getPackagePath($moduleName, $type, $subdirectory)
    {
        return static::getModuleDir($moduleName) . '/publishes/' . $type . '/' . $subdirectory;
    }

    /**
     * Get self package path
     *
     * @param string    $type
     * @param string    $subdirectory
     * @param string    $_dir_
     * @return string
     */
    public static function getSelfPackagePath($type, $subdirectory, $_dir_ = null)
    {
        return ($_dir_ ?: __DIR__) . '/publishes/' . $type . '/' . $subdirectory;
    }

}
