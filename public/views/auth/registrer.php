<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario | Sistema de Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/register.css"> <!-- Asegúrate de que la ruta sea correcta -->
</head>
<body>

<div class="register-box text-center">
    <img src="public/img/shop-icon.png" alt="Logo Tienda" class="logo mb-3">
    <h3 class="register-header mb-4">Registro de Usuario</h3>

    <form action="/register" method="POST">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre completo" required>
            <label for="nombre">Nombre completo</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
            <label for="usuario">Usuario</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña" required>
            <label for="clave">Contraseña</label>
        </div>
        <div class="form-floating mb-3">
            <select class="form-select" name="rol" id="rol" required>
                <option value="" selected disabled>Seleccione un rol</option>
                <option value="admin">Administrador</option>
                <option value="vendedor">Vendedor</option>
            </select>
            <label for="rol">Rol de usuario</label>
        </div>
        <button class="btn btn-success w-100" type="submit">Registrar Usuario</button>
    </form>

    <div class="mt-3">
        <a href="index.php?c=Auth&a=login" class="btn btn-link">¿Ya tienes cuenta? Inicia sesión</a>
    </div>

    <div class="mt-3 text-muted small">
        &copy; <?php echo date("Y"); ?> Sistema Inventario para Tiendas Rurales
    </div>
</div>

</body>
</html>
