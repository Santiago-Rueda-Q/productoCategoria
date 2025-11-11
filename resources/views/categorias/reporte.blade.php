<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Categorías</title>
    <style>
        @page {
            margin: 20mm 15mm;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            margin: 0;
            padding: 0;
            color: #333;
            line-height: 1.4;
        }

        .header {
            text-align: center;
            border-bottom: 3px solid #8E1616;
            padding-bottom: 15px;
            margin-bottom: 25px;
            background: linear-gradient(to bottom, #ffffff 0%, #f8f8f8 100%);
            padding-top: 10px;
        }

        .header img {
            width: 90px;
            height: auto;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 8px 0 5px 0;
            color: #8E1616;
            font-size: 22px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .header p {
            margin: 3px 0;
            color: #666;
            font-size: 11px;
        }

        .info-section {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 12px;
            margin-bottom: 20px;
            display: table;
            width: 100%;
        }

        .info-row {
            display: table-row;
        }

        .info-label {
            display: table-cell;
            font-weight: bold;
            color: #8E1616;
            padding: 4px 8px;
            width: 40%;
        }

        .info-value {
            display: table-cell;
            color: #333;
            padding: 4px 8px;
        }

        .stats-container {
            display: table;
            width: 100%;
            margin-bottom: 20px;
            border-spacing: 10px 0;
        }

        .stat-box {
            display: table-cell;
            background-color: #f5f5f5;
            border: 2px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            text-align: center;
            width: 33.33%;
        }

        .stat-box.total {
            border-color: #8E1616;
            background-color: #fff5f5;
        }

        .stat-box.activas {
            border-color: #16a34a;
            background-color: #f0fdf4;
        }

        .stat-box.inactivas {
            border-color: #dc2626;
            background-color: #fef2f2;
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
            margin: 5px 0;
        }

        .stat-box.total .stat-number {
            color: #8E1616;
        }

        .stat-box.activas .stat-number {
            color: #16a34a;
        }

        .stat-box.inactivas .stat-number {
            color: #dc2626;
        }

        .stat-label {
            font-size: 10px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        thead tr {
            background-color: #8E1616;
            color: white;
        }

        th {
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border: 1px solid #7a1414;
        }

        td {
            padding: 8px;
            border: 1px solid #ddd;
            font-size: 11px;
        }

        tbody tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tbody tr:hover {
            background-color: #f5f5f5;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 0.3px;
        }

        .status-activo {
            background-color: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }

        .status-inactivo {
            background-color: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .descripcion-cell {
            max-width: 300px;
            color: #555;
            font-style: italic;
        }

        .sin-descripcion {
            color: #999;
            font-style: italic;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #ddd;
            text-align: center;
            font-size: 9px;
            color: #888;
        }

        .footer p {
            margin: 3px 0;
        }

        .page-number {
            text-align: right;
            font-size: 9px;
            color: #888;
            margin-top: 10px;
        }

        /* Mejoras para impresión */
        @media print {
            body {
                print-color-adjust: exact;
                -webkit-print-color-adjust: exact;
            }

            .stat-box {
                page-break-inside: avoid;
            }

            table {
                page-break-inside: auto;
            }

            tr {
                page-break-inside: avoid;
                page-break-after: auto;
            }
        }

        .table-title {
            font-size: 14px;
            font-weight: bold;
            color: #8E1616;
            margin: 20px 0 10px 0;
            padding-left: 5px;
            border-left: 4px solid #8E1616;
        }
    </style>
</head>
<body>
    <!-- Encabezado -->
    <div class="header">
        <img src="{{ public_path('img/logo.png') }}" alt="Logo FESC">
        <h1>Reporte de Categorías</h1>
        <p>Unidad de Desarrollo — Fundación de Estudios Superiores Comfanorte</p>
    </div>

    <!-- Información del reporte -->
    <div class="info-section">
        <div class="info-row">
            <div class="info-label">Fecha de generación:</div>
            <div class="info-value">{{ $fecha ?? now()->format('d/m/Y H:i') }}</div>
        </div>
        <div class="info-row">
            <div class="info-label">Generado por:</div>
            <div class="info-value">Sistema de Gestión de Inventario</div>
        </div>
        <div class="info-row">
            <div class="info-label">Tipo de reporte:</div>
            <div class="info-value">Listado completo de categorías</div>
        </div>
    </div>

    <!-- Estadísticas resumidas -->
    @php
        $activas = $categorias->where('activo', true)->count();
        $inactivas = $categorias->where('activo', false)->count();
    @endphp

    <div class="stats-container">
        <div class="stat-box total">
            <div class="stat-label">Total Categorías</div>
            <div class="stat-number">{{ $total }}</div>
        </div>
        <div class="stat-box activas">
            <div class="stat-label">Activas</div>
            <div class="stat-number">{{ $activas }}</div>
        </div>
        <div class="stat-box inactivas">
            <div class="stat-label">Inactivas</div>
            <div class="stat-number">{{ $inactivas }}</div>
        </div>
    </div>

    <!-- Tabla de categorías -->
    <div class="table-title">Detalle de Categorías</div>

    <table>
        <thead>
            <tr>
                <th style="width: 8%;">ID</th>
                <th style="width: 25%;">Nombre</th>
                <th style="width: 47%;">Descripción</th>
                <th style="width: 20%; text-align: center;">Estado</th>
            </tr>
        </thead>
        <tbody>
            @forelse($categorias as $categoria)
                <tr>
                    <td style="text-align: center; font-weight: bold; color: #8E1616;">
                        {{ $categoria->id }}
                    </td>
                    <td style="font-weight: 600;">
                        {{ $categoria->nombre }}
                    </td>
                    <td class="descripcion-cell">
                        @if($categoria->descripcion)
                            {{ $categoria->descripcion }}
                        @else
                            <span class="sin-descripcion">Sin descripción</span>
                        @endif
                    </td>
                    <td style="text-align: center;">
                        @if($categoria->activo)
                            <span class="status-badge status-activo">✓ Activo</span>
                        @else
                            <span class="status-badge status-inactivo">✗ Inactivo</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" style="text-align: center; padding: 20px; color: #999;">
                        No hay categorías registradas
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- Pie de página -->
    <div class="footer">
        <p><strong>Fundación de Estudios Superiores Comfanorte - FESC</strong></p>
        <p>Sistema de Gestión de Inventario v1.0</p>
        <p>Este documento fue generado automáticamente el {{ $fecha ?? now()->format('d/m/Y') }} a las {{ now()->format('H:i') }} hrs</p>
    </div>

    <div class="page-number">
        Página 1 de 1
    </div>
</body>
</html>
