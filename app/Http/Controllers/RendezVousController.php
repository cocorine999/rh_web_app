<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use App\Models\RendezVous;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RendezVousController extends Controller
{

    protected $rules = [
        'visiteur_name' => 'required|string|max:255',
        'visiteur_telephone' => 'required|numeric:12',
        'libelle' => 'required|string|max:255',
        'description' => 'required|string|max:255',
        'date' => 'required|string|max:255',
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
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->cannot('manage-meeting') && auth()->user()->cannot('view-meeting')) {
            return redirect()->route('403');
        }

        $rendez_vous = RendezVous::latest()->with('user')->paginate(20);
        $role = Role::where('name','like',"%Admin%")->where('name','not like',"%Employé%")->where('name','not like',"%Stagiaire%")->first();
        if($role){
            $users = $role->users;
        }
        else{
            $users = [];
        }

        $setting = Setting::latest()->first();

        return view('rendez-vous.rendez-vous',compact('setting','rendez_vous','users'))
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
        if (auth()->user()->cannot('manage-meeting') && auth()->user()->cannot('create-meeting')) {
            return redirect()->route('403');
        }
            $request->validate($this->rules);
            $rendez_vous = new RendezVous();
            $rendez_vous->visiteur_name = Str::ucfirst(addslashes($request->visiteur_name));
            $rendez_vous->visiteur_telephone = Str::ucfirst(addslashes($request->visiteur_telephone));
            $rendez_vous->libelle = Str::ucfirst(addslashes($request->libelle));
            $rendez_vous->description = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->description)));
            $rendez_vous->date = $request->date;
            $rendez_vous->status = 2;
            $rendez_vous->user_id = $request->user_id;
            $rendez_vous->save();
            return back()->with('success','Votre demande a bien été envoyé.');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->cannot('manage-meeting') && auth()->user()->cannot('view-meeting')) {
            return redirect()->route('403');
        }
        $setting = Setting::latest()->first();
        $rendez_vous = RendezVous::findOrfail($id);
        return view('rendez-vous.details',compact('setting'))->with('rendez_vous',$rendez_vous);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rendez_vous = RendezVous::findOrfail($id);
        $this->authorize('update', $rendez_vous);
        return redirect()->route('dashboard.rendez-vous.index')->with('success','Rôle updated successfully');
    }

    public function ANNULER(Request $request, $id)
    {
        if (auth()->user()->cannot('manage-meeting') && auth()->user()->cannot('cancel-meeting')) {
            return redirect()->route('403');
        }
            $rendez_vous = RendezVous::findOrfail($id);
            $rendez_vous->status = -1;
            $rendez_vous->save();
            return back()->with('success','Rendez-vous vient d\'être annulé');

    }

    public function REPORTER(Request $request, $id)
    {
        if (auth()->user()->cannot('manage-meeting') && auth()->user()->cannot('report-meeting')) {
            return redirect()->route('403');
        }
            $rendez_vous = RendezVous::findOrfail($id);
            $rendez_vous->date = $request->date;
            $rendez_vous->status = 3;
            $rendez_vous->save();
            return back()->with('success','Rendez-vous a été reporté');

    }

    public function EFFECTUER(Request $request, $id)
    {
        if (auth()->user()->cannot('manage-meeting') && auth()->user()->cannot('confirm-meeting')) {
            return redirect()->route('403');
        }
            $rendez_vous = RendezVous::findOrfail($id);
            $rendez_vous->status = 1;
            $rendez_vous->save();
            return back()->with('success','Rendez-vous éffectué');

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

        if (auth()->user()->cannot('manage-meeting') && auth()->user()->cannot('update-meeting')) {
            return redirect()->route('403');
        }
            $request->validate($this->rules);

            $rendez_vous = RendezVous::findOrfail($id);

            $rendez_vous->visiteur_name = Str::ucfirst(addslashes($request->visiteur_name));

            $rendez_vous->visiteur_telephone = Str::ucfirst(addslashes($request->visiteur_telephone));

            $rendez_vous->libelle = Str::ucfirst(addslashes($request->libelle));

            $rendez_vous->description = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->description)));

            $rendez_vous->date = $request->date;

            $rendez_vous->user_id = $request->user_id;

            $rendez_vous->save();

            return back()->with('success','Rendez-vous mis à jour avec succès');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->cannot('manage-meeting') && auth()->user()->cannot('delete-meeting')) {
            return redirect()->route('403');
        }
        $rendez_vous = RendezVous::findOrfail($id);
        $rendez_vous->delete();
        return redirect()->route('dashboard.rendez-vous.index')->with('success','Rendez-vous supprimé avec succès');

    }

    // CUSTOM FUNCTION


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchRendezVous(Request $request)
    {
        $rendez_vous = RendezVous::where('name',"%LIKE%",$request->searchValue)->loadCount('users')->sortByDesc('created_at');
        return back()->with('success','Nouvelle sortie');

    }
}
