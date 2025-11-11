<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ProductosExport;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductoController extends Controller
{
    /**
     * Mostrar el listado de productos (vista principal)
     */
    public function index()
    {
        $productos = Producto::with('categoria')->paginate(10);
        return view('productos.index', compact('productos'));
    }

    /**
     * Crear un nuevo producto
     */
    public function create()
    {
        $categorias = Categoria::where('activo', 1)->get();
        return view('productos.create', compact('categorias'));
    }

    /**
     * Guardar un producto
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->only(['nombre', 'precio', 'stock', 'categoria_id']);

        if ($request->hasFile('imagen')) {
            $categoria = Categoria::find($request->categoria_id);
            $folder = 'productos/' . str_replace(' ', '_', strtolower($categoria->nombre));
            $path = $request->file('imagen')->store($folder, 'public');
            $data['imagen'] = $path;
        }

        Producto::create($data);

        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Mostrar detalles
     */
    public function show(string $id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    /**
     * Editar
     */
    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::where('activo', 1)->get();
        return view('productos.edit', compact('producto', 'categorias'));
    }

    /**
     * Actualizar
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:100',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'categoria_id' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $producto = Producto::findOrFail($id);
        $data = $request->only(['nombre', 'precio', 'stock', 'categoria_id']);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $categoria = Categoria::find($request->categoria_id);
            $folder = 'productos/' . str_replace(' ', '_', strtolower($categoria->nombre));
            $path = $request->file('imagen')->store($folder, 'public');
            $data['imagen'] = $path;
        }

        $producto->update($data);

        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Eliminar
     */
    public function destroy(string $id)
    {
        try {
            $producto = Producto::findOrFail($id);

            if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
                Storage::disk('public')->delete($producto->imagen);
            }

            $producto->delete();

            return redirect()->route('productos.index')
                ->with('success', 'Producto eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('productos.index')
                ->with('error', 'Error al eliminar el producto: ' . $e->getMessage());
        }
    }

    /**
     * Exportar a Excel
     */
    public function exportExcel()
    {
        return Excel::download(new ProductosExport, 'productos_'.date('Y-m-d_His').'.xlsx');
    }

    /**
     * Generar PDF
     */
    public function exportPdf()
    {
        $productos = Producto::with('categoria')->get();
        $pdf = Pdf::loadView('productos.reporte', [
            'productos' => $productos,
            'total' => $productos->count(),
            'valorTotal' => $productos->sum(function($p) {
                return $p->precio * $p->stock;
            }),
            'fecha' => date('d/m/Y H:i'),
        ]);

        return $pdf->download('reporte_productos_'.date('Y-m-d_His').'.pdf');
    }
}
