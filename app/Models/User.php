<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Traits\HasAbilitiesTrait;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasAbilitiesTrait; //Import The Trait
    use HasApiTokens;
    use HasFactory;
    use Notifiable;
    use SoftDeletes;

    protected $table = 'users';
    protected $softDelete = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'last_name',
        'first_name',
        'civilite',
        'status_matrimoniale',
        'date_naissance',
        'telephone',
        'salaire',
        'graduation',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [

    ];

    public function postes(){
        return $this->belongsToMany(Poste::class,'poste_users','user_id','poste_id')->withPivot("id",'in_function',"end_at",'id','start_at');
    }

    public function poste_users(){
        return $this->hasMany(PosteUser::class);
    }

    public function user_actual_poste(){
        return $this->postes()->wherePivot('in_function',true);
    }

    public function isComptable(){
        $res = $this->postes()->where('name','like',"%Comptable%")->first();

        if($res){
            return true;
        }
        return false;
    }

    public function isSecretaire(){
        $res = $this->postes()->where('name','like',"%Sécrétariat%")->first();
        if($res){
            return true;
        }
        return false;
    }

    public function isDevelopper(){
        $res = $this->postes()->where('name','like',"%Développeur%")->first();

        if($res){
            return true;
        }
        return false;
    }

    public function isPresent(){
        $presence = $this->presences()->where('created_at','>=',Carbon::today())->first();

        if($presence)
            return $presence->is_present;
        return null;
    }

    public function markHasOut(){
        $presence = $this->presences()->where('created_at','>=',Carbon::today())->first();

        $presence->out_at = Carbon::now();
        $presence->is_present = 1;
        $presence->save();
        return true;
    }

    public function markHasPresent(){
        $presence = new Presence();
        $presence->in_at = Carbon::now();
        $presence->is_present = 2;
        $presence->user_id = $this->id;
        $presence->save();
        return true;
    }

    public function isRH(){
        $res = $this->postes()->where('name','like',"%RH%")->first();

        if($res){
            return true;
        }
        return false;
    }

    public function isPrestataire(){
        $res = $this->roles()->where('name','like',"%Prestataire%")->first();

        if($res){
            return true;
        }
        return false;
    }

    public function isDirector(){

        $res = $this->postes()->where('name','LIKE',"%Directeur%")->first();

        if($res){
            return true;
        }
        return false;
    }

    public function isChief(){

        $res = $this->postes()->where('name','LIKE',"%Chef%")->first();

        if($res){
            return true;
        }
        return false;
    }

    public function isAdmin(){

        $res = $this->roles()->where('name','LIKE',"%Admin%")->where('name','not LIKE','%Employé%')->where('name','not LIKE','%Stagiaire%')->first();

        if($res){
            return true;
        }
        return false;
    }

    public function roles(){
        return $this->belongsToMany(Role::class,'role_users','user_id','role_id',);
    }

    public function projects(){
        return $this->belongsToMany(Project::class,'project_users','user_id','project_id',);
    }

    public function user_projects(){
        return $this->hasMany(ProjectUsers::class);
    }

    public function user_unassign_projects(){
        return $this->projects()->wherePivot('is_assign',false);
    }

    public function actual_projects(){
        return $this->projects()->wherePivot('is_assign',true)->where('is_complete',false);
    }

    public function end_projects(){
        return $this->projects()->wherePivot('is_assign',true)->where('is_complete',true);
    }

    public function tasks(){
        return $this->belongsToMany(Task::class,'user_tasks','user_id','task_id',);
    }

    public function user_tasks(){
        return $this->hasMany(UserTasks::class);
    }

    public function user_unassign_tasks(){
        return $this->tasks()->wherePivot('is_assign',false);
    }

    public function actual_tasks(){
        return $this->tasks()->wherePivot('is_assign',true)->where('is_complete',false);
    }

    public function end_tasks(){
        return $this->tasks()->wherePivot('is_assign',true)->where('is_complete',true);
    }

    public function presences(){
        return $this->hasMany(Presence::class);
    }

    public function conges(){
        return $this->hasMany(Conge::class);
    }

    public function permissions(){
        return $this->hasMany(Permission::class);
    }

    public function rapports(){
        return $this->hasMany(Rapport::class);
    }

    public function salaires(){
        return $this->poste_users()->with('salaires');
    }

    public function paiements(){
        return $this->poste_users()->with('paiements');
    }

    public function rendez_vous(){
        return $this->hasMany(RendezVous::class);
    }

    public function profile(){
        return $this->morphOne(Fichier::class, 'filable')->where('url','like', '%users/photo_profil/%');
    }

    public function pieces(){
        return $this->morphMany(Fichier::class, 'filable')->where('url','like', '%users/pieces/%');
    }

    public function abilities() {
        return $this->belongsToMany(Ability::class,'abilities_users','user_id','ability_id');
    }

    public function messages(){
        return $this->hasMany(Message::class);
    }

    public function groupes(){
        return $this->belongsToMany(Groupe::class,'groupe_users','user_id','groupe_id')->withPivot('id','in_groupe','is_read','is_admin','user_id','groupe_id')->orderByDesc('created_at');
    }

    public function conversations(){
        return $this->groupes()->with('illustration','funder','last_message')->latest();//->with('illustration','funder','last_message')->latest();
    }

    public function direct_conversations(){
        return $this->conversations()->where('type','pair');
    }

    public function user_groupes(){
        return $this->hasMany(GroupeUsers::class);
    }
}
