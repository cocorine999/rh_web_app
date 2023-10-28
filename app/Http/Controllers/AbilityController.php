<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Traits\HasAbilitiesTrait;
use Illuminate\Support\Str;
class AbilityController extends Controller
{
    use HasAbilitiesTrait;
    protected $rules = [
        'name' => 'required|string|max:255'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->cannot('manage-access') && auth()->user()->cannot('view-access')) {

            return redirect()->route('403');
        }
            $abilities = Ability::latest()->withCount('users','roles','postes')->paginate(50);

            $setting = Setting::latest()->first();

            return view('abilities.abilities',compact('setting','abilities'))
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
        if (auth()->user()->cannot('manage-access') && auth()->user()->cannot('create-access')) {

            return redirect()->route('403');
        }
            $request->validate($this->rules);
            $ability = new Ability();
            $ability->name = Str::ucfirst(addslashes($request->name));
            $ability->slug = Str::lower(str_replace(' ','-',addslashes($request->name)));
            $ability->save();

            return back()->with('success','Rôle créé avec succès.');

            return response()->json([
                'message' => "success",
            ],200);
        //}
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
        if (auth()->user()->cannot('manage-access') && auth()->user()->cannot('update-access')) {

            return redirect()->route('403');
        }

        $request->validate($this->rules);

            $ability = Ability::findOrfail($id);
            $ability->name = Str::ucfirst(addslashes($request->name));
            $ability->slug = Str::lower(str_replace(' ','-',addslashes($request->name)));
            $ability->save();

            return back()->with('success','Modification effectué');

            return response()->json([
                'message' => "success",
            ],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->cannot('manage-access') && auth()->user()->cannot('delete-access')) {
            return redirect()->route('403');
        }
        $ability = Ability::findOrfail($id);
        if($ability->users->count()>0){
            return redirect()->route('dashboard.abilities.index')->with('erreurs','Désolé! Vous ne pouvez pas supprimé ce droit d\'accès');
        }
        if($ability->roles->count()>0){
            return redirect()->route('dashboard.abilities.index')->with('erreurs','Désolé! Vous ne pouvez pas supprimé ce droit d\'accès');
        }
        if($ability->postes->count()>0){
            return redirect()->route('dashboard.abilities.index')->with('erreurs','Désolé! Vous ne pouvez pas supprimé ce droit d\'accès');
        }

        $ability->users()->detach();
        $ability->roles()->detach();
        $ability->postes()->detach();
        $ability->delete();

        return redirect()->route('dashboard.abilities.index')->with('success','Opération de suppression réussir');
    }
}
