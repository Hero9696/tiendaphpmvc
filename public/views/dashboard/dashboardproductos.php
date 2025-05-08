<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard de Productos | Sistema de Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
        }
        .product-table th, .product-table td {
            text-align: center;
        }
        .panel {
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <div class="row">
        <!-- Paneles para Crear, Editar y Añadir Stock -->
        <div class="col-md-4">
            <div class="panel card">
                <div class="card-body text-center">
                    <h5 class="card-title">Crear Producto</h5>
                    <a href="/producto/crear" class="btn btn-success w-100">Nuevo Producto</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel card">
                <div class="card-body text-center">
                    <h5 class="card-title">Editar Producto</h5>
                    <a href="/producto/editar" class="btn btn-warning w-100">Editar Producto</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="panel card">
                <div class="card-body text-center">
                    <h5 class="card-title">Añadir Stock</h5>
                    <a href="/producto/añadirStock" class="btn btn-primary w-100">Añadir Stock</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Tabla de Productos -->
    <div class="mt-4">
        <h3 class="text-center mb-4">Productos con Menor Stock</h3>
        <table class="table table-bordered product-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Código</th>
                    <th>Stock</th>
                    <th>Precio de Compra</th>
                    <th>Precio de Venta</th>
                 
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td><?= $producto['id'] ?></td>
                        <td><?= htmlspecialchars($producto['nombre']) ?></td>
                        <td><?= htmlspecialchars($producto['codigo']) ?></td>
                        <td><?= $producto['stock'] ?></td>
                        <td>Q <?= number_format($producto['precio_compra'], 2) ?></td>
                        <td>Q <?= number_format($producto['precio_venta'], 2) ?></td>
                     
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

</body>
</html>
