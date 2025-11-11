@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-gray-800">Gestión de Productos</h1>
            <p class="text-gray-600 mt-2">Administra el inventario de productos</p>
        </div>

        <!-- Mensaje de éxito -->
        @if (session('success'))
            <div id="success-alert"
                class="bg-green-500 text-white p-4 mb-6 rounded-lg shadow-md flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button onclick="document.getElementById('success-alert').remove()" class="text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Mensaje de error -->
        @if (session('error'))
            <div id="error-alert"
                class="bg-red-500 text-white p-4 mb-6 rounded-lg shadow-md flex items-center justify-between">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle mr-3"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button onclick="document.getElementById('error-alert').remove()" class="text-white hover:text-gray-200">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Barra de acciones -->
        <div class="bg-white rounded-lg shadow-md p-4 mb-6">
            <div class="flex flex-wrap justify-between items-center gap-4">
                <a href="{{ route('productos.create') }}"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md transition duration-200 flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    Nuevo Producto
                </a>

                <div class="flex flex-wrap gap-2">
                    <a href="{{ route('productos.exportExcel') }}"
                        class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md transition duration-200 flex items-center gap-2">
                        <i class="fas fa-file-excel"></i>
                        Exportar Excel
                    </a>
                    <a href="{{ route('productos.exportPdf') }}"
                        class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-md transition duration-200 flex items-center gap-2">
                        <i class="fas fa-file-pdf"></i>
                        Generar PDF
                    </a>
                </div>
            </div>
        </div>

        <!-- Tabla de productos -->
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full table-auto">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Imagen</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nombre</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Precio</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Stock</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Categoría</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 bg-white">
                        @if (isset($productos) && $productos->count() > 0)
                            @foreach ($productos as $producto)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $producto->id }}</td>

                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($producto->imagen)
                                            <div class="w-16 h-16 rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                                <img src="{{ asset('storage/'.$producto->imagen) }}"
                                                    alt="{{ $producto->nombre }}"
                                                    class="object-cover w-full h-full">
                                            </div>
                                        @else
                                            <div class="w-16 h-16 flex items-center justify-center border-2 border-dashed border-gray-300 rounded-lg text-gray-400 text-xs">
                                                Sin imagen
                                            </div>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        {{ $producto->nombre }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        ${{ number_format($producto->precio, 2) }}
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 py-1 {{ $producto->stock < 10 ? 'bg-red-100 text-red-800' : 'bg-green-100 text-green-800' }} rounded-full text-xs">
                                            {{ $producto->stock }} unidades
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs">
                                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                                        </span>
                                    </td>

                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex gap-2">
                                            <a href="{{ route('productos.show', $producto->id) }}"
                                                class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-md text-sm transition">
                                                <i class="fas fa-eye"></i> Ver
                                            </a>
                                            <a href="{{ route('productos.edit', $producto->id) }}"
                                                class="inline-block bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-1 rounded-md text-sm transition">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm transition">
                                                    <i class="fas fa-trash"></i> Eliminar
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="7" class="px-6 py-4 text-center text-sm text-gray-500">
                                    No hay productos registrados.
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <!-- Paginación -->
            @if ($productos->hasPages())
                <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1 flex justify-between sm:hidden">
                            @if ($productos->onFirstPage())
                                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                                    Anterior
                                </span>
                            @else
                                <a href="{{ $productos->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Anterior
                                </a>
                            @endif

                            @if ($productos->hasMorePages())
                                <a href="{{ $productos->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                    Siguiente
                                </a>
                            @else
                                <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-400 bg-gray-100 cursor-not-allowed">
                                    Siguiente
                                </span>
                            @endif
                        </div>
                        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                            <div>
                                <p class="text-sm text-gray-700">
                                    Mostrando
                                    <span class="font-medium">{{ $productos->firstItem() ?? 0 }}</span>
                                    a
                                    <span class="font-medium">{{ $productos->lastItem() ?? 0 }}</span>
                                    de
                                    <span class="font-medium">{{ $productos->total() }}</span>
                                    resultados
                                </p>
                            </div>
                            <div>
                                {{ $productos->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Auto-ocultar alertas después de 5 segundos
        setTimeout(function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');

            if (successAlert) {
                successAlert.style.transition = 'opacity 0.5s';
                successAlert.style.opacity = '0';
                setTimeout(() => successAlert.remove(), 500);
            }

            if (errorAlert) {
                errorAlert.style.transition = 'opacity 0.5s';
                errorAlert.style.opacity = '0';
                setTimeout(() => errorAlert.remove(), 500);
            }
        }, 5000);

        // Confirmación de eliminación mejorada
        document.addEventListener('DOMContentLoaded', function() {
            const deleteForms = document.querySelectorAll('form[action*="destroy"]');

            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: "Esta acción eliminará el producto y su imagen",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endpush
