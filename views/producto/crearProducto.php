<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Producto | Sistema de Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="/public/css/crearProducto.css0">
</head>
<body>

<div class="form-box">
    <h3 class="text-center form-title mb-4">Registrar Nuevo Producto</h3>

    <form action="/guardar" method="POST" >
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
            <label for="id_categoria" class="form-label">Categoría</label>
            <select class="form-select" id="id_categoria" name="id_categoria" required>
                <option value="">Seleccione una categoría</option>
                <?php foreach ($categorias as $cat): ?>
                    <option value="<?= $cat['id'] ?>"><?= htmlspecialchars($cat['nombre']) ?></option>
                    
                <?php endforeach; ?>
                <option value="2">Granos y Cereales </option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary w-100">Guardar Producto</button>
        <div class="mt-3 text-center">
            <a href="/dashboard/productos" class="btn btn-link">Volver al Dashboard</a>
        </div>
    </form>
</div>

</body>
</html>
