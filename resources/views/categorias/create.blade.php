@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-semibold mb-6">Crear Categoría</h1>

    <form action="{{ route('categorias.store') }}" method="POST" class="space-y-6">
        @csrf

        <div class="mb-3">
            <label for="nombre" class="block text-lg font-medium">Nombre</label>
            <input type="text" name="nombre" class="w-full px-4 py-2 border rounded-md" value="{{ old('nombre') }}" required>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="block text-lg font-medium">Descripción</label>
            <textarea name="descripcion" class="w-full px-4 py-2 border rounded-md">{{ old('descripcion') }}</textarea>
        </div>

        <div class="form-check mb-3">
            <input type="checkbox" name="activo" class="form-check-input" value="1" {{ old('activo') ? 'checked' : '' }}>
            <label class="form-check-label">Activo</label>
        </div>

        <div class="space-x-4">
            <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded-md">Guardar</button>
            <a href="{{ route('categorias.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-md">Cancelar</a>
        </div>
    </form>
</div>
@endsection
