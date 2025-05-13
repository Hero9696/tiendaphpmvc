<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title><?= $title ?? 'Login – Mi Tienda' ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f0f2f5;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }
    .login-container {
      background: #ffffff;
      padding: 2.5rem;
      border-radius: 1rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
    }
    .login-header {
      font-size: 1.5rem;
      font-weight: bold;
      color: #0d6efd;
      margin-bottom: 1.5rem;
      text-align: center;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <div class="login-header">
      <?= $title ?? 'Iniciar Sesión' ?>
    </div>
    <?= $content ?? '' ?>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
