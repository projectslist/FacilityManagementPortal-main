<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ImportLadaCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:ladacodes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import the .sql file ';

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
     * @return int
     */
    public function handle()
    {
       return \DB::unprepared(file_get_contents('database/migrations/base.sql'));
        // return 0;
    }
}
