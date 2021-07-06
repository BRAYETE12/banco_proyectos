<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;
use DB;

class CDPSExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $campos = 'numero, fecha_creacion, tipo_fuente_financiacion, fuente_financiacion, valor_inicial, valor_adiccion, valor_disminucion, valor_proyectos, concepto';
        return collect( DB::select("select $campos from vista_cdps") );
    }


    public function headings(): array
    {
        return [
            'Número',
            'Fecha creación',            
            'Tipo fuente financiación',
            'fuente financiación',
            'Valor inicial',
            'Valor adiciones',
            'Valor disminuciones',
            'Valor asignado a proyectos',
            'Concepto',
        ];
    }
}
