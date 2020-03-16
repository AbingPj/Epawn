<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EpawnSendConfiscation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'epawn:send-confiscation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send a confiscation warning.';

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
        //
    }
}
