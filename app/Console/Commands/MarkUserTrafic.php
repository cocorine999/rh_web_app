<?php

namespace App\Console\Commands;

use App\Models\Presence;
use App\Models\Role;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Console\Command;

class MarkUserTrafic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'employee:trafic';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mark employee daily trafic of employee';

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
        $rh = Role::where('name','LIKE','%Employé%')->orWhere('name','LIKE','%Stagiaire%')->first();

        foreach ($rh->users as $key => $user) {
            $trafic = Presence::where('in_at','!=',null)->where('created_at','>=',Carbon::today())->where('user_id',$user->id)->get();
            //$trafic = Presence::where('in_at',null)->where('created_at',\Carbon\Carbon::today())->where('user_id','!=',$user->id)->get();
            if(count($trafic) == 0){
                $presence = new Presence();
                $presence->in_at = null;
                $presence->out_at = null;
                $presence->is_present = -1;
                $presence->user_id = $user->id;
                $presence->save();
            }
            else{
                foreach ($user->presences as $key => $presence) {
                    if($presence->is_present == 2 || $presence->is_present == 0){
                        $setting =Setting::latest()->first();
                        $presence->out_at = Carbon::parse(Carbon::parse($presence->in_at),$setting->horaire_service_end)->format('Y-m-d, h:m') ;
                        $presence->is_present = 1;
                        $presence->save();
                    }

                    if($presence->in_at == null){

                        $presence->out_at = null;
                        $presence->is_present = -1;
                        $presence->save();

                    }
                }

                $presence = Presence::where('id',1)->first();
                $presence->in_at = null;
                $presence->out_at = null;
                $presence->is_present = -1;
                $presence->save();
            }
        }
        //User
        $this->info('MARK SUCCESSFULLY!');
    }
}
