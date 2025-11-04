<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        // Crear carpetas en storage si no existen
        Storage::disk('public')->makeDirectory('productos/tecnologia');
        Storage::disk('public')->makeDirectory('productos/ropa');
        Storage::disk('public')->makeDirectory('productos/hogar');
        Storage::disk('public')->makeDirectory('productos/deportes');
        Storage::disk('public')->makeDirectory('productos/salud');

        // Lista de productos con su categoría
        $productos = [
            [
                'nombre' => 'Audífonos',
                'precio' => 150000,
                'stock' => 25,
                'categoria' => 'Tecnología',
                'imagen' => 'audifonos.jpg',
            ],
            [
                'nombre' => 'Camiseta',
                'precio' => 60000,
                'stock' => 40,
                'categoria' => 'Ropa',
                'imagen' => 'camiseta.jpg',
            ],
            [
                'nombre' => 'Lampara',
                'precio' => 85000,
                'stock' => 10,
                'categoria' => 'Hogar',
                'imagen' => 'lampara.jpg',
            ],
            [
                'nombre' => 'Balón del mejor deporte',
                'precio' => 120000,
                'stock' => 18,
                'categoria' => 'Deportes',
                'imagen' => 'balon.jpg',
            ],
            [
                'nombre' => 'Suplemento vitamínico',
                'precio' => 95000,
                'stock' => 30,
                'categoria' => 'Salud',
                'imagen' => 'vitaminas.jpg',
            ],
        ];

        foreach ($productos as $prod) {
            $categoria = Categoria::where('nombre', $prod['categoria'])->first();

            if ($categoria) {
                // Copiar imagen de muestra (de public/img a storage)
                $origen = public_path('img/productos/' . $prod['imagen']);
                $destino = 'productos/' . strtolower($categoria->nombre) . '/' . $prod['imagen'];

                if (file_exists($origen)) {
                    Storage::disk('public')->put($destino, file_get_contents($origen));
                }

                Producto::create([
                    'nombre' => $prod['nombre'],
                    'precio' => $prod['precio'],
                    'stock' => $prod['stock'],
                    'categoria_id' => $categoria->id,
                    'imagen' => $destino,
                ]);
            }
        }
    }
}
