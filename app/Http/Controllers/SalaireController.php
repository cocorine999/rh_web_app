<?php

namespace App\Http\Controllers;

use App\Models\PosteUser;
use App\Models\Salaire;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SalaireController extends Controller
{
    protected $rules = [
        'user_poste_id' => 'required|exists:poste_users,id',
        'salaire' => 'required|sometimes|numeric:5',
        'motif' => 'required',
    ];
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
    public function store(Request $request)
    {
        if (auth()->user()->cannot('manage-users') && auth()->user()->cannot('create-users')) {
            return redirect()->route('403');
        }

        $request->validate($this->rules);

        $user_poste = PosteUser::findOrfail($request->user_poste_id);

        if($user_poste->in_function == false ){
            return response()->json([
                'message' => "errors",
                'errors' =>[
                    'salaire' => ['Opération non authorisé ']
                ],
            ],401);
        }

        $last_salaire = optional($user_poste->salaires)->last();

        $value = 0;

        if($last_salaire){
            if($request->motif == 'Augmentation'){
                if( intval($request->salaire) <= intval($last_salaire->montant)){
                    return response()->json([
                        'message' => "errors",
                        'errors' =>[
                            'salaire' => ['Le nouveau salaire doit être supérieur à :  ' . $last_salaire->montant]
                        ],
                    ],422);
                }
                $value = $last_salaire->montant - $request->salaire;
            }
            elseif($request->motif == 'Réduction'){

                if( intval($request->salaire) >= intval($last_salaire->montant)){
                    return response()->json([
                        'message' => "errors",
                        'errors' =>[
                            'salaire' => ['Le nouveau salaire doit être inférieur à :  ' . $last_salaire->montant]
                        ],
                    ],422);
                }
                $value = $last_salaire->montant - $request->salaire;
            }
            else{
                return response()->json([
                    'message' => "errors",
                    'errors' =>[
                        'salaire' => 'Errors'
                    ],
                ],422);
            }
        }

        Salaire::create([
            'montant' => $request->salaire,
            'poste_user_id' => $user_poste->id,
            'motif' => $request->motif,
        ]);

        $user_poste->user->salaire -= $value;

        $user_poste->user->save();

        return response()->json([
            'message' => "success",
            'data' => 'Enregistrement réussie',
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
