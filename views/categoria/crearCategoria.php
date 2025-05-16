<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear Categoría</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5 col-md-6">
    <div class="bg-white p-4 rounded shadow">
        <h3 class="mb-4">Nueva Categoría</h3>
        <form method="POST" action="/categoria/crear">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="4"></textarea>
            </div>
            <button class="btn btn-primary">Guardar</button>
            <a href="/dashboard/categorias" class="btn btn-link">Volver</a>
        </form>
    </div>
</div>
</body>
</html>