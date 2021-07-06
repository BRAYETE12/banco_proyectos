<?php

namespace App\Http\Controllers;

use App\models\cdp;
use App\models\cdp_movimiento;
use Storage;
use File;
use App\models\Fuentes_financiacion;
use App\models\Proyecto;
use App\models\Tipos_fuente;
use Illuminate\Http\Request;
use DB;

class FuentesRecursosCtrl extends Controller
{
    
    /*  FUENTES DE RECURSOS  */

    public function getListadoFuentesRecursos(){
        return View("admin.fuentesRecursos.fuentesRecursos");
    }

    public function getDataListadoFuentesRecursos(){
        $data =[
           "fuentes"=> Fuentes_financiacion::with("tipo")->get(),
           "tipos"=> Tipos_fuente::get(),
        ];

        return json_encode($data);
    }

    public function guardarFuenteRecursos(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'tipos_fuentes_id' => 'required|exists:tipos_fuentes,id', 
            'nombre' => 'required',
            'anio' => 'required', 
            'valor' => 'required',
         ],[
            'nombre.required' => 'El campo nombre es requerido',
            'anio.required' => 'El campo año es requerido',
            'valor.required' => 'El campo valor es requerido',
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }
         
        $fuente = Fuentes_financiacion::find($request->id);
        if(! $fuente ){ 
            $fuente = new Fuentes_financiacion();
            $fuente->estado = true;
        }       

        $fuente->tipos_fuentes_id = $request->tipos_fuentes_id;
        $fuente->nombre = $request->nombre;
        $fuente->anio = $request->anio;
        $fuente->valor = $request->valor;
        
        if ($request->archivo) {            
            $fileName = "/fuentesFinanciacion/". time().str_random(5).'.'.$request->archivo->getClientOriginalExtension();
            Storage::disk('filesFuentesFinanciacion')->put( $fileName, File::get($request->archivo));
            $fuente->soporte = "/fuentesFinanciacion". $fileName;
        }
        $fuente->save();

        $fuente->tipo = $fuente->tipo; 

        return [ "success"=>true, "plan"=> $fuente ];
    }

    /*  CDPS  */

    public function getListadoCDPS(){
        return View("admin.fuentesRecursos.CDPS");
    }

    public function getDataListadoCDPS(){
        $data =[
           "fuentes"=> Fuentes_financiacion::get(),
           "cdps"=> DB::select("select *from vista_cdps"),
        ];

        return json_encode($data);
    }

    public function guardarCDP(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'fuentes_id' => 'required|exists:fuentes_financiacions,id',
            'valor' => 'required', 
            'fecha' => 'required', 
            'numero' => 'required', 
         ],[
            'fecha.required' => 'El campo fecha es requerido',
            'fuentes_id.required' => 'El campo fuente es requerido',
            'valor.required' => 'El campo valor es requerido',
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }
         
        $cdp = cdp::find($request->id);
        if(! $cdp ){ 
            $cdp = new cdp();
            $cdp->estado = true;
        }       

        $cdp->fuentes_id = $request->fuentes_id;
        $cdp->valor = $request->valor;
        $cdp->numero = $request->numero;
        $cdp->concepto = $request->concepto;
        $cdp->fecha = date($request->fecha);
        
        if ($request->archivo) {            
            $fileName = "/cdps/". time().str_random(5).'.'.$request->archivo->getClientOriginalExtension();
            Storage::disk('filesFuentesFinanciacion')->put( $fileName, File::get($request->archivo));
            $cdp->soporte = "/fuentesFinanciacion". $fileName;
        }
        $cdp->save();
        
        return [ "success"=>true, "cdp"=> collect(DB::select("select *from vista_cdps where id=".$cdp->id ))->first() ];
    }


    public function getDataRecursosCDPS($id){

        $cdp = cdp::find($id);

        $data =[
           "movimientos"=> $cdp->movimientos,
           "proyectos_financiados"=> $cdp->proyectos_financiados,
           "proyectos"=> Proyecto::get(),
        ];

        return json_encode($data);
    } 


    public function guardarMovimientoCDP(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'valor' => 'required', 
            'fecha' => 'required', 
         ],[
            'fecha.required' => 'El campo fecha es requerido',
            'valor.required' => 'El campo valor es requerido',
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }
         
        $mv = new cdp_movimiento();     
        $mv->cdps_id = $request->cdps_id;
        $mv->tipo = $request->tipo;
        $mv->estado = true;
        $mv->valor = $request->valor;
        $mv->observaciones = $request->observaciones;
        $mv->fecha = date($request->fecha);
        
        if ($request->archivo) {            
            $fileName = "/movimientos_cdps/". time().str_random(5).'.'.$request->archivo->getClientOriginalExtension();
            Storage::disk('filesFuentesFinanciacion')->put( $fileName, File::get($request->archivo));
            $mv->soporte = "/fuentesFinanciacion". $fileName;
        }
        $mv->save();

        return [ "success"=>true, "movimiento"=> $mv ];
    }

    public function guardarProyectoCDP(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'valor' => 'required', 
            'fecha' => 'required', 
         ],[
            'fecha.required' => 'El campo fecha es requerido',
            'valor.required' => 'El campo valor es requerido',
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }
         
        $cdp = cdp::find($request->cdps_id);
        $cdp->proyectos_financiados()->attach($request->proyectos_id, [ "fecha"=>date($request->fecha), "valor"=>$request->valor ] );

        return [ "success"=>true, "proyectos"=> $cdp->proyectos_financiados ];
    }

}
