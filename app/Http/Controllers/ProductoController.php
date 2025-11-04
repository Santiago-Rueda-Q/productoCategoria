<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('categoria')->get();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('productos.create', compact('categorias'));
    }

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

    public function show(string $id)
    {
        $producto = Producto::with('categoria')->findOrFail($id);
        return view('productos.show', compact('producto'));
    }

    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();
        return view('productos.edit', compact('producto', 'categorias'));
    }

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

    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);

        if ($producto->imagen && Storage::disk('public')->exists($producto->imagen)) {
            Storage::disk('public')->delete($producto->imagen);
        }

        $producto->delete();

        return redirect()->route('productos.index')
                        ->with('success', 'Producto eliminado exitosamente.');
    }
}
