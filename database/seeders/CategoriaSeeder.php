<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Tecnología', 'descripcion' => 'Productos tecnológicos y electrónicos', 'activo' => true],
            ['nombre' => 'Ropa', 'descripcion' => 'Prendas de vestir y accesorios', 'activo' => true],
            ['nombre' => 'Hogar', 'descripcion' => 'Artículos para el hogar y decoración', 'activo' => true],
            ['nombre' => 'Deportes', 'descripcion' => 'Equipos y artículos deportivos', 'activo' => true],
            ['nombre' => 'Salud', 'descripcion' => 'Productos de salud y bienestar', 'activo' => true],
        ];

        foreach ($categorias as $categoria) {
            Categoria::create($categoria);
        }
    }
}
