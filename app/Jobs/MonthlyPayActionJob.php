<?php

namespace App\Jobs;

use App\Models\Paiement;
use App\Models\Role;
use App\Models\User;
use App\Notifications\ConfirmPayNotification;
use App\Notifications\MonthlyPayNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Auth;

class MonthlyPayActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $user;
    protected $paiement;
    protected $option;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(User $user,Paiement $paiement,$option)
    {
        $this->user = $user;
        $this->paiement = $paiement;
        $this->option = $option;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->option == 2 || $this->option == 0 ){
            $this->user->notify(new MonthlyPayNotification(Auth::user(),$this->paiement));
        }
        elseif($this->option == 1){
            $this->user->notify(new ConfirmPayNotification(Auth::user(),$this->paiement,true));
        }
        elseif($this->option == -1){
            $this->user->notify(new ConfirmPayNotification(Auth::user(),$this->paiement,false));
        }
        else{

        }
    }
}
