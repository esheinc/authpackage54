<?php

namespace Esheinc\Authpackage\Console;

use Artisan;
use Illuminate\Console\Command;

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
        $this->comment('Updating geoip for maxmind_database...');
        $exitCode = Artisan::call('geoip:update', []);
        $this->comment('Running migrate:refresh...');
        $exitCode = Artisan::call('migrate:refresh', []);
        $this->comment('Running db:seed for AdminsTableSeeder...');
        $exitCode = Artisan::call('db:seed', ['--class' => 'AdminsTableSeeder']);
        $this->comment('Running db:seed for CountriesTableSeeder...');
        $exitCode = Artisan::call('db:seed', ['--class' => 'CountriesTableSeeder']);
    }
}
