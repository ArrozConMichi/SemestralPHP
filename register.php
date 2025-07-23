 <?php
session_start();
include 'config/database.php';

$error = '';
$success = '';

if ($_POST) {
    $name = trim($_POST['name']);
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $company = trim($_POST['company']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $terms = isset($_POST['terms']);
    $pregunta_id = isset($_POST['pregunta_id']) ? intval($_POST['pregunta_id']) : 0;
    $respuesta_seguridad = trim($_POST['respuesta_seguridad']);
    
    // Validaciones
    if (
        empty($name) || empty($email) || empty($company) ||
        empty($password) || empty($confirm_password) ||
        $pregunta_id === 0 || empty($respuesta_seguridad)
    ) {
        $error = 'Por favor, completa todos los campos, incluyendo la pregunta y respuesta de seguridad';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error = 'Email no válido';
    } elseif (strlen($password) < 6) {
        $error = 'La contraseña debe tener al menos 6 caracteres';
    } elseif ($password !== $confirm_password) {
        $error = 'Las contraseñas no coinciden';
    } elseif (!$terms) {
        $error = 'Debes aceptar los términos y condiciones';
    } else {
        // Verificar si el email ya existe
        $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        
        if ($stmt->fetch()) {
            $error = 'Este email ya está registrado';
        } else {
            // Hashear password y respuesta de seguridad (normalizada en minúsculas)
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $hashed_respuesta = password_hash(strtolower($respuesta_seguridad), PASSWORD_DEFAULT);

            $stmt = $pdo->prepare("
                INSERT INTO users (name, email, company, password, pregunta_id, respuesta_seguridad, created_at)
                VALUES (?, ?, ?, ?, ?, ?, NOW())
            ");

            if ($stmt->execute([$name, $email, $company, $hashed_password, $pregunta_id, $hashed_respuesta])) {
                $success = 'Cuenta creada exitosamente. Puedes iniciar sesión ahora.';
                // Auto-login (opcional)
                $_SESSION['user_id'] = $pdo->lastInsertId();
                $_SESSION['user_name'] = $name;
                $_SESSION['user_email'] = $email;
                header('Location: index.php');
                exit;
            } else {
                $error = 'Error al crear la cuenta. Inténtalo de nuevo.';
            }
        }
    }
}

include 'includes/header.php';
?>

<div class="auth-container">
    <div class="auth-card">
        <div class="auth-header">
            <h2>Crear Cuenta</h2>
            <p>Únete a InvenTech y optimiza tu inventario</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <?php if ($success): ?>
            <div class="alert alert-success"><?php echo htmlspecialchars($success); ?></div>
        <?php endif; ?>
        
        <form method="POST" class="auth-form">
            <div class="form-group">
                <label for="name">Nombre Completo</label>
                <div class="input-group">
                    <span class="input-icon">👤</span>
                    <input type="text" id="name" name="name" placeholder="Tu nombre completo" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="input-icon">📧</span>
                    <input type="email" id="email" name="email" placeholder="tu@email.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="company">Empresa</label>
                <div class="input-group">
                    <span class="input-icon">🏢</span>
                    <input type="text" id="company" name="company" placeholder="Nombre de tu empresa" value="<?php echo isset($_POST['company']) ? htmlspecialchars($_POST['company']) : ''; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="pregunta_id">Pregunta de Seguridad</label>
                <select name="pregunta_id" id="pregunta_id" required>
                    <option value="">Selecciona una pregunta</option>
                    <option value="1" <?php if(isset($_POST['pregunta_id']) && $_POST['pregunta_id'] == 1) echo 'selected'; ?>>¿Cómo se llamó tu primera mascota?</option>
                    <option value="2" <?php if(isset($_POST['pregunta_id']) && $_POST['pregunta_id'] == 2) echo 'selected'; ?>>¿Cuál es el nombre de tu ciudad natal?</option>
                    <option value="3" <?php if(isset($_POST['pregunta_id']) && $_POST['pregunta_id'] == 3) echo 'selected'; ?>>¿Cuál fue tu primer colegio?</option>
                    <option value="4" <?php if(isset($_POST['pregunta_id']) && $_POST['pregunta_id'] == 4) echo 'selected'; ?>>¿Cuál es tu comida favorita?</option>
                    <option value="5" <?php if(isset($_POST['pregunta_id']) && $_POST['pregunta_id'] == 5) echo 'selected'; ?>>¿Cómo se llamaba tu mejor amigo de la infancia?</option>
                </select>
            </div>

            <div class="form-group">
                <label for="respuesta_seguridad">Respuesta de Seguridad</label>
                <div class="input-group">
                    <span class="input-icon">❓</span>
                    <input type="text" id="respuesta_seguridad" name="respuesta_seguridad" placeholder="Tu respuesta secreta" value="<?php echo isset($_POST['respuesta_seguridad']) ? htmlspecialchars($_POST['respuesta_seguridad']) : ''; ?>" required>
                </div>
            </div>

            <div class="form-group">
                <label for="password">Contraseña</label>
                <div class="input-group">
                    <span class="input-icon">🔒</span>
                    <input type="password" id="password" name="password" placeholder="Tu contraseña" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('password')">👁️</button>
                </div>
            </div>

            <div class="form-group">
                <label for="confirm_password">Confirmar Contraseña</label>
                <div class="input-group">
                    <span class="input-icon">🔒</span>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirma tu contraseña" required>
                    <button type="button" class="toggle-password" onclick="togglePassword('confirm_password')">👁️</button>
                </div>
            </div>

            <div class="form-group">
                <label class="checkbox-label">
                    <input type="checkbox" name="terms" required>
                    <span class="checkmark"></span>
                    Acepto los <a href="#">términos y condiciones</a>
                </label>
            </div>

            <button type="submit" class="btn btn-primary btn-full">Crear Cuenta</button>
        </form>

        <div class="auth-footer">
            <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión aquí</a></p>
        </div>
    </div>
</div>

<script>
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const button = field.nextElementSibling;
    
    if (field.type === 'password') {
        field.type = 'text';
        button.textContent = '🙈';
    } else {
        field.type = 'password';
        button.textContent = '👁️';
    }
}
</script>

<?php include 'includes/footer.php'; ?>
