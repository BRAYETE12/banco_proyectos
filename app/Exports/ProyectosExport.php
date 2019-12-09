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
        return collect( DB::select("select *from vista_proyectos") );
    }


    public function headings(): array
    {
        return [
            'Nombre',
            'Fecha de radicación',
            'Fecha de inicio',
            'Fecha de fin',
            'Valor solicitado',
            'Valor presupuestado',
            'Valor asignado',
            'Valor ejecutado',
        ];
    }

}
