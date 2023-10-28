<?php

namespace App\Traits;

use App\Models\Ability;
use App\Models\Poste;
use App\Models\Role;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

trait HasAbilitiesTrait {

   public function giveAbilitiesTo(... $abilities) {

    $abilities = $this->getAllAbilities($abilities);
    //dd($abilities);
    if($abilities === null) {
      return $this;
    }
    $this->abilities()->saveMany($abilities);
    return $this;
  }

  public function withdrawAll() {
    $this->abilities()->detach();
    return $this;
  }

  public function withdrawAbilitiesTo( ... $abilities ) {
    $abilities = $this->getAllAbilities($abilities);
    $this->abilities()->detach($abilities);
    return $this;
  }

  public function syncAbilities( ... $abilities ) {
    $this->abilities()->sync($abilities);
    //return $this->abilities()->sync($abilities);
    //return $this->giveAbilitiesTo($abilities);
  }

  public function refreshAbilities( ... $abilities ) {

    $this->abilities()->detach();
    return $this->giveAbilitiesTo($abilities);
  }

  public function hasAbilityTo($ability) {

    return $this->hasAbilityThroughPoste($ability) || $this->hasAbilityThroughRole($ability) || $this->hasAbility($ability);
  }

  public function hasAbilityThroughRole($ability) {
    foreach ($ability->roles as $role){
      if($this->roles->contains($role)) {
        return true;
      }
    }
    return false;
  }

  public function hasRole( ... $roles ) {
    foreach ($roles as $role) {
      if ($this->roles->contains('slug', 'slug-'.Str::lower(addslashes($role)))) {
        return true;
      }
    }
    return false;
  }

  public function roles() {

    return $this->belongsToMany(Role::class,'role_users');

  }

  public function hasAbilityToPoste($ability) {

    return $this->hasAbilityThroughPoste($ability) || $this->hasAbility($ability);
  }

  public function hasAbilityThroughPoste($ability) {

    foreach ($ability->postes as $poste){
      if($this->actuel_postes->contains($poste)) {
        return true;
      }
    }
    return false;
  }

  public function hasPoste( ... $postes ) {

    foreach ($postes as $poste) {
        if ($this->actuel_postes->contains('name', Str::ucfirst(addslashes($poste)))) {
        return true;
      }
    }
    return false;
  }

  public function hasRoleorPoste( ... $data ) {

    foreach ($data as $d) {
        return $this->hasRole($d) || $this->hasPoste($d);
    }
    return false;
  }

  public function hasAbilityThroughPosteOrRole($ability) {

    $ability = Ability::where('id',$ability)->orWhere('slug',$ability)->first();

    return $this->hasAbilityThroughPoste($ability) || $this->hasAbilityThroughRole($ability);

    $ability = Ability::where('id',$ability)->orWhere('slug',$ability)->first();

    foreach ($ability->postes as $poste){
      if($this->actuel_postes->contains($poste)) {
        return true;
      }
    }
    foreach ($ability->roles as $role){
      if($this->roles->contains($role)) {
        return true;
      }
    }
    return false;

  }


  public function postes() {

    return $this->belongsToMany(Poste::class,'poste_users');

  }

  public function actuel_postes() {

    return $this->belongsToMany(Poste::class,'poste_users')->wherePivot('in_function',true);

  }

  public function abilities() {

    return $this->belongsToMany(Ability::class,'abilities_users');

  }


  protected function hasAbility($ability) {
    return (bool) $this->abilities->where('slug', $ability->slug )->count();
  }

  protected function getAllAbilities(array $abilities) {

    return Ability::whereIn('slug',$abilities)->get();

  }

}
