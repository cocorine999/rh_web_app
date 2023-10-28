<?php

namespace App\Http\Controllers;

use App\Jobs\PermissionRequestActionJob;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Permission;
use App\Models\Poste;
use App\Models\Role;
use App\Models\Setting;
use App\Notifications\NewPermission;
use App\Notifications\NewPermissionNotification;
use App\Notifications\ValidatePermissionNotification;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermissionController extends Controller
{

    protected $rules = [
        'motif' => 'required|string|max:255',
        'description' => 'required',
        'start_at' => 'required',
        'end_at' => 'required',
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

        if (auth()->user()->cannot('manage-permissions') && auth()->user()->cannot('view-permissions')) {
            return redirect()->route('403');
        }

        //Check if user is authorize
        if (auth()->user()->can('viewAll',Permission::class) )
        {
            $permissions = Permission::latest()->with('user')->paginate(20);
        }else{
            $permissions = Permission::where('user_id',Auth::id())->latest()->with('user')->paginate(20);
        }
        $users = User::all();

        $setting = Setting::latest()->first();

        return view('permissions.permissions',compact('setting','permissions','users'))
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



        if (auth()->user()->cannot('manage-permissions') && auth()->user()->cannot('create-permissions')) {
            return redirect()->route('403');
        }
            $request->validate($this->rules);
            $permission = new Permission();
            $permission->motif = Str::ucfirst(addslashes($request->motif));
            $permission->description = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->description)));
            $permission->start_at = $request->start_at;
            $permission->end_at = $request->end_at;
            $permission->is_accept = 2;
            $permission->is_conge = $request->is_conge == 'true' ? 1 : 0;
            $permission->user_id = $request->user_id ?? Auth::id();
            $permission->save();

            $role = Role::where('name','like',"%Admin%")->where('name','not like',"%Employé%")->where('name','not like',"%Stagiaire%")->first();

            $poste = Poste::where('name','like',"%RH%")->first();

            $users = collect($role->users)->merge(collect($poste->users));

            foreach ($users as $user) {
                dispatch(new PermissionRequestActionJob($user,$permission,2));
            }

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
        $permission = Permission::findOrfail($id);

        if (auth()->user()->cannot('manage-permissions') && auth()->user()->cannot('view-permissions')) {
            return redirect()->route('403');
        }

        $this->authorize('view', $permission);

        $setting = Setting::latest()->first();

        return view('permissions.details',compact('setting'))->with('permission',$permission);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $permission = Permission::findOrfail($id);
        //Check if user is authorize
        $this->authorize('update', $permission);
        return redirect()->route('dashboard.permissions.index')->with('success','Rôle updated successfully');
        return view('permissions.permissions')->with('permission',$permission);
    }

    /**
     * VALIDER the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function VALIDER(Request $request, $id)
    {

        if (auth()->user()->cannot('validate-permissions')) {
            return redirect()->route('403');
        }
            $permission = Permission::findOrfail($id);
            $permission->is_accept = 1;
            $permission->save();
            $user = User::findOrfail($permission->user_id);
            dispatch(new PermissionRequestActionJob($user,$permission,1));
            return back()->with('success','Permission accordée');
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

        if (auth()->user()->cannot('validate-permissions')) {
            return redirect()->route('403');
        }
            //$request->validate($this->rules);
            $permission = Permission::findOrfail($id);
            $permission->is_accept = -1;
            $permission->save();
            $user = User::findOrfail($permission->user_id);
            dispatch(new PermissionRequestActionJob($user,$permission,-1));
            return back()->with('success','Permission rejetée');

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
        if (auth()->user()->cannot('manage-permissions') && auth()->user()->cannot('update-permissions')) {
            return redirect()->route('403');
        }
            $request->validate($this->rules);
            $permission = Permission::findOrfail($id);
            $this->authorize('update', $permission);
            $permission->motif = Str::ucfirst(addslashes($request->motif));
            $permission->description = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->description)));
            $permission->start_at = $request->start_at;
            $permission->end_at = $request->end_at;
            $permission->is_conge = $request->is_conge == 'true' ? 1 : 0;
            $permission->user_id = $request->user_id ?? Auth::id();
            $permission->save();
            return back()->with('success','Mise à jour éffectué');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->cannot('manage-permissions') && auth()->user()->cannot('delete-permissions')) {
            return redirect()->route('403');
        }
        $permission = Permission::findOrfail($id);
        $this->authorize('delete', $permission);
        $permission->delete();
        return redirect()->route('dashboard.permissions.index')->with('success','Suppression réussie');

    }

    // CUSTOM FUNCTION


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchPermission(Request $request)
    {
        $permissions = Permission::where('name',"%LIKE%",$request->searchValue)->loadCount('users')->sortByDesc('created_at');
        return back()->with('success','Nouvelle sortie');

    }
}
