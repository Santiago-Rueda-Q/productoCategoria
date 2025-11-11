<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Productos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #2563eb;
            padding-bottom: 10px;
        }
        .header h1 {
            color: #1e40af;
            margin: 0;
            font-size: 24px;
        }
        .header p {
            color: #64748b;
            margin: 5px 0;
        }
        .info-box {
            background-color: #f1f5f9;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .info-box p {
            margin: 5px 0;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th {
            background-color: #2563eb;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: bold;
        }
        td {
            padding: 8px;
            border-bottom: 1px solid #e2e8f0;
        }
        tr:nth-child(even) {
            background-color: #f8fafc;
        }
        .stock-bajo {
            background-color: #fee2e2;
            color: #991b1b;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 10px;
        }
        .stock-medio {
            background-color: #fef3c7;
            color: #92400e;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 10px;
        }
        .stock-alto {
            background-color: #d1fae5;
            color: #065f46;
            padding: 3px 8px;
            border-radius: 10px;
            font-weight: bold;
            font-size: 10px;
        }
        .categoria-badge {
            background-color: #dbeafe;
            color: #1e40af;
            padding: 3px 8px;
            border-radius: 10px;
            font-size: 10px;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #64748b;
            font-size: 10px;
            border-top: 1px solid #cbd5e1;
            padding-top: 10px;
        }
        .totales {
            background-color: #eff6ff;
            padding: 15px;
            border-radius: 5px;
            margin-top: 20px;
            border: 2px solid #2563eb;
        }
        .totales h3 {
            color: #1e40af;
            margin: 0 0 10px 0;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>REPORTE DE PRODUCTOS</h1>
        <p>Sistema de Gestión de Inventario</p>
        <p><strong>Fecha de generación:</strong> {{ $fecha }}</p>
    </div>

    <div class="info-box">
        <p><strong>Total de productos registrados:</strong> {{ $total }}</p>
        <p><strong>Valor total en inventario:</strong> ${{ number_format($valorTotal, 2) }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 5%;">ID</th>
                <th style="width: 25%;">Nombre</th>
                <th style="width: 12%;">Precio</th>
                <th style="width: 10%;">Stock</th>
                <th style="width: 18%;">Categoría</th>
                <th style="width: 15%;">Valor Inv.</th>
                <th style="width: 15%;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($productos as $producto)
                @php
                    $valorInventario = $producto->precio * $producto->stock;
                    $estadoStock = $producto->stock < 10 ? 'bajo' : ($producto->stock < 50 ? 'medio' : 'alto');
                    $estadoTexto = $producto->stock < 10 ? 'Bajo' : ($producto->stock < 50 ? 'Medio' : 'Alto');
                @endphp
                <tr>
                    <td>{{ $producto->id }}</td>
                    <td><strong>{{ $producto->nombre }}</strong></td>
                    <td>${{ number_format($producto->precio, 2) }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>
                        <span class="categoria-badge">
                            {{ $producto->categoria->nombre ?? 'Sin categoría' }}
                        </span>
                    </td>
                    <td>${{ number_format($valorInventario, 2) }}</td>
                    <td>
                        <span class="stock-{{ $estadoStock }}">{{ $estadoTexto }}</span>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="totales">
        <h3>Resumen General</h3>
        <p><strong>Total de productos:</strong> {{ $total }}</p>
        <p><strong>Valor total del inventario:</strong> ${{ number_format($valorTotal, 2) }}</p>
        <p><strong>Stock total:</strong> {{ $productos->sum('stock') }} unidades</p>
        <p><strong>Productos con stock bajo (menos de 10):</strong> {{ $productos->where('stock', '<', 10)->count() }}</p>
    </div>

    <div class="footer">
        <p>Reporte generado automáticamente por el Sistema de Gestión de Inventario</p>
        <p>{{ $fecha }}</p>
    </div>
</body>
</html>
