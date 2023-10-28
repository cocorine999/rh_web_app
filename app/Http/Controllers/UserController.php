<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResetPasswordRequest;
use App\Models\Ability;
use App\Models\Fichier;
use App\Models\Groupe;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Poste;
use App\Models\PosteUser;
use App\Models\Salaire;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\Rules;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    protected $another = [
        'user_poste_id' => 'required|exists:poste_users,id',
        'start_at' => 'required',
    ];

    protected $rules = [
        'last_name' => 'required|string|max:255',
        'first_name' => 'required|string|max:255',
        'salaire' => 'required|sometimes|numeric:5',
        'status_matrimoniale' => 'required|String|max:255',
        'civilite' => 'required|String|max:255',
        'date_naissance' => 'required|String|max:255',
        'postes' => 'required|exists:postes,id',
        'roles' => 'required|exists:roles,id'
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

    public function stopUser(Request $request, $id = null)
    {

        if ($id) {
            $user = User::findOrfail($id);

            foreach ($user->postes->unique()->where('pivot.in_function', true) as $actual_poste) {

                $user_poste = $actual_poste->poste_users->last();

                $user_poste->in_function = false;
                $user_poste->end_at = Carbon::today();
                $user_poste->save();

                $user->salaire = 0;

                $user->save();

                $user->withdrawAll();
            }
        } else {
            $user_poste = PosteUser::where('id', $request->user_poste_id)->where('in_function', true)->first();

            $user_poste->end_at = Carbon::today();

            $user_poste->in_function = false;

            $user_poste->save();

            $user = $user_poste->user;

            $user->salaire -= optional(optional($user_poste->salaires)->last())->montant;

            $user->save();

            $user->abilities()->detach($user_poste->poste->abilities);
        }
        return response()->json([
            'message' =>  'success',
        ]);
    }

    public function startFunctionUser(Request $request)
    {

        $request->validate($this->another);

        $user_poste = PosteUser::findOrfail($request->user_poste_id);

        if ($request->re_start == 'true') {
            if ($user_poste->in_function == true) {
                return response()->json([
                    'message' => "errors",
                    'errors' => [
                        'end_at' => ['Opération non authorisé ']
                    ],
                ], 401);
            }

            $last_poste = PosteUser::create([
                "user_id" => $user_poste->user->id,
                "poste_id" => $user_poste->poste->id,
                "start_at" => $request->start_at,
                "end_at" => $request->end_at,
                "in_function" => true,
            ]);

            $user = $last_poste->user;

            $user->salaire += $last_poste->poste->salaire;

            $user->save();

            $user->abilities()->attach($last_poste->poste->abilities->pluck('id'));

            Salaire::create([
                'montant' => $last_poste->poste->salaire,
                'poste_user_id' => $last_poste->id,
                'motif' => 'Default',
            ]);
        } else {
            if ($user_poste->start_at != null) {
                return response()->json([
                    'message' => "errors",
                    'errors' => [
                        'end_at' => ['Opération non authorisé ']
                    ],
                ], 401);
            }

            $user_poste->start_at = $request->start_at;
            $user_poste->end_at = $request->end_at;
            $user_poste->in_function = true;
            $user_poste->save();
        }

        return response()->json([
            'message' =>  'success',
        ]);
    }

    public function retrievePermission(Request $request, $id)
    {

        $user = User::findOrfail($id);

        $user->abilities()->detach($request->id);

        return response()->json([
            'message' =>  'success',
        ]);
    }

    public function index()
    {
        if (auth()->user()->cannot('manage-users') && auth()->user()->cannot('view-users')) {
            return redirect()->route('403');
        }

        $users = User::latest()->with('postes', 'user_actual_poste', 'roles', 'abilities', 'roles.abilities', 'postes.abilities')->paginate(50);

        $roles = Role::with('abilities')->get();

        $postes = Poste::with('abilities')->get();

        $abilities = Ability::with('postes', 'roles')->get();

        $setting = Setting::latest()->first();

        return view('users.users', compact('setting','users', 'postes', 'roles', 'abilities'))
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

        if (auth()->user()->cannot('manage-users') && auth()->user()->cannot('create-users')) {
            return redirect()->route('403');
        }

        $this->rules['email'] = 'required|email|max:255|unique:users';
        $this->rules['telephone'] = 'required|numeric:12|unique:users';

        $request->validate($this->rules);

        $user = new User();

        $user->last_name = Str::upper(addslashes($request->last_name));

        $user->first_name = Str::ucfirst(addslashes($request->first_name));

        $user->telephone = $request->telephone;

        $user->civilite = $request->civilite;

        $user->status_matrimoniale = $request->status_matrimoniale;

        $user->date_naissance = $request->date_naissance;

        $user->email = $request->email;

        $user->password = Hash::make($request['telephone']);

        $user->save();

        $user->roles()->attach($request->roles);

        $user->postes()->attach($request->postes);

        foreach ($user->postes as $key => $value) {
            $user->abilities()->attach($value->abilities->pluck('id'));
        }

        foreach ($user->roles as $key => $value) {
            $user->abilities()->attach($value->abilities->pluck('id'));
        }

        foreach ($user->poste_users as $key => $user_poste) {
            $user->salaire += $user_poste->poste->salaire;
            $user_poste->in_function = true;
            $user_poste->save();
            Salaire::create([
                'montant' => $user_poste->poste->salaire,
                'poste_user_id' => $user_poste->id,
                'motif' => 'Default',
            ]);
        }

        $user->save();

        if ($request->ajax()) {
            return response()->json([
                'status' => "success",
                'message' => "Utilisateur créé avec succès.",
            ]);
        }

        return back()->with('success', 'Utilisateur créé avec succès.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        if (auth()->user()->cannot('manage-users') && auth()->user()->cannot('view-users')) {
            return redirect()->route('403');
        }

        $user = User::where('id',$id)->with('presences','permissions')->first();

        $salaires = Salaire::whereIn('poste_user_id', $user->poste_users->pluck('id'))->orderBy('created_at', 'desc')->limit('6')->get();

        $abilities = $user->abilities;

        /*
        foreach ($user->abilities as $ability) {
            array_push($abilities,$ability);
        }


        foreach ($user->roles as $role) {

            foreach ($role->abilities as $key => $ability) {
                array_push($abilities,$ability);
            }
        }

        foreach ($user->postes as $poste) {

            foreach ($poste->abilities as $key => $ability) {
                array_push($abilities,$ability);
            }
        }
 */

        $roles = Role::with('abilities')->get();

        $postes = Poste::with('abilities')->get();

        $abilities = Ability::with('postes', 'roles')->get();

        $setting = Setting::latest()->first();

        return view('users.read', compact('setting','user', 'abilities', 'postes','roles',  'salaires'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrfail($id);
        return redirect()->route('dashboard.users.index')->with('success', 'Utilisateur updated successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function resetProfil(Request $request)
    {

        $request->validate(['profile' => 'required|mimes:png,jpeg,jpg,svg,webp|max:2048']);

        if (isset($request->files) && $request->file('profile')) {
            $user = User::findOrfail($request->id);
            $photoProfile = $request->file('profile');

                $file =  $user->profile;

                $filename = uniqid('profile_', true) . Str::random(10) . '.' . time() . $user->id . $photoProfile->getClientOriginalName();
                $path = $photoProfile->move('users/photo_profil/', $filename);
                $fichier = new Fichier([
                    'name' => $filename,
                    'url' => $path,
                ]);

                $user->profile()->save($fichier);

                $user->save();

                $path = public_path().'/'.optional($file)->url;

                if(\File::exists($path)){
                    \File::delete($path);
                }

                optional($file)->delete();
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => "success",
                'message' => "Mise à  jour éffectué.",
            ]);
        }

        return back()->with('success', 'Mise à  jour éffectué');
    }

    public function resetPassword(ResetPasswordRequest $request){
//
        $user = Auth::user();

        if (!(Hash::check($request->current_password, $user->password))) {
            return back()->withErrors('Mot de passe actuel incorrect');
        }

        if ((Hash::check($request->password, $user->password))) {
            return back()->withErrors('Veuillez utiliser un mot de passe autre que le mot de passe actuel');
        }

        $user->password = Hash::make($request['password']);

        $user->save();

        return back()->withSuccess('Mise à jour éffectué');


    }

    public function update(Request $request, $id)
    {



        if (auth()->user()->cannot('manage-users') && auth()->user()->cannot('update-users')) {
            return redirect()->route('403');
        }

        $this->rules['email'] = 'required|email|max:255|exists:users,email';
        $this->rules['telephone'] = 'required|numeric:12|exists:users,telephone';
        $this->rules['postes'] = 'sometimes|exists:postes,id';
        $this->rules['roles'] = 'sometimes|exists:roles,id';

        $request->validate($this->rules);

        $user = User::findOrfail($id);

        $user->last_name = Str::upper(addslashes($request->last_name));

        $user->first_name = Str::ucfirst(addslashes($request->first_name));

        $user->telephone = $request->telephone;

        $user->civilite = $request->civilite;

        $user->status_matrimoniale = $request->status_matrimoniale;

        $user->date_naissance = $request->date_naissance;

        $user->email = $request->email;

        $user->save();

        if (isset($request->roles)) {

            if (count($user->roles) > 0) {
                $user->roles()->sync($request->roles);
            } else {
                $user->roles()->attach($request->roles);
            }
        }

        if (isset($request->postes)) {

            if (count($user->postes->unique()) > 0) {

                foreach ($request->postes as $poste) {

                    if (!$user->user_actual_poste->contains('id', $poste)) {

                        $user->postes()->attach($poste);

                        $user_poste = $user->poste_users->last();

                        $user_poste->start_at = Carbon::today();

                        $user_poste->end_at = null;

                        $user_poste->in_function = true;

                        $user_poste->save();

                        Salaire::create([
                            'montant' => $user_poste->poste->salaire,
                            'poste_user_id' => $user_poste->id,
                            'motif' => 'Default',
                        ]);

                        $user->salaire += $user_poste->poste->salaire;

                        $user->save();
                    }
                }

                foreach ($user->user_actual_poste->unique() as $poste) {

                    if (in_array($poste->id, $request->postes) == false) {

                        $user_poste = PosteUser::where('poste_id', $poste->id)->where('in_function', true)->first();

                        if ($user_poste) {
                            $user_poste->end_at = Carbon::today();

                            $user_poste->in_function = false;

                            $user_poste->save();

                            $user->salaire -= $user_poste->salaires->last()->montant;

                            $user->save();
                        }
                    }
                }

                //$user->user_actual_poste()->sync($request->postes);
            } else {
                $user->postes()->attach($request->postes);
            }
        }

        /*
            $new_postes = $user->poste_users->whereNotIn('poste_id',$user->postes->pluck('id'));

            foreach ($new_postes as $key => $new_poste) {
                $user->salaire +=$new_poste->poste->salaire;
                Salaire::create([
                    'montant' => $new_poste->poste->salaire,
                    'poste_user_id' => $new_poste->id,
                    'motif' => 'Default',
                ]);
            }
            $user->save();
        */



        /* foreach ($request->abilities as $key => $request_ability) {
            if($user->hasAbilityThroughPosteOrRole($request_ability) == false){
                array_push($abilities,$request_ability);
            }
        }*/

        if (isset($request->abilities)) {

            $user->abilities()->sync($request->abilities);
        }

        if (isset($request->files) && $request->file('profile')) {
            $user = User::findOrfail($id);
            $photoProfile = $request->file('profile');

                $file =  $user->profile;

                $filename = uniqid('profile_', true) . Str::random(10) . '.' . time() . $user->id . $photoProfile->getClientOriginalName();
                $path = $photoProfile->move('users/photo_profil/', $filename);
                $fichier = new Fichier([
                    'name' => $filename,
                    'url' => $path,
                ]);

                $user->profile()->save($fichier);

                $user->save();

                $path = public_path().'/'.optional($file)->url;

                if(\File::exists($path)){
                    \File::delete($path);
                }

                optional($file)->delete();
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => "success",
                'message' => "Utilisateur mis à jour avec succès.",
            ]);
        }

        return back()->with('success', 'Utilisateur mis à jour avec succès');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->cannot('manage-users') && auth()->user()->cannot('delete-users')) {
            return redirect()->route('403');
        }

        $user = User::findOrfail($id);

        /* if($user->presences->count()>0){
            return redirect()->route('dashboard.users.index')->with('errors','Désolé! Vous ne pouvez pas supprimé ce user');
        }

        if($user->permissions->count()>0){
            return redirect()->route('dashboard.users.index')->with('errors','Désolé! Vous ne pouvez pas supprimé ce user');
        }

        if($user->rapports->count()>0){
            return redirect()->route('dashboard.users.index')->with('errors','Désolé! Vous ne pouvez pas supprimé ce user');
        }

        if($user->rendez_vous->count()>0){
            return redirect()->route('dashboard.users.index')->with('errors','Désolé! Vous ne pouvez pas supprimé ce user');
        }

        foreach ($user->poste_users as $key => $poste_user) {
            if(count($poste_user->paiements) > 0){
                return redirect()->route('dashboard.users.index')->withErrors('Désolé! Vous ne pouvez pas supprimé ce user');
            }
        }

        foreach ($user->poste_users as $key => $poste_user) {
            if(count($poste_user->paiements) > 0){
                return redirect()->route('dashboard.users.index')->withErrors('Désolé! Vous ne pouvez pas supprimé ce user');
            }
        } */

        /* $user->postes()->detach();

        $user->roles()->detach();

        $user->withdrawAll(); */

        $file = $user->profile;

        $user->delete();

        if (optional($file)->url) {

            $path = public_path() . "/" . optional($file)->url;

            if (\File::exists($path)) {
                \File::delete($path);
            }

            optional($file)->delete();
        }

        return response()->json([

            'status' =>  'success',

            'message' =>  'Utilisateur supprimé avec succès',

        ]);

        return redirect()->route('dashboard.users.index')->with('success', 'Utilisateur supprimé avec succès');
    }

    // CUSTOM FUNCTION

    // load unread notifications
    public function getNotifications()
    {
        /* return response()->json([
            'message' => "success",
            'data' => auth()->user()->unreadNotifications,
        ]);

        return response(auth()->user()->unreadNotifications);
        return auth()->user()->unreadNotifications; */
        return auth()->user()->unreadNotifications()->limit(5)->get()->toArray();
    }

    public function profile($id=null)
    {
        if($id){
            $user = User::findOrfail($id);
        }
        else{
            $user = auth()->user();
        }
        $setting = Setting::latest()->first();

        return view('profile',compact('setting','user'));
    }

    public function inbox()
    {
        //dd(Groupe::with('users','illustration','funder','last_message')->get());
        $conversations = auth()->user()->conversations;

        $users = User::all();

        $setting = Setting::latest()->first();

        return view('conversations.inbox',compact('setting','conversations','users'));
    }

    public function notifications()
    {

        $setting = Setting::latest()->first();
        $notifications = auth()->user()->notifications()->paginate('100');
        return view('notifications', compact('setting','notifications'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchUser(Request $request)
    {

        $users = User::latest()->get();

        $searchUsers = [];

        $response = [];

        if (isset($request->filter_postes) && count($request->filter_postes) > 0) {

            foreach ($request->filter_postes as $key => $value) {

                $poste = Poste::findOrfail(intval($value));

                if ($poste) {
                    foreach ($poste->users_on_function->load('abilities') as $key => $value) {
                        array_push($searchUsers, $value);
                    }
                }
            }
            $response = collect($searchUsers)->unique('id');
        }

        if ($request->searchValue != "") {
            if (count($response) == 0) $response = $users;

            $searchUsers = User::whereIn('id', $response->pluck('id'))
                ->where('first_name', "like", "%" . Str::ucfirst(addslashes($request->searchValue)) . "%")
                ->orWhere('last_name', "like", "%" . Str::upper(addslashes($request->searchValue)) . "%")
                ->orWhere('telephone', $request->searchValue)
                ->orWhere('email', $request->searchValue)->orderBy('created_at', 'DESC')->get();

            $response = collect($searchUsers)->unique('id');
        }

        if (count($response) == 0) $response = $users;

        $output = "<table class='js-table-checkable table table-hover table-vcenter js-table-checkable-enabled'>
        <thead>
            <tr>
                <th class='text-center' style='width: 70px;'>
                    <div class='form-check d-inline-block'>
                        <input class='form-check-input' type='checkbox' value='' id='check-all'
                            name='check-all'>
                        <label class='form-check-label' for='check-all'></label>
                    </div>
                </th>
                <th>Nom & Prénom</th>
                <th>Date naissance</th>
                <th>Contact</th>
                <th>Poste</th>
                <th>Salaire</th>
                <th class='d-none d-sm-table-cell text-center' style='width: 20%;'>Action</th>
            </tr>
        </thead>
        <tbody id='table-content'>";

        if (count($response) > 0) {
            foreach (collect($response)->unique('id') as $key => $value) {
                $output .= "
            <tr>
                <td class='text-center'>
                    <div class='form-check d-inline-block'>
                        <input class='form-check-input' type='checkbox' value='userID-{{$value->id}}' id='userID-{{$value->id}}' name=''>
                        <label class='form-check-label' for='userID-{{$value->id}}'></label>
                    </div>
                </td>

                <td class='fs-sm'>
                    <p class='fw-semibold mb-1'>
                        <a>" . Str::ucfirst($value->civilite) . "
                            " . str_replace('\\', '', $value->last_name) . "
                            " . str_replace('\\', '', $value->first_name) . "</a>
                    </p>
                </td>

                <td class='fs-sm'>
                    <p class='fw-semibold mb-1'>
                        <a>" . $value->date_naissance . "</a>
                    </p>
                </td>

                <td class='fs-sm'>
                    <p class='fw-semibold mb-1'>
                        <a>" . $value->telephone . "</a>
                    </p>
                    <p class='text-muted mb-0'>
                        " . $value->email . "
                    </p>
                </td>

                <td class='d-none d-sm-table-cell text-center'>
                    <span
                        class='fs-xs fw-semibold d-inline-block py-1 px-3 rounded-pill bg-success-light text-success'>
                         " . Str::upper(optional(optional(optional($value)->user_actual_poste)->last())->name) . "

                    </span>
                </td>
                <td class='d-none d-sm-table-cell text-center'>
                    <p class='fw-semibold mb-1'>
                        <a> " . $value->salaire . "</a>
                    </p>
                </td>
                <td class='text-center'>
                    <div class='btn-group'>";

                if (auth()->user()->canany(['manage-users', 'view-users'])) {
                    $output .= "<a type='button' id='viewRapport'
                            href='" . route('dashboard.users.show', $value->id) . "'
                            class='btn btn-sm btn-alt-secondary js-bs-tooltip-enabled'
                                    data-bs-toggle='tooltip' title='Consulter'
                                    data-bs-original-title='Edit Rapport'><i class='fa fa-fw fa-eye'></i>
                        </a>";
                }

                if (auth()->user()->canany(['manage-users', 'update-users'])) {
                    $output .= "
                <a type='submit' id='editUser' data-bs-toggle='modal' data-bs-target='#app-modal' data-backdrop='static' data-keyboard='false'
                onclick=\"

                    event.preventDefault();
                    console.log('edit');
                    $('#app-modal-form')[0].reset();
                    $('#user-last-name').val('$value->last_name');
                    $('#user-first-name').val('$value->first_name');
                    $('#user-civilite').val('$value->civilite');
                    $('#user-date-naissance').val('$value->date_naissance');
                    $('#user-email').val('$value->email');
                    $('#user-telephone').val($value->telephone);
                    $('#user-status-matrimoniale').val('$value->status_matrimoniale');
                    $('#user-civilite').val('$value->civilite');
                    $('#user-date-naissance').val('$value->date_naissance');

                    document.getElementById('abilities-section').style.display = 'block';

                    window.User =  " . str_replace('"', '\'', $value) . ";


                    var data =  " . $value->abilities->pluck('id') . ";

                    for (var i = 0; i < data.length; i++) {
                        document.getElementById('user-abilities-'+data[i]).checked = true;
                    }

                    var data = " . $value->roles->pluck('id') . " ;

                    for (var i = 0; i < data.length; i++) {
                        document.getElementById('user-roles-'+data[i]).selected = true;
                    }

                    var data = " . $value->postes->where('pivot.in_function', true)->pluck('id') . ";

                    for (var i = 0; i < data.length; i++) {
                        document.getElementById('user-postes-'+data[i]).selected = true;
                    }

                    document.getElementById('app-modal-form').setAttribute('action','" . route('dashboard.users.update', $value->id) . "');

                \" class='btn btn-sm btn-alt-secondary js-bs-tooltip-enabled'
                data-bs-toggle='tooltip' title='' data-bs-original-title='Edit User'
                    >

                <i class='fa fa-fw fa-pencil-alt'></i>
            </a>";
                }

                if (auth()->user()->canany(['manage-users', 'delete-users'])) {
                    $output .=
                            "<button
                            onclick=\" event.preventDefault(); window.request = '" . route('dashboard.users.destroy', $value->id) . "'; deleteUser()\"
                            class='btn btn-sm btn-alt-secondary js-bs-tooltip-enabled'
                            data-bs-toggle='tooltip' title='' data-bs-original-title='Remove Client'>
                            <i class='fa fa-fw fa-times'></i>
                        </button>";
                }

                $output .= "
                                </div>
                            </td>
                        </tr>";
            }
        } else {
            $output .= "<tr class='table-active'>
                <td class='text-center' colspan='7'>
                    <span class='h4 fw-medium'>AUCUN UTILISATEUR</span>
                </td>
            </tr>";
        }
        $output .= "</tbody>
                    </table>
                ";

        return response()->json([
            'message' =>  'success',
            'data'  => count($response) == 0 ? [] : collect($response)->unique('id'),
            'output'  => $output,
        ]);
    }

    public function joinPieces(Request $request, $id)
    {


        $request->validate([
            'pieces' => 'required|mimes:csv,png,jpeg,jpg,txt,xlx,xls,pdf,docx,doc,zip|max:2048'
        ]);

        if (isset($request->files)) {

            $user = User::where('id',$id)->first();

            foreach ($request->files as $piece) {


                $filename = uniqid('pieces_', true) . Str::random(10) . '.' . time() . Auth::id() . $piece->getClientOriginalName();
                $path = $piece->move('users/pieces/', $filename);
                $fichier = new Fichier([
                    'name' => $filename,
                    'url' => $path,
                ]);
                $user->pieces()->save($fichier);
            }

            $output = '';
            foreach ($user->pieces as $key => $file) {
                $output .=
                    "<div class='col-md-6 col-lg-4 col-xl-3 animated fadeIn'>
                    <a class='img-link img-link-zoom-in img-thumb img-lightbox' href='" . asset($file->url) . "'> <embed class='img-fluid' href='" . asset($file->url) . "' src='" . asset($file->url) . "' alt='" . asset($file->name) . "'>
                    </a>
                </div>";
            }
            if ($request['ajax']) {
                return response()->json([
                    'message' =>  'success',
                    'data'  => $user->pieces,
                    'output'  => $output,
                ]);
            }
            else{
                return redirect()->route('dashboard.users.show',$user->id)->with('success','Piece ajouté');
            }
        }

        return response()->json([
            'message' => "Errors",
        ], 500);
    }
}
