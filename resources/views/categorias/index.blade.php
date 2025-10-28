@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Categorías</h1>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4 rounded-lg">{{ session('success') }}</div>
    @endif

    <a href="{{ route('categorias.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md mb-4 inline-block">Nueva Categoría</a>

    <div class="overflow-x-auto bg-white shadow-md rounded-lg">
        <table class="min-w-full table-auto">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 text-left">ID</th>
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Descripción</th>
                    <th class="px-6 py-3 text-left">Activo</th>
                    <th class="px-6 py-3 text-left">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categorias as $categoria)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $categoria->id }}</td>
                        <td class="px-6 py-4">{{ $categoria->nombre }}</td>
                        <td class="px-6 py-4">{{ $categoria->descripcion }}</td>
                        <td class="px-6 py-4">{{ $categoria->activo ? 'Sí' : 'No' }}</td>
                        <td class="px-6 py-4 flex space-x-2">
                            <a href="{{ route('categorias.show', $categoria->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded-md text-sm">Ver</a>
                            <a href="{{ route('categorias.edit', $categoria->id) }}" class="bg-yellow-500 text-white px-3 py-1 rounded-md text-sm">Editar</a>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded-md text-sm" onclick="return confirm('¿Eliminar esta categoría?')">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
