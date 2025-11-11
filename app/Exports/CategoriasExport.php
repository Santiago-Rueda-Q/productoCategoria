<?php

namespace App\Exports;

use App\Models\Categoria;
use Maatwebsite\Excel\Concerns\FromCollection;

class CategoriasExport implements FromCollection
{
    public function collection()
    {
        return Categoria::select('id', 'nombre', 'descripcion', 'activo')->get();
    }
}
