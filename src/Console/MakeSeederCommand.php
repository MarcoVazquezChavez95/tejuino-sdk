<?php

namespace Tejuino\Sdk\Console;

use File;
use Illuminate\Console\Command;

class MakeSeederCommand extends Command
{

    protected $signature = 'sdk:seeder
                            {class : Relative class path to \App\Models\},
                            {--all : Export all records, otherwise only 100 records will be exported}';
    protected $description = 'Make seeder from class';

    protected $class = null;
    protected $class_name = null;
    protected $model = null;
    protected $class_path = null;
    protected $enter_char = PHP_EOL;
    protected $tab_char = '    ';
    protected $stub_file = 'stubs/seeder/seeder.stub';
    protected $string_records = '';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Perform commands
     *
     * @return void
     */
    public function handle()
    {
        // Get or ask module title
        $this->class = $this->argument('class') ?: $this->ask(
            'Seeder Class', ''
        );
        $executionInit = microtime(true);

        Console::info('Creating seeder from model', 1)->ok('App\Models\\' . $this->class);

        // Get class instance
        $this->class_path = 'App\\Models\\' . $this->class;
        $this->model = new $this->class_path;
        $this->class_name = class_basename(get_class($this->model));

        // Get table columns
        $columns = $this->getColumns();

        // Get records
        $records = $this->getRecords();

        // Get rows array
        $this->string_records = $this->getStringRecords($records);

        // Write file
        $this->writeFile();

        // Print execution time
        $executionTime = microtime(true) - $executionInit;
        Console::info('Mission completed in', 1)->ok($executionTime)->info('seconds')->nl()->nl();
    }

    /**
     * Get table columns
     *
     * @return array
     */
    protected function getColumns()
    {
        return $this->model->getConnection()->getSchemaBuilder()->getColumnListing($this->model->getTable());
    }

    /**
     * Get table records
     *
     * @return void
     */
    protected function getRecords()
    {
        $records = [];
        $rows = $this->model->limit($this->option('all') ? 10000 : 100)->get();

        foreach($rows as $row) {
            $record = [];

            foreach($this->getColumns() as $column) {
                $record[$column] = $row->getOriginal($column);
            }

            $records[] = $record;
        }

        return $records;
    }

    /**
     * Get string records
     *
     * @param array $records
     * @return string
     */
    protected function getStringRecords($records)
    {
        $stringRecords = "";

        foreach ($records as $record) {
            $stringRecord = $this->enter_char . $this->tab_char . $this->tab_char . '$rows[] = [';

            foreach ($record as $key => $value) {
                $valueString = !is_null($value) ? '"' . $this->scapeString($value) . '"' : 'null';
                $stringRecord .= '"' . $key . '" => ' . $valueString . ', ';
            }

            $stringRecord .= '];';
            $stringRecords .= $stringRecord;
        }

        return $stringRecords;
    }

    /**
     * Scape strings
     *
     * @param string $value
     * @return string
     */
    public function scapeString($value)
    {
        return str_replace('$', '\$', addslashes($value));
    }

    /**
     * Write seeder file
     *
     * @return void
     */
    protected function writeFile()
    {
        // Get stub origin
        $originPath = __DIR__ . '/' . $this->stub_file;

        // Get file destination (seeder dir)
        $destPath = base_path('database/seeds/' . $this->class_name . 'Seeder.php');

        Console::info('Creating file', true)->ok($destPath);

        // Copy file
        if (!File::copy($originPath, $destPath)) {
            Console::error('Could not copy file', 1)->info($originPath)->error('to')->info($destPath);
            return;
        }

        // Replace stub content
        file_put_contents($destPath, $this->stubReplace(file_get_contents($originPath)));
    }

    /**
     * Stub replacements
     *
     * @param string $text
     * @return string
     */
    protected function stubReplace($text)
    {
        $text = str_replace('{{Class}}', $this->class_name, $text);
        $text = str_replace('{{rows}}', $this->string_records, $text);
        $text = str_replace('{{class_path}}', $this->class_path, $text);
        $text = str_replace('{{table}}', $this->model->getTable(), $text);

        return $text;
    }

}
