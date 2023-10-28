<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Poste;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class PosteController extends Controller
{
    protected $rules = [
        'name' => 'required|string|max:255',
        'salaire' => 'required|string|max:255'
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
        if (auth()->user()->cannot('manage-postes') && auth()->user()->cannot('view-postes')) {

            return redirect()->route('403');
        }
        $postes = Poste::latest()->withCount('users','abilities')->paginate(50);

        $abilities = Ability::all();

        $setting = Setting::latest()->first();

        return view('postes.postes',compact('setting','postes','abilities'))
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
        if (auth()->user()->cannot('manage-postes') && auth()->user()->cannot('create-postes')) {

            return redirect()->route('403');
        }
        $request->validate($this->rules);

            $poste = new Poste();
            $poste->name = Str::ucfirst(addslashes($request->name));
            $poste->salaire = str_replace('.', '', str_replace(',', '', str_replace(' ', '', $request->salaire)));
            $poste->save();
            $poste->abilities()->attach($request->abilities);

            return back()->with('success','Poste créé avec succès.');

            return response()->json([
                'message' => "success",
            ],200);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->cannot('manage-postes') && auth()->user()->cannot('view-postes')) {
            return redirect()->route('403');
        }

        $poste = Poste::findOrfail($id);

        return view('postes.postes')->with('poste',$poste);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->cannot('manage-postes') && auth()->user()->cannot('update-postes')) {

            return redirect()->route('403');
        }

        $poste = Poste::findOrfail($id);

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
        if (auth()->user()->cannot('manage-postes') && auth()->user()->cannot('update-postes')) {

            return redirect()->route('403');
        }
            $request->validate($this->rules);

            $poste = Poste::findOrfail($id);

            $poste->name = Str::ucfirst(addslashes($request->name));
            $poste->salaire = str_replace('.', '', str_replace(',', '', str_replace(' ', '', $request->salaire)));
            $poste->save();
            $poste->abilities()->sync($request->abilities);

            return back()->with('success','Poste mis à jour avec succès');
            return redirect()->route('dashboard.postes.index')->with('success','Product updated successfully');

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
        if (auth()->user()->cannot('manage-postes') && auth()->user()->cannot('delete-postes')) {

            return redirect()->route('403');
        }
        $poste = Poste::findOrfail($id);
        if($poste->users->count()>0){
            return redirect()->route('dashboard.postes.index')->with('erreurs','Désolé! Vous ne pouvez pas supprimé ce poste');
        }
        $poste->abilities()->detach();
        $poste->users()->detach();
        $poste->delete();
        return redirect()->route('dashboard.postes.index')->with('success','Poste supprimé avec succès');
    }

    // CUSTOM FUNCTION


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchPoste(Request $request)
    {
        $postes = Poste::where('name',"%LIKE%",$request->searchValue)->loadCount('users')->sortByDesc('created_at');
        return view('postes.postes')->with('postes',$postes);
    }
}
