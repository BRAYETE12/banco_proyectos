<?php

namespace App\Http\Controllers;

use App\models\Persona;
use App\models\Presupuesto;
use Storage;
use File;
use App\models\Proyecto;
use App\models\Proyecto_ejecucion;
use App\models\Proyectos_bitacora;
use App\models\Proyectos_documento;
use App\models\Proyectos_integrante;
use App\models\Roles_proyecto;
use App\models\tipos_documento;
use Illuminate\Http\Request;
use DB;

class ProyectoCtrl extends Controller
{
    

    public function Crear(){
        return View("admin.proyectos.configurar", [ "id"=>0, "titulo"=> 'Crear proyecto']);
    }
    public function Editar($id){
        return View("admin.proyectos.configurar", [ "id"=>$id, "titulo"=> 'Editar proyecto' ]);
    }

    public function Listado(){
        return View("admin.proyectos.listado");
    }

    public function getDataListado(){
        return json_encode( [
            "proyectos"=> Proyecto::where('estado',true)->get(),
        ] );
    }


    public function getData($id){
        return json_encode( [
            "proyecto"=> Proyecto::find($id),
            "documentos"=> Proyectos_documento::where([ ["proyecto_id",$id], ['estado',true] ])->get(),
            "bitacoras"=> Proyectos_bitacora::where([ ["proyecto_id",$id], ['estado',true] ])->get(),
            "integrantes"=> Proyectos_integrante::where([ ["proyecto_id",$id], ['estado',true] ])->with(["rol","persona"])->get(),
            "presupuesto"=> Presupuesto::where([ ["proyecto_id",$id], ['estado',true] ])->get(),
            "ejecucion"=> Proyecto_ejecucion::where([ ["proyecto_id",$id], ['estado',true] ])->get(),
            "cdps"=> DB::select("select *from proyectos_financiados where proyectos_id = ".$id),
            "roles"=> Roles_proyecto::get(),
            "tiposDocumentos"=> tipos_documento::get(),
        ] );
    }


    public function guardarGeneral(Request $request){
        /*
        $validator = \Validator::make($request->all(), [
            'idioma.title' => 'required',
            'idioma.sub_title' => 'required',
            'idioma.abstract' => 'required',
            'revista_id' => 'required|exists:revistas,id', 
            'idioma_id' => 'required|exists:idiomas,id',        
         ],[
            'idioma.title.required' => 'Title required',
            'idioma.sub_title.required' => 'Sub title required',
            'idioma.title.abstract' => 'Abstract required',
            'revista_id.required' => 'Error data',
            'revista_id.exists' => 'Error Data',
            'idioma_id.required' => 'languages is required',
            'idioma_id.exists' => 'languages not exist'
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }
        */
        

        $proyecto = Proyecto::updateOrCreate( [ "id"=>$request->id, "estado"=>true ], $request->all() );

        return [ "success"=>true, "id"=>$proyecto->id ];
    }


    public function guardarPresupuesto(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'nombre' => 'required',
            'valor' => 'required',        
         ],[
            'nombre.required' => 'El campo nombre es requiredo',
            'valor.required' => 'El campo valor es requiredo',
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }
        
        $item = Presupuesto::updateOrCreate( [ "id"=>$request->id, "estado"=>true ], $request->all() );

