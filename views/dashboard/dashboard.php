<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard | Sistema de Tienda</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/public/css/dashboard.css">
</head>
<body>
<style>
    
body {
    background-color: #f1f3f5;
}
.dashboard-box {
    padding: 2rem;
}
.card-icon {
    font-size: 2rem;
    color: #fff;
}
.card {
    border: none;
    border-radius: 1rem;
}
.card-summary {
    color: #fff;
    padding: 1rem;
    border-radius: 1rem;
}
.bg-ventas {
    background: linear-gradient(135deg, #28a745, #218838);
}
.bg-gastos {
    background: linear-gradient(135deg, #dc3545, #c82333);
}
.bg-balance {
    background: linear-gradient(135deg, #007bff, #0056b3);
}
</style>
<div class="container-fluid dashboard-box">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Sistema de Inventario</h2>
        <a href="/logout" class="btn btn-outline-secondary">Cerrar sesión</a>
    </div>

    <!-- Panel de acciones -->
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <a href="/dashboard/productos" class="btn btn-primary w-100 p-3">
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
        <div class="col-md-4 mb-3">
            <a href="/proveedores" class="btn btn-success w-100 p-3">
                <i class="bi bi-receipt"></i> Proveedores
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
