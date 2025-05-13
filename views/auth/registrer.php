<!-- views/auth/registrer.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Usuario | Sistema de Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #f8f9fa, #e0f7fa);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .register-box {
            background-color: #ffffff;
            padding: 2rem;
            border-radius: 1.5rem;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
        }
        .register-header {
            font-family: 'Segoe UI', sans-serif;
            font-weight: bold;
            color: #0d6efd;
        }
    </style>
</head>
<body>
<div class="register-box text-center">
    
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
            <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico" required>
            <label for="email">Correo electrónico</label>
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control" name="clave" id="clave" placeholder="Contraseña" required>
            <label for="clave">Contraseña</label>
        </div>

       <div class="form-floating mb-3">
  <select class="form-select" name="rol" id="rol" required>
      <option value="" disabled selected>Seleccione un rol</option>
      <?php foreach($roles as $r): ?>
          <option value="<?= htmlspecialchars($r['id']) ?>">
              <?= htmlspecialchars($r['nombre']) ?>
          </option>
      <?php endforeach; ?>
  </select>
  <label for="rol">Rol de usuario</label>
</div>

        <button class="btn btn-success w-100" type="submit">Registrar Usuario</button>
    </form>

    <div class="mt-3">
        <a href="/" class="btn btn-link">¿Ya tienes cuenta? Inicia sesión</a>
    </div>

    <div class="mt-3 text-muted small">
        &copy; <?= date("Y") ?> Sistema Inventario para Tiendas Rurales
    </div>
</div>
</body>
</html>
