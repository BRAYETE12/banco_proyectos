<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;
use DB;

class ProyectosExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $campos = "codigo,estado,nombre,fecha_radicacion,fecha_inicio,fecha_finalizacion,valor_solicitado,valor_presupuestado,valor_asignado,valor_ejecutado";
        return collect( DB::select("select $campos from vista_proyectos") );
    }


    public function headings(): array
    {
        return [
            'Código',
            'Estado',
            'Nombre',
            'Fecha de radicación',
            'Fecha de inicio',
            'Fecha de finalización',
            'Valor solicitado',
            'Valor presupuestado',
            'Valor asignado',
            'Valor ejecutado',
        ];
    }

}
