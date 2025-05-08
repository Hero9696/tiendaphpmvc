<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Sistema de Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/public/css/dashboard.css">
</head>
<body>

<div class="container-fluid dashboard-box">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sistema de Inventario</h2>
        <a href="index.php?c=Auth&a=logout" class="btn btn-outline-secondary">Cerrar sesión</a>
    </div>

    <!-- Panel de acciones -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <a href="/productos" class="btn btn-primary w-100 p-3">
                <i class="bi bi-box-seam"></i>  Productos
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="index.php?c=Gasto&a=crear" class="btn btn-danger w-100 p-3">
                <i class="bi bi-cash-stack"></i> Registrar Gasto
            </a>
        </div>
        <div class="col-md-4 mb-3">
            <a href="/ventas" class="btn btn-success w-100 p-3">
                <i class="bi bi-receipt"></i> Ver Ventas
            </a>
        </div>
    </div>

    <!-- Resumen -->
    <div class="row">
        <div class="col-md-4 mb-3">
            <div class="card-summary bg-ventas">
                <h5>Total Ventas</h5>
                <h3>Q. <?php echo number_format($totalVentas ?? 0, 2); ?></h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card-summary bg-gastos">
                <h5>Total Gastos</h5>
                <h3>Q. <?php echo number_format($totalGastos ?? 0, 2); ?></h3>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card-summary bg-balance">
                <h5>Balance</h5>
                <h3>Q. <?php echo number_format(($totalVentas ?? 0) - ($totalGastos ?? 0), 2); ?></h3>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boots
