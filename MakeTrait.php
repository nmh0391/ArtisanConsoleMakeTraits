<?php

/**
 * THIS CLASS IS ONLY TESTED FOR WINDOWS SYSTEMS.
 * THIS CLASS CREATE TRAITS VIA ARTISAN CONSOLE.
 * 
 * @author Paulo Santos
 * @company WebMax
 */

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Exception;

class MakeTrait extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new trait';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info($this->save());
    }

    /**
     * Make root directory "Trait" if not exists
     *
     * @return void
     */
    private function makeRootDir()
    {
        if (!file_exists('app/Traits')) {
            mkdir('app/Traits', 0755);
        }
    }

    /**
     * Return trait code
     *
     * @return string
     */
    private function makeTrait()
    {
        return $code = sprintf(
'<?php 

namespace App\Traits;

trait %s 
{
    // code here...
}
', 
        $this->argument('name'));
    }

    /**
     * Create new trait
     *
     * @return mixed
     */
    private function save()
    {
        // generate root directory if not exists
        $this->makeRootDir();

        // generate trait path
        $trait = $this->generateName();

        // check if the new trait already exists
        if (file_exists($trait)) {
            throw new Exception('The trait "' . $trait . '" already exists.');
        }

        // create trait 
        file_put_contents($trait, $this->makeTrait());

        // check if trait was created
        if (!file_exists($trait)) {
            throw new Exception('The trait "' . $trait . '" already exists.');
        } else {
            return 'Trait "' . $this->argument('name') . '" was created sucefully!';
        }
    }

    /**
     * Generate trait path
     *
     * @return string
     */
    private function generateName()
    {
        return 'app/Traits/' . $this->argument('name') . '.php';
    }
}
