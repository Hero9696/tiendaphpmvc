<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? 'Mi Chat' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="d-flex flex-column min-vh-100">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm mb-4">
        <div class="container">
            <a class="navbar-brand" href="/">Mi Tienda</a>
            <div class="collapse navbar-collapse justify-content-end">
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/chat">Chat</a>
                        </li>
                        <li class="nav-item">
                            <a  class="nav-link" id="cerrarSesion" href="/logout">Cerrar sesión</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="/">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/logout">Registro</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenido principal -->
    <main class="container d-flex justify-content-center align-items-center flex-grow-1">
        <!-- Se centra el contenido del main -->
        <div class="w-100">
            <?= $content ?? '' ?>
        </div>
    </main>

    <!-- Footer -->
    <footer class="bg-light text-center py-3 mt-4 border-top">
        <div class="container">
            <span class="text-muted">&copy; <?= date('Y') ?> Mi tiendita - Todos los derechos reservados.</span>
        </div>
    </footer>



</body>
</html>