<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MessageRequest;
use App\Jobs\SendMessageJob;
use App\Models\Fichier;
use App\Models\Groupe;
use Illuminate\Support\Str;
use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    protected $message;



    protected $rules = [

        "content" => 'sometimes|max:255',

        //"attached_files" => 'sometimes|mimes:csv,png,jpeg,jpg,txt,xlx,xls,pdf,docx,doc,zip|max:2048',

        "to" => 'sometimes|required',
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MessageRequest $request)
    {

        /* $message =Message::findOrfail(206);

        $guids=$message->conversation->groupe_users;

        $message->groupe_users()->attach($guids->pluck('id'));

        return;
         */

        $request->validate($this->rules);

        $this->message = new Message();

        if($this->message){
            $group_id = $request->group_id;

            // check if group_id of our request is null or not

            if($group_id == null){

                $conversations = auth()->user()->direct_conversations;

                if(count($conversations)>0){

                    foreach (auth()->user()->direct_conversations as $conversation) {

                        $ids = [];

                        foreach ($conversation->users->pluck('id') as $value) {
                            array_push($ids,$value);
                        }

                        if(in_array(intval(auth()->id()),$ids) && in_array(intval($request->to[0]),$ids)){
                            $group  = $conversation;
                        }
                        else{

                            // if group_id is null it suppose that is a direct discussion message

                            // So we will create a new group

                            $group = Groupe::create([
                                'type' =>'pair', // type group is set at pair because of direct discussion attribute
                                'owner' => auth()->id(), // ID of message sender
                            ]);

                            //attach group members to group include funder

                            $group->users()->attach([auth()->id(),$request->to[0]],['in_groupe' => true]);
                        }
                    }
                }
                else{

                            // if group_id is null it suppose that is a direct discussion message

                            // So we will create a new group

                            $group = Groupe::create([
                                'type' =>'pair', // type group is set at pair because of direct discussion attribute
                                'owner' => auth()->id(), // ID of message sender
                            ]);

                            //attach group members to group include funder

                            $group->users()->attach([auth()->id(),$request->to[0]],['in_groupe' => true]);
                }

                $group_id = $group->id; // pass new group ID to group_id variable for associate to new message

            }

            // attach message to sender

            $request['from'] = auth()->id();

            // attach message to him group conversation

            $request['groupe_id'] = $group_id;

            /**
             *
             * set message content
             *
             * But before we will encode message context for avoid encode character
            */

            $request['content'] = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->content)));

            //  then we will fill each request field with message

            $this->message->fill($request->all());

            // and save message

            $this->message->save();

            $guids=$this->message->conversation->groupe_users;

            $this->message->groupe_users()->attach($guids->pluck('id'));

            // check if request content files

            if(isset($request->files)){

                // check if request content files data

                if($request->attached_files){

                    // attach each file to message

                    foreach ($request->attached_files as $key => $attached_file) {

                        // generate new file name

                        $filename = uniqid('message_attached_files_',true).Str::random(10).'.'. $this->message->id.time().Auth::id().$attached_file->getClientOriginalName();

                        // set and define file path

                        $path = $attached_file->move('discusssions/groupes/group_'.$this->message->conversation->name.'/messages//j'.$this->message->id.'/', $filename);

                        //create file instance

                        $fichier = new Fichier([
                        'name'=> $filename,
                        'url' => $path,
                        ]);

                        // attach file to message

                        $this->message->attached_files()->save($fichier);
                    }
                }

            }

            //we will notify to each member of group a new message notification

            foreach ($this->message->conversation->actif_groupe_members as $user) {

                /**
                 * The notification we will send through job tasks
                 * Dispach function we will put tasks on queue listen
                 *
                 * this task will send en background without interrupt the actual sending message process
                 *
                 * Queue tasks is running in background and don't affect our function
                 *
                 *  that will send notification in background
                 */

                dispatch(new SendMessageJob($user,$this->message));
            }

            if(!$request->ajax()){

                // simple request action response

                return back()->with('success', 'Le message a bien été envoyé.');
            }

            // ajax response

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
        //
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
    public function update(MessageRequest $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->message = Message::findOrfail($id);
        $this->authorize('delete-message', $this->message);
        if($this->message){
            $this->message->delete();
            return response()->json([
                'message' => "success",
            ],200);
        }
        return response()->json([
            'message' => "success",
        ],204);
    }

    public function filterMessage(Request $request)
    {

    }



    public function detachFile(Request $request){

        $fichier = Fichier::findOrfail($request->id);

        if($fichier){
            $path = public_path().'/'.optional($fichier)->url;

            if(\File::exists($path)){
                \File::delete($path);
            }

            optional($fichier)->delete();

            return response()->json([
                'message' => "success",
            ],200);
        }
        return response()->json([
            'message' => "Errors",
        ],500);
    }
}
