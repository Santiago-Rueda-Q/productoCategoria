<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CategoriasExport;
use Barryvdh\DomPDF\Facade\Pdf;

class CategoriaController extends Controller
{
    /**
     * Mostrar el listado de categorías (vista principal)
     */
    public function index()
    {
        $categorias = Categoria::paginate(10);
        return view('categorias.index', compact('categorias'));
    }

    /**
     * Crear una nueva categoría
     */
    public function create()
    {
        return view('categorias.create');
    }

    /**
     * Guardar una categoría
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre',
            'descripcion' => 'nullable|string|max:200',
            'activo' => 'boolean',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'activo' => $request->has('activo') ? 1 : 0,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría creada exitosamente.');
    }

    /**
     * Mostrar detalles
     */
    public function show(Categoria $categoria)
    {
        return view('categorias.show', compact('categoria'));
    }

    /**
     * Editar
     */
    public function edit(Categoria $categoria)
    {
        return view('categorias.edit', compact('categoria'));
    }

    /**
     * Actualizar
     */
    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:100|unique:categorias,nombre,'.$categoria->id,
            'descripcion' => 'nullable|string|max:200',
            'activo' => 'boolean',
        ]);

        $categoria->update([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'activo' => $request->has('activo') ? 1 : 0,
        ]);

        return redirect()->route('categorias.index')
            ->with('success', 'Categoría actualizada exitosamente.');
    }

    /**
     * Eliminar
     */
    public function destroy(Categoria $categoria)
    {
        try {
            $categoria->delete();
            return redirect()->route('categorias.index')
                ->with('success', 'Categoría eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('categorias.index')
                ->with('error', 'Error al eliminar la categoría: ' . $e->getMessage());
        }
    }

    /**
     * Exportar a Excel
     */
    public function exportExcel()
    {
        return Excel::download(new CategoriasExport, 'categorias_'.date('Y-m-d_His').'.xlsx');
    }

    /**
     * Generar PDF
     */
    public function exportPdf()
    {
        $categorias = Categoria::all();
        $pdf = Pdf::loadView('categorias.reporte', [
            'categorias' => $categorias,
            'total' => $categorias->count(),
            'fecha' => date('d/m/Y H:i'),
        ]);

        return $pdf->download('reporte_categorias_'.date('Y-m-d_His').'.pdf');
    }
}
