<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class EpawnCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'epawn:send-email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email';

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
        $digits = 5;
        $confirmation_code = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $beautymail = app()->make(\Snowfire\Beautymail\Beautymail::class);
        $beautymail->send(
            'emails.welcome',
            ['confirmation_code' => $confirmation_code],
            function ($message) {
                $message
                    ->from('epawn.online01@gmail.com', 'E-PAWN')
                    ->to('pj.abing@gmail.com', 'PJ Abing')
                    ->subject('E-pawn Email Verification!');
            }
        );
    }
}
