<!-- views/auth/login.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inicio de Sesión | Sistema de Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/login.css"> <!-- Asegúrate de que la ruta sea correcta -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOM8d7x1z5l5e5c5e5e5e5e5e5e5e5e5e5e5e5" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

<div class="login-box text-center">
    <h3 class="login-header mb-4">Sistema de Tienda</h3>

    <form action="/login" method="POST">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario" required>
            <label for="usuario">Usuario</label>
        </div>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña" required>
            <label for="clave">Contraseña</label>
        </div>
        <button class="btn btn-primary w-100" type="submit">Iniciar Sesión</button>
    </form>
    <a href="/registerform" class="btn btn-outline-secondary w-100 mt-3">Registrarse</a>

    <div class="mt-4 text-muted small">
        &copy; <?php echo date("Y"); ?> Sistema Inventario para Tiendas Rurales
    </div>
</div>

</body>
</html>

