<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sistema de Inventario - DEMO</title>
  <link rel="stylesheet" href="css/styles.css">
  <link rel="stylesheet" href="css/demo.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>

<?php
include 'includes/header.php';
include 'includes/navbar.php';
?>

<div class="demo">
  <div class="container">
    <h1>Sistema de Inventario - DEMO</h1>
    <p class="center">Esta es una versión de demostración con funcionalidades básicas activas como registro de ítems y reportes.</p>

    <div class="inventory-grid">
      <div class="card">
        <div class="card-icon">💻</div>
        <h3>Inventario de Hardware</h3>
        <p>Gestión de equipos físicos como laptops, routers, servidores, etc.</p>
      </div>
      <div class="card">
        <div class="card-icon">💾</div>
        <h3>Inventario de Software</h3>
        <p>Control de licencias, versiones, fechas de vencimiento y uso.</p>
      </div>
      <div class="card">
        <div class="card-icon">📦</div>
        <h3>Stock y Almacén</h3>
        <p>Seguimiento de entradas, salidas y niveles de stock.</p>
      </div>
      <div class="card">
        <div class="card-icon">📊</div>
        <h3>Reportes</h3>
        <p>Informes y estadísticas para tomar decisiones más inteligentes.</p>
      </div>
    </div>

    <h2>Beneficios</h2>
    <div class="benefits-grid">
      <div class="card">
        <div class="card-icon">📈</div>
        <h3>Reducción de Costos</h3>
        <p>Evita pérdidas y compras innecesarias.</p>
      </div>
      <div class="card">
        <div class="card-icon">🔒</div>
        <h3>Seguridad</h3>
        <p>Control de accesos y respaldo automático de datos.</p>
      </div>
      <div class="card">
        <div class="card-icon">⚙️</div>
        <h3>Automatización</h3>
        <p>Ahorro de tiempo y reducción de errores humanos.</p>
      </div>
    </div>

    <div class="center">
      <a href="registro.php" class="btn">Solicitar una Demostración</a>
    </div>

    <!-- Portal del Colaborador -->
    <h2>Portal del Colaborador</h2>
    <div class="collab-preview">
      <div class="card">
        <h3>Funcionalidades</h3>
        <ul>
          <li>✅ Ver equipos asignados</li>
          <li>✅ Cambiar contraseña</li>
          <li>✅ Recuperar acceso</li>
          <li>✅ Historial de accesos</li>
        </ul>
        <div class="center">
          <a href="colaborador.php" class="btn">Ver Portal del Colaborador</a>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
</body>
</html>
