@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Detalle de Categoría</h1>

    <div class="mb-4">
        <strong class="text-lg">ID:</strong> <span>{{ $categoria->id }}</span>
    </div>
    <div class="mb-4">
        <strong class="text-lg">Nombre:</strong> <span>{{ $categoria->nombre }}</span>
    </div>
    <div class="mb-4">
        <strong class="text-lg">Descripción:</strong> <span>{{ $categoria->descripcion }}</span>
    </div>
    <div class="mb-4">
        <strong class="text-lg">Activo:</strong> <span>{{ $categoria->activo ? 'Sí' : 'No' }}</span>
    </div>

    <div class="space-x-4">
        <a href="{{ route('categorias.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Volver</a>
        <a href="{{ route('categorias.edit', $categoria->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md">Editar</a>
    </div>
</div>
@endsection
