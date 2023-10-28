<?php

namespace App\Http\Controllers;

use App\Jobs\MonthlyPayActionJob;
use Carbon\Carbon;
use Illuminate\Support\Str;
use App\Models\Paiement;
use App\Models\Poste;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use App\Notifications\MonthlyPayNotification;
use App\Notifications\ValidatePermissionNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{

    protected $rules = [
        'date' => 'required',
        'user_id' => 'required|exists:users,id'
    ];
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('comptable')->except(['REJETER','VALIDER','index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->cannot('manage-payments') && auth()->user()->cannot('validate-payments') && auth()->user()->cannot('view-payments')) {
            return redirect()->route('403');
        }
        if (Auth::user()->can('manage-payments'))
        {
            $paiements = Paiement::latest()->with('responsable','poste_user.user','poste_user.user.user_actual_poste')->paginate(50);
        }else{
            $paiements = Paiement::where('poste_user_id',Auth::user()->poste_users->last()->id)->latest()->with('responsable','poste_user.user','poste_user.user.user_actual_poste')->paginate(20);
        }

        //$data = User::where('id',33)->first()->poste_users()->where('in_function',true)->with('paiements')->first();

        $users = User::has('user_actual_poste')->get();

        $setting = Setting::latest()->first();

        return view('paiements.paiements',compact('setting','paiements','users'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Check if user is authorize

        if (auth()->user()->cannot('manage-payments') && auth()->user()->cannot('create-payments')) {
            return redirect()->route('403');
        }



        //Check request params
        $request->validate($this->rules);

        //instantiate object of payment
        $paiement = new Paiement();

        //Get employee data;
        $user = User::findOrfail($request->user_id);

        //$user_postes = $user->user_actual_poste;

        foreach ($user->user_actual_poste->unique() as $poste) {

            //instantiate object of payment
            $paiement = new Paiement();

            //echo($poste->salaire);

            //get last poste user of user
            $user_poste = $poste->poste_users->last();

            //set the paiement occurence with the new values
            $paiement->salaire = $user_poste->salaires->last()->montant ?? $poste->salaire;

            $paiement->date = $request->date;

            $paiement->user_id = Auth::id();

            $paiement->poste_user_id = $user_poste->id;

            //set the paiement occurence with the new values
            $paiement->is_pay = 2;

            //save data
            $paiement->save();

            //Notify to user
            dispatch(new MonthlyPayActionJob($user,$paiement,2));

        }

        return back()->with('success','Enregistrement éffectué');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->cannot('manage-payments') && auth()->user()->cannot('view-payments')) {
            return redirect()->route('403');
        }
        $paiement = Paiement::findOrfail($id);
        $this->authorize('view', $paiement);

        $setting = Setting::latest()->first();

        return view('paiements.read',compact('setting'))->with('paiement',$paiement);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $paiement = Paiement::findOrfail($id);
        $this->authorize('update', $paiement);
        return redirect()->route('dashboard.paiements.index')->with('success','Paiement updated successfully');
        return view('paiements.paiements')->with('paiement',$paiement);
    }

    /**
     * REJETER the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function REJETER(Request $request, $id)
    {

        if (auth()->user()->cannot('validate-payments')) {
            return redirect()->route('403');
        }

        //Check if user is authorize
        $paiement = Paiement::findOrfail($id);

        //Check if user is authorize
        $this->authorize('validate', $paiement);

        //set the occurence of payment status to -1(false)
        $paiement->is_pay = -1;

        //update modification
        $paiement->save();

        //Get user who make payment
        $user = User::findOrfail($paiement->user_id);

         //Notify to user
        dispatch(new MonthlyPayActionJob($user,$paiement,-1));

        // return return back to paiement list page with successfully message
        return back()->with('success','Notification pour paiement non reçu envoyé');
    }

    /**
     * Validate payment function
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function VALIDER(Request $request, $id){

        if (auth()->user()->cannot('validate-payments')) {
            return redirect()->route('403');
        }

        //Find occurence
        $paiement = Paiement::findOrfail($id);

        //Check if user is authorize
        $this->authorize('validate', $paiement);

        //set the occurence of payment status to 1(true)
        $paiement->is_pay = 1;


        //update modification
        $paiement->save();


        //Get user who make payment
        $user = User::findOrfail($paiement->user_id);

        //Notify to user

        //$users = [];

        $role = Role::where('name','like',"%Admin%")->where('name','not like',"%Employé%")->where('name','not like',"%Stagiaire%")->first();

        //array_push($users,$role->users);

        $poste = Poste::where('name','like',"%Comptable%")->first();

        //array_push($users,$poste->users);

        $users = collect($role->users)->merge(collect($poste->users));

        foreach ($users as $uSer) {
            if($uSer->id != $user->id ){
                dispatch(new MonthlyPayActionJob($uSer,$paiement,1));
            }
        }

        dispatch(new MonthlyPayActionJob($user,$paiement,1));

        // return return back to paiement list page with successfully message
        return back()->with('success','Paiement confirmé');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if (auth()->user()->cannot('manage-payments') && auth()->user()->cannot('update-payments')) {
            return redirect()->route('403');
        }
        //Check request params
        $request->validate($this->rules);

        //Find occurence
        $paiement = Paiement::findOrfail($id);

        //Get employee data
        $user = User::findOrfail($request->user_id);

        //set the paiement occurence with the new values
        $paiement->salaire = $request->salaire ?? $user->salaire;
        $paiement->date = $request->date;
        $paiement->user_id = Auth::id();
        $paiement->poste_user_id = $user->poste_users->last()->id;
        if ($paiement->is_pay != 1 && $paiement->is_pay != 2) {
            $paiement->is_pay = 0;
        }

        //update paiement occurence with the new values
        $paiement->save();

        //Notify to user
        dispatch(new MonthlyPayActionJob($user,$paiement,2));


        //return return back to paiement list page with successfully message
        return back()->with('success','Modification effectué');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->cannot('manage-payments') && auth()->user()->cannot('delete-payments')) {
            return redirect()->route('403');
        }

        // Find occurence
        $paiement = Paiement::findOrfail($id);

        // Check if user is authorize
        $this->authorize('delete', $paiement);

        // delete the occurence of payment
        $paiement->delete();

        // return return back to paiement list page with successfully message
        return redirect()->route('dashboard.paiements.index')->with('success','Suppression réussie');

    }

    // CUSTOM FUNCTION


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchPaiement(Request $request)
    {
        $paiements = Paiement::where('name',"%LIKE%",$request->searchValue)->loadCount('users')->sortByDesc('created_at');
        return view('paiements.paiements')->with('paiements',$paiements);
    }
}
