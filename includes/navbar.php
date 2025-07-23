<nav class="navbar">
    <div class="container">
        <div class="nav-content">
            <!-- Logo -->
            <div class="nav-logo">
                <a href="index.php">
                    <span class="logo-icon">📦</span>
                    <span class="logo-text">InvenTech</span>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="nav-menu" id="navMenu">
                <a href="index.php" class="nav-link <?php echo basename($_SERVER['PHP_SELF']) == 'index.php' ? 'active' : ''; ?>">Inicio</a>
                <a href="index.php#about" class="nav-link">Acerca de</a>
                <a href="index.php#news" class="nav-link">Noticias</a>
                <a href="index.php#footer" class="nav-link">Contacto</a>
            </div>

            <!-- Auth Section -->
            <div class="nav-auth">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="user-menu">
                        <span class="user-icon">👤</span>
                        <span class="user-name"><?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <a href="logout.php" class="btn btn-outline">Salir</a>
                    </div>
                <?php else: ?>
                    <div class="auth-buttons">
                        <a href="login.php" class="btn btn-outline">Iniciar Sesión</a>
                        <a href="register.php" class="btn btn-primary">Registrarse</a>
                    </div>
                <?php endif; ?>
            </div>

            <!-- Mobile menu button -->
            <div class="mobile-menu-btn" onclick="toggleMobileMenu()">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="index.php" class="mobile-link">Inicio</a>
            <a href="index.php#about" class="mobile-link">Acerca de</a>
            <a href="index.php#news" class="mobile-link">Noticias</a>
            <a href="index.php#footer" class="mobile-link">Contacto</a>
            
            <div class="mobile-auth">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <div class="mobile-user">
                        <span>👤 <?php echo htmlspecialchars($_SESSION['user_name']); ?></span>
                        <a href="logout.php" class="mobile-link logout">Salir</a>
                    </div>
                <?php else: ?>
                    <a href="login.php" class="mobile-link">Iniciar Sesión</a>
                    <a href="register.php" class="mobile-link primary">Registrarse</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

<script>
function toggleMobileMenu() {
    const mobileMenu = document.getElementById('mobileMenu');
    const menuBtn = document.querySelector('.mobile-menu-btn');
    
    mobileMenu.classList.toggle('active');
    menuBtn.classList.toggle('active');
}

// Cerrar menú móvil al hacer clic en un enlace
document.querySelectorAll('.mobile-link').forEach(link => {
    link.addEventListener('click', () => {
        document.getElementById('mobileMenu').classList.remove('active');
        document.querySelector('.mobile-menu-btn').classList.remove('active');
    });
});
</script>