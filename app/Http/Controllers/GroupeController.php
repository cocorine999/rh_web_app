<?php

namespace App\Http\Controllers;

use App\Http\Requests\GroupeRequest;
use App\Models\Fichier;
use App\Models\Groupe;
use App\Models\Traffic;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class GroupeController extends Controller
{

    protected $groupe;

    protected $rules = [

        "name" => 'required|max:255',

        "description" => 'sometimes',

        "group_members" => 'required',

        "illustration" => 'sometimes|mimes:png,jpeg,jpg,svg,webp|max:2048',
    ];

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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate($this->rules);

        $this->groupe = new Groupe();

        if($this->groupe){
            $request['owner'] = auth()->id();

            $request['type'] = 'group';

            $request['name'] = Str::ucfirst(addslashes($request->name));

            $request['description'] = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->description)));

            $this->groupe->fill($request->all());

            $this->groupe->save();

            $this->groupe->users()->attach(auth()->id(),[
                'is_admin' => true,
                'in_groupe' => true,
            ]);

            $this->groupe->users()->attach($request->group_members,['in_groupe' => true,]);

            if(isset($request->files)){

                if($request['illustration']){
                    $filename = uniqid('groupes_data_',true).Str::random(10).'.'. $this->groupe->id.time().Auth::id().$request->illustration->getClientOriginalName();
                    $path = $request->illustration->move('discusssions/groupes/group_'.$request['name'].'/', $filename);
                    $fichier = new Fichier([
                    'name'=> $filename,
                    'url' => $path,
                    ]);
                    $this->groupe->illustration()->save($fichier);
                }
            }

            return response()->json([
                'message' =>  'success',
                'data'  =>'data',
            ]);

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $this->groupe = Groupe::findOrfail($id);

        if($this->groupe){
            $conversation = $this->groupe->load('users','illustration','funder');

            $messages = $this->groupe->messages()->with('attached_files','author','conversation','parent'/* ,'messages_read_by_group_users','groupe_users.groupe_users_as_read_message' */)->latest()->get();

            //dd($messages);

            $data = $this->paginate($messages,1000);

            $messages = $data;

            $setting = Setting::latest()->first();

            $number = 0;

            $conversations = auth()->user()->conversations()->with(['groupe_users' => function($query){
                $query->where('user_id',auth()->id())->withCount(['messages'=> function($query){
                    $query->where('from','!=',auth()->id())->where('is_read',false)->where('read_at',null);
                }])/* ->withCount(['groupe_users_as_read_message'=> function($query){
                    $query->where('is_read',false)->where('read_at',null);
                }]) */;
            }])->get();

            //dd($conversations);

            /* ->where(['messages'=> function($query){
                $query->where('from','!=',auth()->id());
            }]) */

            $users = User::all();

            return view('conversations.conversation', compact('setting','conversations','users','conversation','messages'));
        }

        abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GroupeRequest $request, $id)
    {
        $this->groupe = Groupe::findOrfail($id);
        if($this->groupe){
            $old_group_name = $this->groupe->name;
            $this->groupe->update($request->all());
            $this->groupe->save();
            if(isset($request->files)){
                if($request['file']){

                    $file = $this->groupe->illustration;

                    $filename = uniqid('groupes_data_',true).Str::random(10).'.'. $this->groupe->id.time().Auth::id().$request['file']->getClientOriginalName();
                    $path = $request['file']->move('discusssions/groupes/group_'.$request['name'].'/', $filename);
                    $fichier = new Fichier([
                    'name'=> $filename,
                    'url' => $path,
                    ]);
                    $this->groupe->illustration()->save($fichier);

                    $path = public_path().'/'.optional($file)->url;

                    if(\File::exists($path)){
                        \File::delete($path);
                    }
                    optional($file)->delete();


                }
            }

            return response()->json([
                'message' =>  'success',
                'data'  =>'data',
            ]);
        }
    }


    public function deleteFiles(Request $request,$id){

        $fichier = Fichier::findOrfail($request->id);

        if($fichier){
            $path = public_path().'/'.optional($fichier)->url;

            if(\File::exists($path)){
                \File::delete($path);
            }

            optional($fichier)->delete();

        }

        return response()->json([
            'message' =>  'success',
            'data'  =>'data',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->groupe = Groupe::findOrfail($id);
        if($this->groupe){

            $file = $this->groupe->illustration;

            $this->groupe->delete();

            $path = public_path().'/'.optional($file)->url;

                if(\File::exists($path)){
                    \File::delete($path);
                }

            optional($file)->delete();
        }

        return response()->json([
            'message' =>  'success',
            'data'  =>'data',
        ]);
    }

    public function paginate($items, $perPage = 5, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }

    public function getOutConversation(Request $request){



        $this->groupe = Groupe::findOrfail($request['id']);
        if($this->groupe){
            $user_group = $this->groupe->users()->wherePivot('user_id',$request['user_id'])->wherePivot('in_groupe',true)->first();
            if(!$user_group){
                return response()->json([
                    'message' =>  'error',
                    'data'  =>'Erreur',
                ],404);
            }
            $user_group->pivot->in_groupe = false;
            $user_group->pivot->is_admin = false;
            $user_group->pivot->save();
            $traffic = new Traffic();
            $traffic->motif = $request['motif'];
            $traffic->groupe_user_id = $user_group->pivot->id;
            $traffic->save();
        }

        return response()->json([
            'message' =>  'success',
            'data'  =>'data',
        ]);
    }

    public function unBlockConversation(Request $request)
    {

        $this->groupe = Groupe::findOrfail($request['id']);

        if($this->groupe){
            $user_group = $this->groupe->users()->wherePivot('user_id',$request['user_id'])->wherePivot('in_groupe',false)->first();

            if(!$user_group){
                return response()->json([
                    'message' =>  'error',
                    'data'  =>'Erreur',
                ],404);
            }
            $user_group->pivot->in_groupe = true;
            $user_group->pivot->is_admin = false;
            $user_group->pivot->save();
            $traffic = new Traffic();
            $traffic->motif = $request['motif'];
            $traffic->groupe_user_id = $user_group->pivot->id;
            $traffic->save();
        }

        return response()->json([
            'message' =>  'success',
            'data'  =>'data',
        ]);
    }

    public function addMembers(Request $request){


        $this->groupe = Groupe::findOrfail($request['id']);
        if($this->groupe){
            $this->groupe->users()->attach($request->group_members,['in_groupe' => true,]);
            //$this->groupe->users()->attach($request->group_members);
            //$this->groupe->save();
        }

        return response()->json([
            'message' =>  'success',
            'data'  =>$this->groupe,
        ]);
    }

    public function markHasRead(Request $request){



        $this->groupe = Groupe::findOrfail($request['id']);

        if(!$this->groupe){

            return response()->json([
                'message' =>  'Conversation not found',
                'data'  => 'Conversation not found',
            ]);
        }

        $groupe_users =  $this->groupe->groupe_users->where('user_id',auth()->id())->first()->load(['messages'=>function($query){
            $query->where('from','!=',auth()->id());
        }]);

        foreach ($groupe_users['messages'] as $key => $message) {

            $message->pivot->is_read = true;
            $message->pivot->read_at = Carbon::now();
            $message->pivot->save();
        }

        return response()->json([
            'data' =>  $groupe_users,

        ]);
        return response()->json([
            'message' =>  'Success',
        ]);



    }

    public function getAttachedFiles($id){
        $this->groupe = Groupe::findOrfail($id);

        $attachedFiles = [];

        $messages = $this->groupe->messages->load('attached_files');

        foreach ($messages->pluck('attached_files') as $attached_files) {

            foreach ($attached_files as $key => $attached_file) {
                array_push($attachedFiles,$attached_file);
            }
        }


        return response()->json([
            'message' =>  'success',
            'data'  => $attachedFiles,
        ]);

    }


    public function changeIllustration(Request $request)
    {

        $request->validate(['illustration' => 'required|mimes:png,jpeg,jpg,svg,webp|max:2048']);

        $this->groupe = Groupe::findOrfail($request->id);

        if(isset($request->files)){
            if($request['illustration']){

                $file = $this->groupe->illustration;

                $filename = uniqid('groupes_data_',true).Str::random(10).'.'. $this->groupe->id.time().Auth::id().$request['illustration']->getClientOriginalName();

                $path = $request['illustration']->move('discusssions/groupes/group_'.$this->groupe->name.'/', $filename);

                $fichier = new Fichier([
                    'name'=> $filename,
                    'url' => $path,
                ]);

                $this->groupe->illustration()->save($fichier);

                $path = public_path().'/'.optional($file)->url;

                if(\File::exists($path)){
                    \File::delete($path);
                }

                optional($file)->delete();
            }
        }

        if ($request->ajax()) {
            return response()->json([
                'status' => "success",
                'message' => "Mise à  jour éffectué.",
            ]);
        }

        return back()->with('success', 'Mise à  jour éffectué');
    }
}
