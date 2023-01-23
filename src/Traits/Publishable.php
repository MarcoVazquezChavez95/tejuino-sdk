<?php

namespace Tejuino\Sdk\Traits;

use Tejuino\Sdk\Package;

trait Publishable
{
    /**
     * The module configuration
     *
     * @var array
     */
    protected $config;

    /**
     * Publishes resources from package to project paths
     *
     * @param string $_dir_
     * @return void
     */
    protected function publishFiles($_dir_ = null)
    {
        // Get module publishable files and folders configuration
        $publishes = $this->config['publishes'];

        // Get file/folder list by type
        foreach ($publishes as $type => $files) {
            foreach ($files as $file) {
                // Get pack origin (package dir), it must be in /packages dir
                $originPath = Package::getSelfPackagePath($type, $file, $_dir_);

                // Get pack destination (Laravel dir)
                $destPath = Package::getLaravelPath($type, $file);

                // Add module files and folders to the Publishes stack
                $this->publishes([
                    $originPath => $destPath
                ]);
            }
        }
    }

}
