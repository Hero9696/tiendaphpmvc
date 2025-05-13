<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Dashboard de Productos | Sistema de Tienda</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .card { margin-bottom: 20px; }
    .product-table th, .product-table td { text-align: center; }
    .panel { margin-bottom: 30px; }
  </style>
</head>
<body>
<div class="container mt-5">
  <div class="row mb-4">
    <a href="/dashboard" class="btn btn-link">Volver al Dashboard</a>
  </div>

  <!-- FORMULARIO DE BÚSQUEDA Y FILTROS -->
  <form class="row g-3 mb-4" method="GET" action="/dashboard/productos">
    <div class="col-md-4">
      <input
        type="text"
        name="search"
        class="form-control"
        placeholder="Buscar por nombre, código o categoría"
        value="<?= htmlspecialchars($search) ?>">
    </div>
    <div class="col-md-3">
      <select name="stock_filter" class="form-select">
        <option value="">Todos los stocks</option>
        <option value="low"  <?= $stockFilter==='low'  ? 'selected' : '' ?>>Menos de 5 unidades</option>
        <option value="mid"  <?= $stockFilter==='mid'  ? 'selected' : '' ?>> Unidades  entre 6 y 10 </option>
        <option value="high" <?= $stockFilter==='high' ? 'selected' : '' ?>>Mayor a 10 unidades</option>
      </select>
    </div>
    <div class="col-md-3">
      <select name="categoria" class="form-select">
        <option value="">Todas las categorías</option>
        <?php foreach($categorias as $cat): ?>
          <option value="<?= $cat['id'] ?>"
            <?= $categoriaId==$cat['id'] ? 'selected' : '' ?>>
            <?= htmlspecialchars($cat['nombre']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-2 text-end">
      <button type="submit" class="btn btn-primary w-100">Filtrar</button>
    </div>
  </form>

  <!-- PANEL DE ACCIONES -->
  <div class="row mb-4">
    <div class="col-md-4">
      <div class="panel card">
        <div class="card-body text-center">
          <h5 class="card-title">Crear Producto</h5>
          <a href="/producto/crear" class="btn btn-success w-100">Nuevo</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel card">
        <div class="card-body text-center">
          <h5 class="card-title">Editar Producto</h5>
          <a href="/producto/editar" class="btn btn-warning w-100">Editar</a>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="panel card">
        <div class="card-body text-center">
          <h5 class="card-title">Añadir Categorias</h5>
          <a href="/producto/añadirStock" class="btn btn-primary w-100">Añadir</a>
        </div>
      </div>
    </div>
  </div>

  <!-- TABLA DE PRODUCTOS FILTRADOS -->
  <div class="mt-4">
    <h3 class="text-center mb-4">Productos con Menor Stock</h3>
    <table class="table table-bordered product-table">
      <thead>
        <tr>
          <th>Nombre</th>
          <th>Código</th>
          <th>Categoría</th>
          <th>Stock</th>
          <th>Precio Compra</th>
          <th>Precio Venta</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($productos as $p):
          $stock = (int)$p['stock'];
          $rowClass = $stock<=5 ? 'table-danger'
                    : ($stock<=10 ? 'table-warning' : '');
        ?>
          <tr class="<?= $rowClass ?>">
            <td><?= htmlspecialchars($p['nombre']) ?></td>
            <td><?= htmlspecialchars($p['codigo']) ?></td>
            <td><?= htmlspecialchars($p['categoria_nombre']) ?></td>
            <td><?= $stock ?></td>
            <td>Q <?= number_format($p['precio_compra'],2) ?></td>
            <td>Q <?= number_format($p['precio_venta'],2) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <!-- ... después de </table> ... -->
<?php if ($totalPages > 1): ?>
<nav aria-label="Páginas">
  <ul class="pagination justify-content-center">
    <!-- Anterior -->
    <li class="page-item <?= $currentPage<=1 ? 'disabled' : '' ?>">
      <a class="page-link" href="?<?= http_build_query(array_merge($_GET,['page'=>$currentPage-1])) ?>">
        &laquo; Anterior
      </a>
    </li>

    <!-- Números de página -->
    <?php for($i=1; $i<=$totalPages; $i++): ?>
      <li class="page-item <?= $i===$currentPage ? 'active' : '' ?>">
        <a class="page-link" href="?<?= http_build_query(array_merge($_GET,['page'=>$i])) ?>">
          <?= $i ?>
        </a>
      </li>
    <?php endfor; ?>

    <!-- Siguiente -->
    <li class="page-item <?= $currentPage>=$totalPages ? 'disabled' : '' ?>">
      <a class="page-link" href="?<?= http_build_query(array_merge($_GET,['page'=>$currentPage+1])) ?>">
        Siguiente &raquo;
      </a>
    </li>
  </ul>
</nav>
<?php endif; ?>

  </div>
</div>
</body>
</html>
