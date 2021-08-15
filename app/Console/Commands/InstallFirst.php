<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class InstallFirst extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:first';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'First Installation';

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
        $this->call('key:generate');
        $this->call('storage:link');
        $this->call('migrate:fresh');
        $this->call('db:seed');
        $this->call('clear');
        $this->call('cache:clear');
        $this->call('config:cache');
        $this->call('config:clear');
        $this->call('view:clear');
    }
}
