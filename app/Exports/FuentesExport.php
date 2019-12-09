<?php

namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Support\Collection;
use DB;


class FuentesExport implements FromCollection, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return collect( DB::select("select *from vista_fuentes") );
    }


    public function headings(): array
    {
        return [
            'Tipo fuente',
            'Año',
            'Nombre',
            'Valor',
            'Valor asignado a cdps',
        ];
    }
}
