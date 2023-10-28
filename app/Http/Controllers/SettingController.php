<?php

namespace App\Http\Controllers;

use App\Models\Fichier;
use App\Models\Paiement;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PDF;

class SettingController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        if (auth()->user()->cannot('manage-settings')) {
            return redirect()->route('403');
        }

        $setting = Setting::latest()->first();

        return view('settings', compact('setting'));

    }

    public function settings(Request $request,$id=null){

        if (auth()->user()->cannot('manage-settings')) {
            return redirect()->route('403');
        }

        $setting = Setting::where('id',$id)->first();
        $request->app_name = Str::upper(addslashes($request->app_name));
        $request->slogan = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->slogan)));
        $request->description = Str::ucfirst(addslashes(preg_replace("/\r|\n/", "",$request->description)));
        $request->enterprise_name = Str::upper(addslashes($request->enterprise_name));
        if(!$setting){
            $setting = new Setting();

            $setting->create($request->all());
        }
        else{
            $setting->update($request->all());

        }

        $setting->save();

        if (isset($request->files) && $request->file('logo')) {

            $file = $setting->logo;

            if(\File::exists(public_path().'/settings/logo')){
                \File::deleteDirectory(public_path().'/settings/logo');
            }

            $photoProfile = $request->file('logo');

                $filename = uniqid('logo_', true) . Str::random(10) . '.' . time() . $setting->id . $photoProfile->getClientOriginalName();

                $path = $photoProfile->move('settings/logo/', $filename);

                $fichier = new Fichier([
                    'name' => $filename,
                    'url' => $path,
                ]);

                $setting->logo()->save($fichier);

                optional($file)->delete();
        }

        return back()->with('success', 'Parametre mis à jour.');

    }

}
