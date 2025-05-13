<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Mi Tienda' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    main { flex: 1; }
    .offcanvas-body .btn {
      text-align: left;
      margin-bottom: .5rem;
      width: 100%;
      border-radius: .5rem;
      padding: .75rem 1rem;
      font-weight: 500;
    }
    .offcanvas-body .btn:hover {
      background-color: #e9ecef;
    }
  </style>
</head>
<body>

  <!-- Navbar con botón de togglear sidebar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm">
    <div class="container">
      <button class="btn btn-outline-light me-2" type="button"
              data-bs-toggle="offcanvas" data-bs-target="#offcanvasSidebar"
              aria-controls="offcanvasSidebar">
        <i class="bi bi-list"></i>
      </button>
      <a class="navbar-brand fw-bold" href="/">🛍️ Mi Tienda</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
          <?php if (isset($_COOKIE['token'])): ?>
            
            <li class="nav-item"><a class="nav-link" href="/logout">Cerrar sesión</a></li>
          <?php else: ?>
            <li class="nav-item"><a class="nav-link" href="/">Login</a></li>
            <li class="nav-item"><a class="nav-link" href="/register">Registro</a></li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>

   <!-- Offcanvas Sidebar -->
  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasSidebar" aria-labelledby="offcanvasSidebarLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title text-primary" id="offcanvasSidebarLabel">Menú</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Cerrar"></button>
    </div>
    <div class="offcanvas-body">
      <a href="/dashboard" class="btn btn-outline-primary">
        <i class="bi bi-speedometer2 me-2"></i> Dashboard
      </a>
      <a href="/dashboard/productos" class="btn btn-outline-secondary">
        <i class="bi bi-box-seam me-2"></i> Productos
      </a>
      <a href="/dashboard/gastos" class="btn btn-outline-secondary">
        <i class="bi bi-cash-stack me-2"></i> Gastos
      </a>
      <a href="/dashboard/ventas" class="btn btn-outline-secondary">
        <i class="bi bi-receipt me-2"></i> Ventas
      </a>
      <a href="/dashboard/config" class="btn btn-outline-secondary">
        <i class="bi bi-gear me-2"></i> Configuración
      </a>
    </div>
  </div>


  <!-- Contenido principal -->
  <main class="container my-5">
    <div class="row gx-4">
      <div class="col-12">
        <div class="bg-white p-4 shadow rounded">
          <?= $content ?? '' ?>
        </div>
      </div>
    </div>
  </main>

  <!-- Footer -->
  <footer class="bg-primary text-white text-center py-3 mt-auto shadow-sm">
    <div class="container">
      <small>&copy; <?= date('Y') ?> Mi Tiendita – Todos los derechos reservados.</small>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
