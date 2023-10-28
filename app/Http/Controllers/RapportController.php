<?php

namespace App\Http\Controllers;

use App\Jobs\ReportNotificationJob;
use Illuminate\Http\File;
use App\Models\Fichier;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Rapport;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RapportController extends Controller
{

    protected $rules = [
        'libelle' => 'required|string|max:255',
        'description' => 'required',
        'date' => 'required',
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
        if (auth()->user()->cannot('manage-reports')) {

            return redirect()->route('403');
        }

        if (auth()->user()->can('view-all-reports',Rapport::class))
        {
            $rapports = Rapport::latest()->with('user','files')->paginate(20);
        }else{
            $rapports = Rapport::where('user_id',Auth::id())->latest()->with('user','files')->paginate(20);
        }

        $setting = Setting::latest()->first();

        return view('rapports.rapports',compact('setting','rapports'))
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
        if (auth()->user()->cannot('manage-reports')) {

            return redirect()->route('403');
        }
            $request->validate($this->rules);
            $rapport = new Rapport();
            $rapport->libelle = Str::ucfirst(addslashes($request->libelle));
            $rapport->description = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->description)));
            $rapport->date = $request->date;
            $rapport->user_id = Auth::id();
            $rapport->save();
            if(isset($request->files)){
                if($request->fichiers){
                    foreach ($request->fichiers as $fichier) {
                        $filename = uniqid('rapports_',true).Str::random(10).'.'. $rapport->id.time().Auth::id().$fichier->getClientOriginalName();
                        $path = $fichier->move('images/rapports/', $filename);
                        $fichier = new Fichier([
                        'name'=> $filename,
                        'url' => $path,
                        ]);
                        $rapport->files()->save($fichier);
                    }
                }
            }

            $role = Role::where('name','like',"%Admin%")->where('name','not like',"%Employé%")->where('name','not like',"%Stagiaire%")->first();

            foreach ($role->users as $user) {
                //dispatch(new ReportNotificationJob($user,$rapport,2));
            }

            return back()->with('success','Votre rapport a bien été soumis.');
    }

    public function addFiles(Request $request){

        $request->validate([
            'file' => 'required|mimes:csv,png,jpeg,jpg,txt,xlx,xls,pdf,docx,doc,zip|max:2048'
        ]);
        return response()->json([
            'message' => "success",
            'data' => $request->file('file')
        ],401);
        $array = [];
        if(isset($request->files)){
            if($request->fichiers){
                foreach ($request->fichiers as $fichier) {
                    $filename = uniqid('rapports_',true).Str::random(10).'.'.time().Auth::id().$fichier->getClientOriginalName();
                    $path = $fichier->move('images/rapports/', $filename);
                    $fichier = new Fichier([
                    'name'=> $filename,
                    'url' => $path,
                    ]);
                    array_push($array,$fichier);
                }
            }
        }
        return response()->json([
            'message' => "success",
            'data' => $array
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
        if (auth()->user()->cannot('manage-reports')) {
            return redirect()->route('403');
        }

        $rapport = Rapport::findOrfail($id);

        if (auth()->user()->cannot('view', $rapport)){
            return redirect()->route('403');
        }

        $setting = Setting::latest()->first();

        return view('rapports.read',compact('setting','rapport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Rapport::findOrfail($id);
        return redirect()->route('dashboard.rapports.index')->with('success','Rôle updated successfully');
    }

    public function EFFECTUER(Request $request, $id)
    {

            //$request->validate($this->rules);
            $rapport = Rapport::findOrfail($id);
            $rapport->status = 1;
            $rapport->save();
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
        if (auth()->user()->cannot('manage-reports')) {

            return redirect()->route('403');
        }
            $request->validate($this->rules);

            $rapport = Rapport::findOrfail($id);
            $this->authorize('update', $rapport);
            $rapport->libelle = Str::ucfirst(addslashes($request->libelle));
            $rapport->description = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->description)));
            $rapport->date = $request->date;
            $rapport->save();
            if(isset($request->files)){
                if($request->fichiers){
                foreach ($request->fichiers as $fichier) {
                    $filename = uniqid('rapports_',true).Str::random(10).'.'. $rapport->id.time().Auth::id().$fichier->getClientOriginalName();
                    $path = $fichier->move('images/rapports/', $filename);
                    $fichier = new Fichier([
                      'name'=> $filename,
                      'url' => $path,
                    ]);
                    $rapport->files()->save($fichier);
                }}
            }
            if($request->ajax()){
                return response()->json([
                    'message' => "success",
                ],200);
            }

            return back()->with('success','Votre rapport vient d\'être modifié et a été de nouveau soumis.');

    }

    public function deleteFiles(Request $request){

        $fichier = Fichier::findOrfail($request->id);

        $rapport = Rapport::findOrfail($fichier->filable_id);

        if($fichier){
            $path = public_path().'/'.$fichier->url;

            if(\File::exists($path)){
                \File::delete($path);
            }

            $fichier->delete();
            $output = '';
            foreach ($rapport->files as $key => $file) {
                $output .= "
                <div class='col-md-6 col-lg-4 col-xl-3 animated fadeIn'>
                    <div class='options-container fx-item-rotate-r'>
                        <embed class='img-fluid options-item' src='".asset($file->url)."' alt=''>
                        <div class='options-overlay bg-black-75'>
                            <div class='options-overlay-content'>
                                <h3 class='h4 fw-normal text-white mb-1'>Image Caption</h3>
                                <h4 class='h6 fw-normal text-white-75 mb-3'>Some extra info</h4>
                                <a class='btn btn-sm btn-primary img-lightbox'
                                    href='". asset($file->url) ."'>
                                    <i class='fa fa-search-plus me-1'></i> View
                                </a>

                                <a class='btn btn-sm btn-secondary' href='javascript:void(0)'
                                    onclick=\"event.preventDefault(); deleteFiles($file->id);\">
                                    <i class='fa fa-times-alt me-1'></i> Supprimer
                                </a>
                            </div>
                        </div>
                    </div>
                </div>";
            }

            return response()->json([
                'message' => "success",
                'output' => $output,
            ],200);
        }
        return response()->json([
            'message' => "Errors",
        ],500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (auth()->user()->cannot('manage-reports')) {

            return redirect()->route('403');
        }
        $rapport = Rapport::findOrfail($id);
        $this->authorize('delete', $rapport);
        $fichiers =$rapport->files;

        foreach ($fichiers as $fichier) {
             $path = public_path()."/".$fichier->url;
            if(\File::exists($path)){
                \File::delete($path);
            }

            $fichier->delete();
        }
        $rapport->delete();
        return redirect()->route('dashboard.rapports.index')->with('success','Rendez-vous supprimé avec succès');

    }

    // CUSTOM FUNCTION


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function searchRapport(Request $request)
    {
        $rapport = Rapport::where('libe',"LIKE","%{{ $request->searchValue }}%")->loadCount('user')->sortByDesc('created_at');
        return back()->with('success','Nouvelle sortie');

    }
}
