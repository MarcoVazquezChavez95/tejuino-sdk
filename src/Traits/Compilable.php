<?php

namespace Tejuino\Sdk\Traits;

use Tejuino\Sdk\Console\Console;

trait Compilable
{

    protected $enter_char = PHP_EOL;
    protected $tab_char = '    ';

    /**
     * Compile files
     *
     * @return void
     */
    protected function compileFiles()
    {
        Console::nl()->tab('Compiling files ---');

        foreach ($this->files as $file => $actions) {
            Console::nl()->tab()->tab()->ok($file);

            // Get file path
            $destPath = base_path($file);
            $fileContent = '';

            // Get file content
            try {
                $fileContent = file_get_contents($destPath);
            }
            catch (\Exception $ex) {
                Console::error('Not found');
                continue;
            }

            // Perform action
            foreach ($actions as $action) {
                switch ($action['type']) {
                    case 'prepend':
                        Console::nl()->tab('Prepending')->ok($action['content']);

                        // Prepend content before
                        $beforeContent =  $this->stubReplace($action['content'] . $action['before']);

                        // Replace content
                        $fileContent = str_replace($action['before'], $beforeContent, $fileContent);

                        break;
                    case 'append':
                        Console::nl()->tab('Appending')->ok($action['content']);

                        // Append content after
                        $afterContent = $action['after'] . $this->enter_char . $this->stubReplace($action['content']);

                        // Replace content
                        $fileContent = str_replace($action['after'], $afterContent, $fileContent);

                        break;
                    case 'replace':
                        Console::nl()->tab('Replacing')->ok($action['instead']);

                        // Replace content
                        $fileContent = str_replace($action['instead'], $action['content'], $fileContent);

                        break;
                }
            }

            // Save file
            file_put_contents($destPath, $fileContent);
        }
    }

    /**
     * Replace stubs
     *
     * @param string    $content
     * @return string
     */
    protected function stubReplace($content)
    {
        $content = str_replace('{{enter}}', $this->enter_char, $content);
        $content = str_replace('{{tab}}', $this->tab_char, $content);

        return $content;
    }

}
