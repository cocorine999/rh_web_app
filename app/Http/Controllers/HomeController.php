<?php

namespace App\Http\Controllers;

use App\Models\Paiement;
use App\Models\Permission;
use App\Models\Poste;
use App\Models\Presence;
use App\Models\Rapport;
use App\Models\RendezVous;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $permissions = [];
        $rendez_vous = [];
        $reports = [];
        $paiements   = [];
        $users       = [];
        $users_presences = [];

        $permissions_count = 0;
        $rendez_vous_count = 0;
        $reports_count = 0;
        $paiements_count = 0;
        $presences_count = 0;
        $users_count = 0;
        $postes_count = 0;
        $paiements_reject=0;
        $paiements_waiting=0;
        $roles_count = 0;

        if(auth()->user()->hasRole('administrateur')){
            $roles = Role::where('name','LIKE','%Employé%')->orwhere('name','LIKE','%Stagiaire%')->get();
            $users = [];
            foreach ($roles as $role) {

                foreach ($role->users as $key => $user) {
                    $trafic = Presence::where('created_at','>=',Carbon::today())->where('user_id',$user->id)->get();
                    if(count($trafic) == 0){
                        array_push($users_presences,$user);
                    }
                }
            }
        }

        if(auth()->user()->hasRole('administrateur')){
            $permissions_count = Permission::all()->whereIn("status",array(2,0))->count();
            $rendez_vous = RendezVous::latest()->whereIn("status",array(2,0))->get();
            $rendez_vous_count = RendezVous::all()->whereIn("status",array(2,0))->count();
            $users_count = User::all()->count();
            $postes_count = Poste::all()->count();
        }
        elseif(auth()->user()->hasPoste('Sécrétariat')){
            $rendez_vous = RendezVous::latest()->orderBy('status')->get();
            $presences_count = Presence::latest()->where('created_at','>=',Carbon::today())->where("in_at",'!=',null)->count();
            $users_count = User::all()->count();
            $postes_count = Poste::all()->count();

            $rendez_vous_count = RendezVous::whereIn("status",[2,0])->count();
        }
        elseif(auth()->user()->hasPoste('RH')){
            $permissions_count = Permission::whereIn("is_accept",[2,0])->count();
            $rendez_vous_count = RendezVous::all()->whereIn("status",array(2,0))->count();
            $users_count = User::all()->count();
            $postes_count = Poste::all()->count();
            $permissions = Permission::latest()->whereIn("is_accept",[2,0])->get();
            //$rendez_vous = RendezVous::where("status",'IN',[2,0])->count();
            $users = User::latest()->get();
        }
        elseif(auth()->user()->hasPoste('Comptable')){
            $paiements = Paiement::whereIn("is_pay",[2,0,-1])->latest()->get();
            $paiements_waiting = Paiement::whereIn("is_pay",[2,0])->count();
            $paiements_reject = Paiement::where("is_pay",-1)->count();
            $postes_count = Poste::all()->count();
            $users_count = User::all()->count();
        }
        else{

            if (auth()->user()->can('view-all-reports',Rapport::class))
            {
                $reports = [];

                $poste = Poste::where('name','Développeur')->first();

                foreach ($poste->users as $key => $user) {
                    foreach ($user->rapports as $key => $rapport) {
                        array_push($reports,$rapport);
                    }
                }

                $reports_count = count($reports);

            }else{

                $value = 0;

                $presences_count = auth()->user()->presences->where("in_at",null)->count();

                $reports = [];

                $reports = Rapport::where('user_id',Auth::id())->latest()->with('user')->get();

                $reports_count = count($reports);

                $paiements_waiting = auth()->user()->poste_users->loadCount('paiements')->whereIn("is_pay",[2,0])->sum('paiements_count');

                $permissions_count = auth()->user()->permissions->whereIn("is_pay",[2,0])->count();
            }
        }

        $setting = Setting::latest()->first();

        return view('home',compact('setting','permissions','users_presences','paiements','users','rendez_vous','permissions_count','presences_count', 'reports','reports_count','roles_count','postes_count','paiements_count','paiements_waiting','paiements_reject','users_count','rendez_vous_count'));

    }
}
