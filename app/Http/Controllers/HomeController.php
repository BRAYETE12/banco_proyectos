<?php

namespace App\Http\Controllers;

use App\models\dependencia;
use App\models\role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function dashboard()
    {
        return view('admin.dashboard');
    }


    public function usuarios()
    {
        return view('admin.usuarios');
    }

    public function getDataUsuarios(){
        
        $data["roles"] = role::get();
        $data["listado"] =  User::where('id', '!=', 1)->get();

        return json_encode($data);
    }

    public function guardarUsuario(Request $request){

        $user = new User();
        $user->password = Hash::make($request->email);
        $user->email = $request->email;
        $user->name = $request->name;
        $user->rol_id = $request->rol_id;
        $user->save();

        $data["success"] = true;
        $data["listado"] =  User::where('id', '!=', 1)->get();

        return json_encode($data);
    }


    public function dependencias()
    {
        return view('admin.dependencias');
    }

    public function getDependencias(){        
        $data = dependencia::get();
        return json_encode($data);
    }

    public function guardarDependencia(Request $request){

        $dep = dependencia::find($request->id);
        if($dep == null){ $dep = new dependencia(); }        
        $dep->nombre = $request->nombre;
        $dep->save();

        $data["success"] = true;
        $data["listado"] = dependencia::get();

        return json_encode($data);
    }

}
