<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Categorías</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between mb-3">
        <h3>Categorías</h3>
        <a href="/categoria/crear" class="btn btn-success">Nueva Categoría</a>
        <a href="/dashboard/productos" class="btn btn-success">Productos</a>
    </div>
    <table class="table table-striped">
        <thead>
            <tr><th>#</th><th>Nombre</th><th>Descripción</th><th>Creado</th><th>Acciones</th></tr>
        </thead>
        <tbody>
        <?php foreach($categorias as $c): ?>
            <tr>
                <td><?= $c['id'] ?></td>
                <td><?= htmlspecialchars($c['nombre']) ?></td>
                <td><?= htmlspecialchars($c['descripcion']) ?></td>
                <td><?= $c['fecha_creacion'] ?></td>
                <td>
                    <a href="/categoria/editar?id=<?= $c['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                    <form action="/categoria/eliminar" method="POST" class="d-inline">
                        <input type="hidden" name="id" value="<?= $c['id'] ?>">
                        <button class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar?')">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>