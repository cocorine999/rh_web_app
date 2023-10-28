<?php

namespace App\Jobs;

use App\Models\Rapport;
use App\Models\Role;
use App\Models\User;
use App\Notifications\AppreciationReportNotification;
use App\Notifications\NewReportNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class ReportNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    protected $rapport;
    protected $option;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,Rapport $rapport,$option)
    {
        $this->user = $user;
        $this->rapport = $rapport;
        $this->option = $option;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->option == 2 || $this->option == 0){

            $this->user->notify(new NewReportNotification(Auth::user(),$this->rapport));

        }
        elseif($this->option == 5){
            $this->user->notify(new AppreciationReportNotification(Auth::user(),$this->rapport));
        }
        else{

        }
    }
}
