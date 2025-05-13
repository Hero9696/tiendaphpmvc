<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto | Sistema de Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/crearProducto.css">
</head>
<body>

<div class="container mt-5">
    <div class="form-box">
        <h3 class="text-center form-title mb-4">Registrar Nuevo Producto</h3>

        <form action="/guardar" method="POST">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Nombre del producto" required>
                <label for="nombre">Nombre del producto</label>
            </div>

            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Código del producto" required>
                <label for="codigo">Código</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" step="0.01" class="form-control" id="precio_compra" name="precio_compra" placeholder="Precio de compra" required>
                <label for="precio_compra">Precio de compra (Q)</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" step="0.01" class="form-control" id="precio_venta" name="precio_venta" placeholder="Precio de venta" required>
                <label for="precio_venta">Precio de venta (Q)</label>
            </div>

            <div class="form-floating mb-3">
                <input type="number" class="form-control" id="stock" name="stock" placeholder="Stock inicial" required>
                <label for="stock">Stock inicial</label>
            </div>

            <div class="mb-3">
                <label for="unidad_medida" class="form-label">Unidad de Medida</label>
                <select class="form-select" id="unidad_medida" name="unidad_medida" required>
                    <option value="">Seleccione una unidad</option>
                    <option value="unidad">Unidad</option>
                    <option value="litro">Litro</option>
                    <option value="kg">Kilogramo</option>
                    <option value="paquete">Paquete</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoría</label>
                <select class="form-select" id="id_categoria" name="id_categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="id_proveedor" class="form-label">Proveedor</label>
                <select class="form-select" id="id_proveedor" name="id_proveedor" required>
                    <option value="">Seleccione un proveedor</option>
                    <?php foreach ($proveedores as $prov): ?>
                        <option value="<?= $prov['id'] ?>"><?= htmlspecialchars($prov['nombre']) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="form-floating mb-3">
                <input type="date" class="form-control" id="fecha_ingreso" name="fecha_ingreso" required>
                <label for="fecha_ingreso">Fecha de ingreso</label>
            </div>

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox" name="activo" id="activo" checked>
                <label class="form-check-label" for="activo">Producto activo</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Guardar Producto</button>

            <div class="mt-3 text-center">
                <a href="/dashboard/productos" class="btn btn-link">Volver al Dashboard</a>
            </div>
        </form>
    </div>
</div>

</body>
</html>
