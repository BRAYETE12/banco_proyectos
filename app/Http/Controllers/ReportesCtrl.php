<?php

namespace App\Http\Controllers;

use App\Exports\CDPSExport;
use App\Exports\FuentesExport;
use App\Exports\ProyectosExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DB;

class ReportesCtrl extends Controller
{
    

    public function cdps(){

        $data = [
            "reporte"=> 1,
            "titulo"=> "Reporte por CDPS"
        ];

        return View("admin.reportes", $data );
    }
    public function fuentes(){

        $data = [
            "reporte"=> 2,
            "titulo"=> "Reporte por fuentes de recursos"
        ];

        return View("admin.reportes", $data );
    }
    public function proyectos(){

        $data = [
            "reporte"=> 3,
            "titulo"=> "Reporte por proyecto"
        ];

        return View("admin.reportes", $data );
    }

    public function GetDataReporte($id){

        $data = [];

        switch($id){
            case 1: $data = DB::select("select *from vista_cdps"); break;
            case 2: $data = DB::select("select *from vista_fuentes"); break;
            case 3: $data = DB::select("select *from vista_proyectos"); break;
        }

        return json_encode($data);
    }



    public function ExcelProyectos(){
        return Excel::download(new ProyectosExport(), 'proyectos.xlsx');
    }
    public function ExcelFuentes(){
        return Excel::download(new FuentesExport(), 'fuentes.xlsx');
    }
    public function ExcelCdps(){
        return Excel::download(new CDPSExport(), 'cdps.xlsx');
    }


}
