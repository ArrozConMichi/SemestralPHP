<?php
session_start();
require_once 'config/database.php'; // tu conexión PDO $pdo

// Redirigir si no hay usuario logueado
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$user_id = $_SESSION['user_id'];
$mensaje = '';
$error = '';

// Guardar equipo en la base de datos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['nombre'], $_POST['cantidad'], $_POST['tipo'], $_POST['precio'])) {
    $nombre = trim($_POST['nombre']);
    $cantidad = intval($_POST['cantidad']);
    $tipo = trim($_POST['tipo']);
    $precio = floatval($_POST['precio']);

    if ($nombre && $cantidad > 0 && $tipo && $precio >= 0) {
        try {
            $stmt = $pdo->prepare("INSERT INTO equipos (nombre, tipo, cantidad, precio, user_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$nombre, $tipo, $cantidad, $precio, $user_id]);
            $mensaje = "Equipo registrado exitosamente.";
        } catch (PDOException $e) {
            $error = "Error al guardar: " . $e->getMessage();
        }
    } else {
        $error = "Todos los campos son obligatorios y deben ser válidos.";
    }
}

// Consultar los equipos del usuario
$stmt = $pdo->prepare("SELECT id, nombre, tipo, cantidad, precio FROM equipos WHERE user_id = ?");
$stmt->execute([$user_id]);
$equipos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Preparar datos para la gráfica
$tipos = ['Computadora' => 0, 'Teléfono' => 0, 'Software' => 0, 'Otro' => 0];
foreach ($equipos as $equipo) {
    $clave = $equipo['tipo'];
    if (isset($tipos[$clave])) {
        $tipos[$clave] += $equipo['cantidad'];
    } else {
        $tipos['Otro'] += $equipo['cantidad'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Registro Inventario - DEMO</title>
  <link rel="stylesheet" href="css/demo.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<div class="demo">
  <div class="container">
    <h1>Registro Inventario - DEMO</h1>

    <?php if ($mensaje): ?>
      <p style="color:green;"><?= htmlspecialchars($mensaje) ?></p>
    <?php elseif ($error): ?>
      <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" class="add-item-form">
      <h2>Agregar Nuevo Equipo</h2>

      <label for="tipo">Tipo:</label>
      <select name="tipo" id="tipo" required>
        <option value="">Selecciona tipo</option>
        <option value="Computadora">Computadora</option>
        <option value="Teléfono">Teléfono</option>
        <option value="Software">Software</option>
        <option value="Otro">Otro</option>
      </select>

      <label for="nombre">Nombre del equipo/item:</label>
      <input type="text" name="nombre" id="nombre" required>

      <label for="cantidad">Cantidad:</label>
      <input type="number" name="cantidad" id="cantidad" min="1" value="1" required>

      <label for="precio">Precio:</label>
      <input type="number" step="0.01" min="0" name="precio" id="precio" value="0.00" required>

      <button type="submit" class="btn">Agregar</button>
    </form>

    <h2>Equipos Registrados</h2>
    <?php if ($equipos): ?>
    <table>
      <thead>
        <tr>
          <th>ID</th>
          <th>Tipo</th>
          <th>Nombre</th>
          <th>Cantidad</th>
          <th>Precio</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($equipos as $e): ?>
          <tr>
            <td><?= htmlspecialchars($e['id']) ?></td>
            <td><?= htmlspecialchars($e['tipo']) ?></td>
            <td><?= htmlspecialchars($e['nombre']) ?></td>
            <td><?= htmlspecialchars($e['cantidad']) ?></td>
            <td>$<?= number_format($e['precio'], 2) ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <?php else: ?>
      <p>No hay equipos registrados.</p>
    <?php endif; ?>

    <h2>Gráfica de Inventario por Tipo</h2>
    <canvas id="inventoryChart" width="600" height="300"></canvas>

    <div class="center" style="margin-top: 30px;">
      <a href="demo.php" class="btn">Regresar a Demo</a>
    </div>
  </div>
</div>

<script>
  const ctx = document.getElementById('inventoryChart').getContext('2d');
  const tipos = <?= json_encode($tipos) ?>;
  const colors = ['#007bff', '#28a745', '#ffc107', '#6c757d'];

  const dataSets = Object.keys(tipos).map((tipo, i) => ({
    label: tipo,
    data: [tipos[tipo]],
    backgroundColor: colors[i],
  }));

  new Chart(ctx, {
    type: 'bar',
    data: {
      labels: ['Cantidad total'],
      datasets: dataSets
    },
    options: {
      responsive: true,
      scales: {
        y: { beginAtZero: true, precision: 0 }
      }
    }
  });
</script>
</body>
</html>
