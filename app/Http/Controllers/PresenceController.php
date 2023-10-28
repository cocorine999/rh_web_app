<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Presence;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PresenceController extends Controller
{

    protected $rules = [
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
        if (auth()->user()->cannot('manage-presences') && auth()->user()->cannot('view-presences')) {

            return redirect()->route('403');
        }

        $presences = Presence::latest()->where('created_at','>=',Carbon::today())->with('user')->paginate(20);

        $roles = Role::where('name','LIKE','%Employé%')->orwhere('name','LIKE','%Stagiaire%')->get();
        $users = [];
        foreach ($roles as $role) {

            foreach ($role->users as $key => $user) {
                $trafic = Presence::where('created_at','>=',Carbon::today())->where('user_id',$user->id)->get();
                if(count($trafic) == 0){
                    array_push($users,$user);
                }
            }
        }

        $setting = Setting::latest()->first();

        return view('presences.presences',compact('setting','presences','users'))
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
        if (auth()->user()->cannot('manage-presences') && auth()->user()->cannot('create-presences')) {

            return redirect()->route('403');
        }
            $request->validate($this->rules);
            $presence = new Presence();
            $presence->in_at = Carbon::now();
            $presence->is_present = 2;
            $presence->user_id = $request->user_id;
            $presence->save();

            return back()->with('success','Une nouvelle entrée.');

    }

    public function userInAt(Request $request)
    {
        if (auth()->user()->cannot('manage-presences') && auth()->user()->cannot('create-presences')) {

            return redirect()->route('403');
        }
            $presence = new Presence();
            $presence->in_at = Carbon::now();
            $presence->is_present = 2;
            $presence->user_id = Auth::id();
            $presence->save();
            return response()->json([
                'message' =>  'success',
            ]);

    }
    public function userOutAt(Request $request)
    {
        if (auth()->user()->cannot('manage-presences')) {

            return redirect()->route('403');
        }
            $presence = auth()->user()->presences->where('created_at','>=',Carbon::today())->first();

            $this->authorize('sortie-service', $presence);
            $presence->out_at = Carbon::now();
            $presence->is_present = 1;
            $presence->save();
            return response()->json([
                'message' =>  'success',
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $presence = Presence::findOrfail($id);
        $this->authorize('view', $presence);
        return redirect()->route('dashboard.presences.index')->with('success','Rôle updated successfully');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $presence = Presence::findOrfail($id);

    }

    public function SORTIE(Request $request, $id)
    {
        $presence = Presence::findOrfail($id);
        $this->authorize('sortie-service', $presence);
        $presence->out_at = Carbon::now();
        $presence->save();
        return back()->with('success','Nouvelle sortie');

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
        if (auth()->user()->cannot('update-presences')) {
            return redirect()->route('403');
        }
        $this->rules['user_id'] = 'sometimes|exists:users,id';

            $request->validate($this->rules);
            $presence = Presence::findOrfail($id);
            $presence->in_at = $request->in_at;
            $presence->out_at = $request->out_at;

            $presence->save();

            if ($request->ajax()) {
                return response()->json([
                    'status' => "success",
                    'message' => "Trafic mis à jour.",
                ]);
            }

            return back()->with('success','Trafic modifier');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
            if (auth()->user()->cannot('delete-presences')) {
                return redirect()->route('403');
            }

        $presence = Presence::findOrfail($id);

        $presence->delete();
        return redirect()->route('dashboard.presences.index')->with('success','Presence supprimé avec succès');
        return route('dashboard.presences.index');
    }

    // CUSTOM FUNCTION


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchPresence(Request $request)
    {
        $presences = Presence::where('name',"%LIKE%",$request->searchValue)->loadCount('users')->sortByDesc('created_at');
        return view('presences.presences')->with('presences',$presences);
    }
}
