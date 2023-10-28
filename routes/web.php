<?php

use App\Models\Paiement;
use App\Models\Rapport;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/errors', function () {
    return view('errors.403');
})->name('403');


Route::get('/print', function () {
    $paiement = Paiement::where('id',1)->first();
    $setting = Setting::latest()->first();
    return view('paiements.print',compact('paiement','setting'));
})->name('print');

Route::get('/dropzone', function () {
    $user = User::where('id',40)->first();
    return view('users.dropzone',compact('user'));
})->name('dropzone');



Auth::routes();


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('/dashboard/roles', "App\Http\Controllers\RoleController")->names('dashboard.roles');
    Route::resource('/dashboard/postes', "App\Http\Controllers\PosteController")->names('dashboard.postes');
    Route::resource('/dashboard/users', "App\Http\Controllers\UserController")->names('dashboard.users');
    Route::resource('/dashboard/presences', "App\Http\Controllers\PresenceController")->names('dashboard.presences');
    Route::resource('/dashboard/abilities', "App\Http\Controllers\AbilityController")->names('dashboard.abilities');
    Route::resource('/dashboard/permissions', "App\Http\Controllers\PermissionController")->names('dashboard.permissions');
    Route::resource('/dashboard/paiements', "App\Http\Controllers\PaiementController")->names('dashboard.paiements');
    Route::resource('/dashboard/rapports', "App\Http\Controllers\RapportController")->names('dashboard.rapports');
    Route::resource('/dashboard/messages', "App\Http\Controllers\MessageController")->names('dashboard.messages');
    Route::resource('/dashboard/conversations', "App\Http\Controllers\GroupeController")->names('dashboard.conversations');
    Route::resource('/dashboard/rendez-vous', "App\Http\Controllers\RendezVousController")->names('dashboard.rendez-vous');
    Route::post('/dashboard/roles/search-roles', [App\Http\Controllers\RoleController::class, 'searchRole'])->name('dashboard.roles.search-role');
    Route::post('/dashboard/postes/search-postes', [App\Http\Controllers\PosteController::class, 'searchPoste'])->name('dashboard.postes.search-poste');
    Route::post('/dashboard/users/search-users', [App\Http\Controllers\UserController::class, 'searchUser'])->name('dashboard.users.searchUsers');
    Route::post('/dashboard/users/filter-messages', [App\Http\Controllers\MessageController::class, 'filterMessage'])->name('dashboard.messages.filter');
    Route::post('/dashboard/users/{user}/join-pieces', [App\Http\Controllers\UserController::class, 'joinPieces'])->name('dashboard.users.joinPieces');
    Route::post('/dashboard/users/{user}/remove-pieces', [App\Http\Controllers\UserController::class, 'removePieces'])->name('dashboard.users.removePieces');
    Route::post('/dashboard/users/{user}/resetPassword', [App\Http\Controllers\UserController::class, 'resetPassword'])->name('dashboard.users.resetPassword');
    Route::post('/dashboard/users/resetProfil', [App\Http\Controllers\UserController::class, 'resetProfil'])->name('dashboard.users.resetProfil');

    Route::post('/dashboard/users/stopUser/{user?}', [App\Http\Controllers\UserController::class, 'stopUser'])->name('dashboard.users.stopUser');
    Route::post('/dashboard/users/startFunctionUser', [App\Http\Controllers\UserController::class, 'startFunctionUser'])->name('dashboard.users.startFunctionUser');
    Route::post('/dashboard/users/retrievePermission/{user}', [App\Http\Controllers\UserController::class, 'retrievePermission'])->name('dashboard.users.retrievePermission');

    Route::post('/dashboard/presences/userInAt', [App\Http\Controllers\PresenceController::class, 'userInAt'])->name('dashboard.presences.userInAt');
    Route::post('/dashboard/presences/userOutAt', [App\Http\Controllers\PresenceController::class, 'userOutAt'])->name('dashboard.presences.userOutAt');
    Route::post('/dashboard/presences/search-presences', [App\Http\Controllers\PresenceController::class, 'searchPresence'])->name('dashboard.presences.search-presence');
    Route::post('/dashboard/permissions/search-permissions', [App\Http\Controllers\PermissionController::class, 'searchPermission'])->name('dashboard.users.search-permission');

    Route::put('/dashboard/permissions/rejeter/{id}', [App\Http\Controllers\PermissionController::class, 'REJETER'])->name('dashboard.permissions.rejeter');
    Route::put('/dashboard/permissions/valider/{id}', [App\Http\Controllers\PermissionController::class, 'VALIDER'])->name('dashboard.permissions.valider');

    Route::put('/dashboard/rendez-vous/annuler/{id}', [App\Http\Controllers\RendezVousController::class, 'ANNULER'])->name('dashboard.rendez-vous.annuler');
    Route::put('/dashboard/rendez-vous/reporter/{id}', [App\Http\Controllers\RendezVousController::class, 'REPORTER'])->name('dashboard.rendez-vous.reporter');
    Route::put('/dashboard/rendez-vous/valider/{id}', [App\Http\Controllers\RendezVousController::class, 'EFFECTUER'])->name('dashboard.rendez-vous.valider');

    Route::put('/dashboard/presences/sortie/{id}', [App\Http\Controllers\PresenceController::class, 'SORTIE'])->name('dashboard.presences.sortie');

    Route::put('/dashboard/paiements/valider/{id}', [App\Http\Controllers\PaiementController::class, 'VALIDER'])->name('dashboard.paiements.valider');
    Route::put('/dashboard/paiements/rejeter/{id}', [App\Http\Controllers\PaiementController::class, 'REJETER'])->name('dashboard.paiements.rejeter');
    Route::resource('/dashboard/salaires', "App\Http\Controllers\SalaireController")->names('dashboard.salaires');


    Route::get('/dashboard/notifications', [App\Http\Controllers\UserController::class, 'getNotifications'])->name('dashboard.notifications');
    Route::get('/dashboard/all-notifications', [App\Http\Controllers\UserController::class, 'notifications'])->name('dashboard.allNotifications');
    Route::get('/dashboard/profil/{user?}', [App\Http\Controllers\UserController::class, 'profile'])->name('dashboard.profile');
    Route::get('/dashboard/inbox', [App\Http\Controllers\UserController::class, 'inbox'])->name('dashboard.inbox');
    Route::get('/dashboard/settings', [App\Http\Controllers\SettingController::class, 'index'])->name('dashboard.settings.index');
    Route::post('/dashboard/setings/update-settings/{setting?}', [App\Http\Controllers\SettingController::class, 'settings'])->name('dashboard.settings.update');
    Route::post('/dashboard/rapports/add/files', [App\Http\Controllers\RapportController::class, 'addFiles'])->name('dashboard.rapports.add.files');
    Route::get('/dashboard/rapports/fetch/files', [App\Http\Controllers\RapportController::class, 'fetchFiles'])->name('dashboard.rapports.fetch.files');
    Route::post('/dashboard/rapports/delete/files', [App\Http\Controllers\RapportController::class, 'deleteFiles'])->name('dashboard.rapports.delete.files');
    Route::post('/dashboard/messages/detach/file', [App\Http\Controllers\MessageController::class, 'detachFile'])->name('dashboard.messages.detach.file');

    Route::post('/dashboard/conversations/addMembers', [App\Http\Controllers\GroupeController::class, 'addMembers'])->name('dashboard.conversations.addMembers');
    Route::post('/dashboard/conversations/unBlockConversation', [App\Http\Controllers\GroupeController::class, 'unBlockConversation'])->name('dashboard.conversations.unBlockConversation');
    Route::post('/dashboard/conversations/retrieveFromConversation', [App\Http\Controllers\GroupeController::class, 'getOutConversation'])->name('dashboard.conversations.retrieveFromConversation');
    Route::post('/dashboard/conversations/getOutConversation', [App\Http\Controllers\GroupeController::class, 'getOutConversation'])->name('dashboard.conversations.getOutConversation');
    Route::post('/dashboard/conversations/blockConversation', [App\Http\Controllers\GroupeController::class, 'getOutConversation'])->name('dashboard.conversations.blockConversation');

    Route::post('/dashboard/conversations/markHasRead', [App\Http\Controllers\GroupeController::class, 'markHasRead'])->name('dashboard.conversations.markHasRead');
    Route::get('/dashboard/conversations/fetchAttachedFiles/{conversation}', [App\Http\Controllers\GroupeController::class, 'getAttachedFiles'])->name('dashboard.conversations.fetchAttachedFiles');
    Route::post('/dashboard/conversations/changeIllustration', [App\Http\Controllers\GroupeController::class, 'changeIllustration'])->name('dashboard.conversations.changeIllustration');

});

