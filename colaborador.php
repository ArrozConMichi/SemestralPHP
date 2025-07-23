<?php
session_start();
require_once 'config/database.php';
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$preguntas_seguridad = [
    1 => "¿Cómo se llamó tu primera mascota?",
    2 => "¿Cuál es el nombre de tu ciudad natal?",
    3 => "¿Cuál fue tu primer colegio?",
    4 => "¿Cuál es tu comida favorita?",
    5 => "¿Cómo se llamaba tu mejor amigo de la infancia?"
];

$stmt = $pdo->prepare("SELECT id, name, email, pregunta_id, respuesta_seguridad FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$usuario) {
    echo "Usuario no encontrado.";
    exit;
}

$stmtEquipos = $pdo->prepare("SELECT id, nombre, tipo, cantidad, precio FROM equipos WHERE user_id = ?");
$stmtEquipos->execute([$usuario['id']]);
$equipos = $stmtEquipos->fetchAll(PDO::FETCH_ASSOC);

if (!isset($_SESSION['access_history'])) {
    $_SESSION['access_history'] = [];
}
$_SESSION['access_history'][] = date('d/m/Y - H:i:s');

$errorCambio = '';
$cambioExito = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $accion = $_POST['action'];
    $respuesta_seguridad_raw = $_POST['respuesta_seguridad'] ?? '';
    $respuesta_seguridad = strtolower(trim($respuesta_seguridad_raw));
    $nueva_pregunta_id = isset($_POST['pregunta_id']) ? intval($_POST['pregunta_id']) : $usuario['pregunta_id'];

    if ($accion === 'cambio' || $accion === 'recuperar') {
        $respuesta_pregunta = strtolower(trim($_POST['respuesta_pregunta'] ?? ''));
        $nueva_pass = $_POST['new_password'] ?? '';
        $confirm_pass = $_POST['confirm_password'] ?? '';

        if (!password_verify($respuesta_pregunta, $usuario['respuesta_seguridad'])) {
            $errorCambio = "Respuesta incorrecta a la pregunta de seguridad.";
        } elseif ($nueva_pass !== $confirm_pass) {
            $errorCambio = "Las contraseñas no coinciden.";
        } elseif (strlen($nueva_pass) < 6) {
            $errorCambio = "La contraseña debe tener al menos 6 caracteres.";
        } else {
            if ($accion === 'cambio') {
                $stmtPass = $pdo->prepare("SELECT password FROM users WHERE id = ?");
                $stmtPass->execute([$usuario['id']]);
                $hash_actual = $stmtPass->fetchColumn();
                $actual_pass = $_POST['actual_password'] ?? '';
                if (!password_verify($actual_pass, $hash_actual)) {
                    $errorCambio = "Contraseña actual incorrecta.";
                }
            }
        }

        if (empty($errorCambio)) {
            $nuevo_hash = password_hash($nueva_pass, PASSWORD_DEFAULT);
            $respuesta_hash = password_hash($respuesta_seguridad, PASSWORD_DEFAULT);
            $update = $pdo->prepare("UPDATE users SET password = ?, pregunta_id = ?, respuesta_seguridad = ? WHERE id = ?");
            $update->execute([$nuevo_hash, $nueva_pregunta_id, $respuesta_hash, $usuario['id']]);
            $cambioExito = ($accion === 'cambio') ? "Contraseña cambiada exitosamente." : "Contraseña recuperada y actualizada.";

            $stmt = $pdo->prepare("SELECT id, name, email, pregunta_id, respuesta_seguridad FROM users WHERE id = ?");
            $stmt->execute([$_SESSION['user_id']]);
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Portal del Colaborador</title>
    <link rel="stylesheet" href="styles/cola.css">
    <style>
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; text-align: center; }
        th { background: #007bff; color: white; }
        form { max-width: 400px; margin-bottom: 40px; }
        .btn-center { display: block; margin: 15px auto; }
        .link-recuperar { cursor: pointer; color: blue; text-decoration: underline; font-size: 0.9rem; margin-top: 10px; display: inline-block; }
    </style>
</head>
<body>
<div class="cola">
    <div class="container">
        <h1>Portal del Colaborador</h1>
        <h2>Bienvenido, <?= htmlspecialchars($usuario['name']) ?></h2>

        <h2>📅 Equipos Asignados</h2>
        <?php if (count($equipos) > 0): ?>
            <table>
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($equipos as $eq): ?>
                    <tr>
                        <td><?= $eq['id'] ?></td>
                        <td><?= htmlspecialchars($eq['nombre']) ?></td>
                        <td><?= htmlspecialchars($eq['tipo']) ?></td>
                        <td><?= $eq['cantidad'] ?></td>
                        <td>$<?= number_format($eq['precio'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>No tienes equipos asignados.</p>
        <?php endif; ?>

        <h2>🔐 Cambiar Contraseña</h2>
        <?php if ($cambioExito): ?>
            <p style="color:green; font-weight: bold;"><?= htmlspecialchars($cambioExito) ?></p>
        <?php elseif ($errorCambio): ?>
            <p style="color:red; font-weight: bold;"><?= htmlspecialchars($errorCambio) ?></p>
        <?php endif; ?>

        <form method="POST" onsubmit="return confirmarPreguntaCambio();">
            <input type="hidden" name="action" value="cambio">
            <label>Contraseña Actual:</label>
            <input type="password" name="actual_password" required>

            <label>Nueva Contraseña:</label>
            <input type="password" name="new_password" required>

            <label>Confirmar Nueva Contraseña:</label>
            <input type="password" name="confirm_password" required>

            <input type="hidden" id="respuesta_pregunta" name="respuesta_pregunta" value="">

            <button type="submit" class="btn btn-center">Cambiar Contraseña</button>
            <span class="link-recuperar" onclick="recuperarContrasena();">¿Olvidaste tu contraseña?</span>
        </form>

        <h2>📓 Historial de Accesos</h2>
        <ul>
            <?php foreach ($_SESSION['access_history'] as $acceso): ?>
                <li><?= htmlspecialchars($acceso) ?></li>
            <?php endforeach; ?>
        </ul>

        <div class="center" style="margin-top: 30px;">
            <a href="demo.php" class="btn">← Volver a Demo</a>
        </div>
    </div>
</div>
<script>
    function confirmarPreguntaCambio() {
        const pregunta = "<?= addslashes($preguntas_seguridad[$usuario['pregunta_id']] ?? 'Pregunta no disponible') ?>";
        const respuesta = prompt("Para cambiar la contraseña responde:\n\n" + pregunta);
        if (!respuesta) {
            alert("Debe responder la pregunta de seguridad para continuar.");
            return false;
        }
        document.getElementById('respuesta_pregunta').value = respuesta.toLowerCase().trim();
        return true;
    }

    function recuperarContrasena() {
        const pregunta = "<?= addslashes($preguntas_seguridad[$usuario['pregunta_id']] ?? 'Pregunta no disponible') ?>";
        const respuesta = prompt("Para recuperar tu contraseña responde:\n\n" + pregunta);
        if (!respuesta) return alert("Debes responder la pregunta.");
        const nueva = prompt("Nueva contraseña (mínimo 6 caracteres):");
        if (!nueva || nueva.length < 6) return alert("Contraseña inválida.");
        const confirma = prompt("Confirma tu nueva contraseña:");
        if (nueva !== confirma) return alert("Las contraseñas no coinciden.");

        const form = document.createElement('form');
        form.method = 'POST';
        form.style.display = 'none';
        form.appendChild(createInput('action', 'recuperar'));
        form.appendChild(createInput('respuesta_pregunta', respuesta.toLowerCase().trim()));
        form.appendChild(createInput('new_password', nueva));
        form.appendChild(createInput('confirm_password', confirma));
        document.body.appendChild(form);
        form.submit();
    }

    function createInput(name, value) {
        const input = document.createElement('input');
        input.name = name;
        input.value = value;
        return input;
    }
</script>
</body>
</html>