        return [ "success"=>true, "item"=>$item ];
    }

    public function guardarEjecucion(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'nombre' => 'required',
            'valor' => 'required',        
         ],[
            'nombre.required' => 'El campo nombre es requiredo',
            'valor.required' => 'El campo valor es requiredo',
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }

        $item = Proyecto_ejecucion::find($request->id);
        if(! $item ){ 
            $item = new Proyecto_ejecucion(); 
            $item->proyecto_id = $request->proyecto_id;
            $item->estado = true;
        }       

        $item->nombre = $request->nombre;
        $item->descripcion = $request->descripcion;
        $item->valor = $request->valor;


        if ($request->archivo) {            
            $fileName = "/proyect_". $request->proyecto_id ."/ejecucion/". time().str_random(5).'.'.$request->archivo->getClientOriginalExtension();
            Storage::disk('filesProyectos')->put( $fileName, File::get($request->archivo));
            $item->soporte = "/proyectos". $fileName;
        }
        
        $item->save();

        return [ "success"=>true, "item"=>$item ];
    }

    public function guardarDocumento(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'nombre' => 'required',
            'proyecto_id' => 'required|exists:proyectos,id', 
         ],[
            'nombre.required' => 'Title required',
            'proyecto_id.required' => 'Error data',
            'proyecto_id.exists' => 'Error Data',
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }
         
        $documento = Proyectos_documento::find($request->id);
        if(! $documento ){ 
            $documento = new Proyectos_documento(); 
            $documento->proyecto_id = $request->proyecto_id;
            $documento->estado = true;
        }       

        $documento->nombre = $request->nombre;
        
        if ($request->archivo) {            
            $fileName = "/proyect_". $request->proyecto_id ."/documentos/". time().str_random(5).'.'.$request->archivo->getClientOriginalExtension();
            Storage::disk('filesProyectos')->put( $fileName, File::get($request->archivo));
            $documento->ruta = "/proyectos". $fileName;
        }
        $documento->save();

        return [ "success"=>true, "documento"=>$documento ];
    }

    public function guardarBitacora(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'descripcion' => 'required',
            'proyecto_id' => 'required|exists:proyectos,id', 
         ],[
            'descripcion.required' => 'Title required',
            'proyecto_id.required' => 'Error data',
            'proyecto_id.exists' => 'Error Data',
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }
         
        $bitacora = Proyectos_bitacora::find($request->id);
        if(! $bitacora ){ 
            $bitacora = new Proyectos_bitacora(); 
            $bitacora->proyecto_id = $request->proyecto_id;
            $bitacora->estado = true;
        }       

        $bitacora->descripcion = $request->descripcion;
        
        if ($request->archivo) {            
            $fileName = "/proyect_". $request->proyecto_id ."/bitacora/". time().str_random(5).'.'.$request->archivo->getClientOriginalExtension();
            Storage::disk('filesProyectos')->put( $fileName, File::get($request->archivo));
            $bitacora->ruta = "/proyectos". $fileName;
        }
        $bitacora->save();

        return [ "success"=>true, "bitacora"=>$bitacora ];
    }

    public function guardarIntegrante(Request $request){
        
        $validator = \Validator::make($request->all(), [
            'persona.tipo_documento_id' => 'required|exists:tipos_documentos,id',
            'persona.numero_documento' => 'required', 
            'persona.nombres' => 'required', 
            'persona.apellidos' => 'required', 
            'proyecto_id' => 'required|exists:proyectos,id', 
            'rol_id' => 'required|exists:roles_proyectos,id', 
         ],[
            'proyecto_id.required' => 'Error data',
            'proyecto_id.exists' => 'Error Data',
          ]);
         
        if($validator->fails()){ return [ "success"=>false, "errores"=>$validator->errors() ]; }
         
        $dtp = $request->persona;
        $persona = Persona::updateOrCreate( ['tipo_documento_id'=>$dtp['tipo_documento_id'], 'numero_documento'=>$dtp['numero_documento']], $dtp );

        $integrante = Proyectos_integrante::where([ ['proyecto_id',$request->proyecto_id],['persona_id',$persona->id],['rol_id',$request->rol_id],["estado",true] ])->first();

        if(!$integrante){
            $integrante = new Proyectos_integrante();
            $integrante->proyecto_id = $request->proyecto_id;
            $integrante->rol_id = $request->rol_id;
            $integrante->persona_id = $persona->id;
            $integrante->estado = true;
        }
        $integrante->fecha_inicio = $request->fecha_inicio;
        $integrante->fecha_fin = $request->fecha_fin;
        $integrante->save();
        
        $integrantes = Proyectos_integrante::where([ ["proyecto_id", $integrante->proyecto_id], ['estado',true] ])->with(["rol","persona"])->get();

        return [ "success"=>true, "integrantes"=>$integrantes ];
    }

    public function eliminarIntegrante(Request $request){
        
        $integrante = Proyectos_integrante::where([ ['proyecto_id',$request->proyecto_id],['persona_id',$request->persona_id],['rol_id',$request->rol_id] ])->first();

        if($integrante){
            $integrante->estado = false;
            $integrante->save();
            return [ "success"=>true ];
        }
        
        return [ "success"=>false ];
    }

    public function eliminarDocumento(Request $request){
        
        $documento = Proyectos_documento::find($request->id);

        if($documento){
            $documento->estado = false;
            $documento->save();
            return [ "success"=>true ];
        }
        
        return [ "success"=>false ];
    }

    public function eliminarBitacora(Request $request){
        
        $bitacora = Proyectos_bitacora::find($request->id);

        if($bitacora){
            $bitacora->estado = false;
            $bitacora->save();
            return [ "success"=>true ];
        }
        
        return [ "success"=>false ];
    }

    public function eliminarItemPresupuesto(Request $request){
        
        $itemPresupuesto = Presupuesto::find($request->id);

        if($itemPresupuesto){
            $itemPresupuesto->estado = false;
            $itemPresupuesto->save();
            return [ "success"=>true ];
        }
        
        return [ "success"=>false ];
    }


    public function buscarPersona(Request $request){
        return Persona::where([ ['tipo_documento_id',$request->tipo_documento_id],['numero_documento',$request->numero_documento] ])->first();
    }


}
