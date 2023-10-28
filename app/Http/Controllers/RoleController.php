<?php

namespace App\Http\Controllers;

use App\Models\Ability;
use App\Models\Role;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RoleController extends Controller
{

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
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (auth()->user()->can('manage-roles') || auth()->user()->can('view-roles')) {
            $roles = Role::latest()->withCount('users','abilities')->paginate(50);

            $abilities = Ability::all();
            $setting = Setting::latest()->first();

            return view('roles.roles',compact('setting','roles','abilities'))
                ->with('i', (request()->input('page', 1) - 1) * 5);
        }
        return redirect()->route('403');
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
        if (auth()->user()->can('manage-roles') || auth()->user()->can('create-roles')) {
            $request->validate($this->rules);
            $role = new Role();
            $role->name = Str::ucfirst(addslashes($request->name));
            $role->slug = "slug-" . Str::lower(addslashes($request->name));
            $role->save();
            $role->abilities()->attach($request->abilities);
            return back()->with('success','Rôle créé avec succès.');
        }
        return redirect()->route('403');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (auth()->user()->can('manage-roles') || auth()->user()->can('view-roles')) {
            $role = Role::findOrfail($id);
            //$this->authorize('view', $role);
            return view('roles.read')->with('role',$role);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrfail($id);
        return redirect()->route('dashboard.roles.index')->with('success','Rôle updated successfully');
        return view('roles.roles')->with('role',$role);
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

        if (auth()->user()->can('manage-roles') || auth()->user()->can('update-roles')) {
            $request->validate($this->rules);

            $role = Role::findOrfail($id);
            $role->name = Str::ucfirst(addslashes($request->name));
            $role->slug = "slug-" . Str::lower(addslashes($request->name));
            $role->save();
            $role->abilities()->sync($request->abilities);

            return back()->with('success','Rôle mis à jour avec succès');
            return redirect()->route('dashboard.roles.index')->with('success','Product updated successfully');

            return response()->json([
                'message' => "success",
            ],200);
        }
        return redirect()->route('403');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->cannot('manage-roles') && auth()->user()->cannot('delete-roles')) {

            return redirect()->route('403');
        }
        $role = Role::findOrfail($id);

        if($role->users->count()>0){
            return redirect()->route('dashboard.roles.index')->with('erreurs','Désolé! Vous ne pouvez pas supprimé ce role');
        }

        $role->users()->detach();
        $role->abilities()->detach();
        $role->delete();

        return redirect()->route('dashboard.roles.index')->with('success','Role supprimé avec succès');
        return route('dashboard.roles.index');
    }

    // CUSTOM FUNCTION


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchRole(Request $request)
    {
        $roles = Role::where('name',"%LIKE%",$request->searchValue)->loadCount('users')->sortByDesc('created_at');
        return view('roles.roles')->with('roles',$roles);
    }
}
