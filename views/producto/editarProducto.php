<!-- views/producto/editar.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Producto | Sistema de Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f0f2f5; }
        .form-box {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 2rem;
            max-width: 700px;
            margin: 3rem auto;
        }
        .form-title { font-weight: bold; color: #0d6efd; }
    </style>
</head>
<body>

<div class="form-box">
    <h3 class="text-center form-title mb-4">Editar Producto</h3>

    <!-- Paso 1: Buscar por código -->
    <form method="GET" action="/buscar" class="mb-4">
        <div class="input-group">
            <input
                type="text"
                name="codigo"
                id="codigo"
                class="form-control"
                placeholder="Ingresa código del producto"
                value="<?= htmlspecialchars($_GET['codigo'] ?? '') ?>"
                required>
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    </form>

    <!-- Paso 2: Si se encontró el producto, mostrar formulario de edición -->
    <?php if (!empty($producto)): ?>
        <form method="POST" action="/producto/actualizar">
            <input type="hidden" name="id" value="<?= $producto['id'] ?>">

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="nombre"
                    name="nombre"
                    placeholder="Nombre del producto"
                    value="<?= htmlspecialchars($producto['nombre']) ?>"
                    required>
                <label for="nombre">Nombre del producto</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="text"
                    class="form-control"
                    id="codigo"
                    name="codigo"
                    placeholder="Código del producto"
                    value="<?= htmlspecialchars($producto['codigo']) ?>"
                    required>
                <label for="codigo">Código</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="number"
                    step="0.01"
                    class="form-control"
                    id="precio_compra"
                    name="precio_compra"
                    placeholder="Precio de compra"
                    value="<?= number_format($producto['precio_compra'], 2, '.', '') ?>"
                    required>
                <label for="precio_compra">Precio de compra (Q)</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="number"
                    step="0.01"
                    class="form-control"
                    id="precio_venta"
                    name="precio_venta"
                    placeholder="Precio de venta"
                    value="<?= number_format($producto['precio_venta'], 2, '.', '') ?>"
                    required>
                <label for="precio_venta">Precio de venta (Q)</label>
            </div>

            <div class="form-floating mb-3">
                <input
                    type="number"
                    class="form-control"
                    id="stock"
                    name="stock"
                    placeholder="Stock actual"
                    value="<?= htmlspecialchars($producto['stock']) ?>"
                    required>
                <label for="stock">Stock actual</label>
            </div>

            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoría</label>
                <select class="form-select" id="id_categoria" name="id_categoria" required>
                    <option value="">Seleccione una categoría</option>
                    <?php foreach ($categorias as $cat): ?>
                        <option
                            value="<?= $cat['id'] ?>"
                            <?= $cat['id'] == $producto['id_categoria'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($cat['nombre']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <button type="submit" class="btn btn-warning w-100">Actualizar Producto</button>
        </form>
    <?php elseif (isset($_GET['codigo'])): ?>
        <div class="alert alert-danger text-center">
            No se encontró ningún producto con el código <strong><?= htmlspecialchars($_GET['codigo']) ?></strong>.
        </div>
    <?php endif; ?>

    <div class="mt-4 text-center">
        <a href="/dashboard/productos" class="btn btn-link">Volver al Dashboard</a>
    </div>
</div>

</body>
</html>
