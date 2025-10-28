@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Productos</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded-md">{{ session('success') }}</div>
    @endif

    <a href="{{ route('productos.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 inline-block">Nuevo Producto</a>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Precio</th>
                    <th class="px-6 py-3 text-left">Stock</th>
                    <th class="px-6 py-3 text-left">Categoría</th>
                    <th class="px-6 py-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productos as $producto)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $producto->id }}</td>
                        <td class="px-6 py-4">{{ $producto->nombre }}</td>
                        <td class="px-6 py-4">${{ number_format($producto->precio, 2) }}</td>
                        <td class="px-6 py-4">{{ $producto->stock }}</td>
                        <td class="px-6 py-4">{{ $producto->categoria->nombre ?? 'Sin categoría' }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('productos.show', $producto->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm">Ver</a>
                            <a href="{{ route('productos.edit', $producto->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Editar</a>
                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-sm" onclick="return confirm('¿Eliminar este producto?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
