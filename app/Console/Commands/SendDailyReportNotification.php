<?php

namespace App\Console\Commands;

use App\Jobs\SendDailyReportJob;
use App\Models\Role;
use Illuminate\Console\Command;

class SendDailyReportNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    //protected $signature = 'daily:report';
    protected $signature = 'daily_report_notifications';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily report notifications';

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
        $message = '';

        $rh = Role::where('name','LIKE','%Employé%')->first();

            foreach ($rh->users as $key => $user) {
                // add this to send a notification
                dispatch(new SendDailyReportJob($user,$message));
                //$user->notify(new NewPermission(Auth::user(),$permission));
            }

            $this->info('Send daily report notifications Run successfully!');
        }
}
