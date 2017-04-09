<?php

namespace Esheinc\Authpackage\Console;

use Artisan;
use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class Install extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'authpackage:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run artisan commands needed for this package';

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
        $this->comment('Running vendor:publish...');
        $exitCode = Artisan::call('vendor:publish', []);
        $this->comment($exitCode);

        $this->comment('Running autoload for seeding...');
        $exitCode = $this->composerDumpAutoload();
        $this->comment($exitCode);

        $this->comment('Running geoip:update...');
        $exitCode = Artisan::call('geoip:update', []);
        $this->comment($exitCode);

        $this->comment('Running migrate:refresh...');
        $exitCode = Artisan::call('migrate:refresh', []);
        $this->comment($exitCode);

        $this->comment('Running db:seed for AdminsTableSeeder...');
        $exitCode = Artisan::call('db:seed', ['--class' => 'AdminsTableSeeder']);
        $this->comment($exitCode);

        $this->comment('Running db:seed for CountriesTableSeeder...');
        $exitCode = Artisan::call('db:seed', ['--class' => 'CountriesTableSeeder']);
        $this->comment($exitCode);
    }

    public function composerDumpAutoload() {
        
        $autoload = new Process("composer dump-autoload -o");
        $autoload->setWorkingDirectory(base_path());
        $autoload->run();

        if($autoload->isSuccessful()){
            return $autoload->getOutput();
        } else {
            throw new ProcessFailedException($autoload);
        }
        
    }
}
