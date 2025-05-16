<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Proveedor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 col-md-6">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="mb-4">Editar Proveedor</h3>
        <form method="POST" action="/proveedor/editar">
            <input type="hidden" name="id" value="<?= $proveedor['id'] ?>">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" value="<?= htmlspecialchars($proveedor['nombre']) ?>" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Contacto</label>
                <input type="text" name="contacto" value="<?= htmlspecialchars($proveedor['contacto']) ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Teléfono</label>
                <input type="text" name="telefono" value="<?= htmlspecialchars($proveedor['telefono']) ?>" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($proveedor['email']) ?>" class="form-control">
            </div>
            <button class="btn btn-warning">Actualizar</button>
            <a href="/dashboard/proveedores" class="btn btn-link">Volver</a>
        </form>
    </div>
</div>
</body>
</html>