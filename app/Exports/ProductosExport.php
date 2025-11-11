<?php

namespace App\Exports;

use App\Models\Producto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ProductosExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Producto::with('categoria')->get();
    }

    /**
     * Encabezados de la tabla
     */
    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Precio',
            'Stock',
            'Categoría',
            'Valor en Inventario',
            'Estado Stock',
            'Fecha Creación',
        ];
    }

    /**
     * Mapear los datos
     */
    public function map($producto): array
    {
        $valorInventario = $producto->precio * $producto->stock;
        $estadoStock = $producto->stock < 10 ? 'Bajo' : ($producto->stock < 50 ? 'Medio' : 'Alto');

        return [
            $producto->id,
            $producto->nombre,
            '$' . number_format($producto->precio, 2),
            $producto->stock,
            $producto->categoria->nombre ?? 'Sin categoría',
            '$' . number_format($valorInventario, 2),
            $estadoStock,
            $producto->created_at->format('d/m/Y H:i'),
        ];
    }

    /**
     * Estilos de la hoja
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'size' => 12],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'font' => ['color' => ['rgb' => 'FFFFFF']],
            ],
        ];
    }

    /**
     * Ancho de columnas
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,
            'B' => 30,
            'C' => 12,
            'D' => 10,
            'E' => 20,
            'F' => 18,
            'G' => 15,
            'H' => 20,
        ];
    }
}
