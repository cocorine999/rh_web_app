<?php

namespace App\Jobs;

use App\Models\Permission;
use App\Models\User;
use App\Notifications\NewPermissionNotification;
use App\Notifications\ValidatePermissionNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class PermissionRequestActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    protected $permission;
    protected $option;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,Permission $permission,$option)
    {
        $this->user = $user;
        $this->permission = $permission;
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
            $this->user->notify(new NewPermissionNotification(Auth::user(),$this->permission));
        }
        elseif($this->option == 1){
            $this->user->notify(new ValidatePermissionNotification(Auth::user(),$this->permission,true));
        }
        elseif($this->option == -1){
            $this->user->notify(new ValidatePermissionNotification(Auth::user(),$this->permission,false));
        }
        else{

        }
    }
}
