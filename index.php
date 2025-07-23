<?php
session_start();
include 'includes/header.php';
include 'includes/navbar.php';
?>

<!-- Hero Section -->
<section class="hero-section" id="inicio">
    <div class="container">
        <div class="hero-content">
            <h1>Gestión Inteligente de <span class="highlight">Inventario</span></h1>
            <p class="hero-description">
                Optimiza tu negocio con nuestro sistema avanzado de inventario. 
                Control total de hardware y software en tiempo real.
            </p>
            
            <div class="hero-buttons" style="text-align: center;">
                <a href="demo.php" class="btn btn-primary">Ver Demo</a>
            </div>



        <!-- Features Grid -->
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">🛡️</div>
                <h3>Seguridad Total</h3>
                <p>Protección avanzada de datos con respaldos automáticos y acceso controlado</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Análisis Avanzado</h3>
                <p>Reportes detallados y métricas en tiempo real para tomar mejores decisiones</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">⏰</div>
                <h3>Tiempo Real</h3>
                <p>Monitoreo instantáneo de stock, movimientos y alertas automáticas</p>
            </div>
        </div>
    </div>
</section>

<!-- News Section -->
<section class="news-section" id="news">
    <div class="container">
        <div class="section-header">
            <h2>Últimas Noticias</h2>
            <p>Mantente actualizado con las últimas tendencias en gestión de inventario, hardware y software empresarial</p>
        </div>

        <div class="news-grid">
            <?php
            $news = [
                [
                    'id' => 1,
                    'title' => 'La Importancia del Control de Inventario de Hardware en 2024',
                    'excerpt' => 'Descubre cómo un sistema de inventario eficiente puede reducir costos operativos hasta en un 30% y mejorar la productividad empresarial.',
                    'date' => '2024-01-15',
                    'author' => 'María González',
                    'category' => 'Hardware',
                    'image' => 'https://images.pexels.com/photos/2881232/pexels-photo-2881232.jpeg?auto=compress&cs=tinysrgb&w=600',                    'icon' => '💻'
                ],
                [
                    'id' => 2,
                    'title' => 'Gestión de Licencias de Software: Evita Multas y Optimiza Costos',
                    'excerpt' => 'Las empresas pueden ahorrar hasta 40% en costos de software con una gestión adecuada de licencias y un inventario actualizado.',
                    'date' => '2024-01-12',
                    'author' => 'Carlos Ruiz',
                    'category' => 'Software',
                    'image' => 'https://images.pexels.com/photos/574071/pexels-photo-574071.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'icon' => '💾'
                ],
                [
                    'id' => 3,
                    'title' => 'Tendencias en Sistemas de Inventario: IA y Automatización',
                    'excerpt' => 'La inteligencia artificial y la automatización están revolucionando la gestión de inventarios, aumentando la precisión en un 95%.',
                    'date' => '2024-01-10',
                    'author' => 'Ana Martínez',
                    'category' => 'Tecnología',
                    'image' => 'https://images.pexels.com/photos/3861969/pexels-photo-3861969.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'icon' => '🔧'
                ],
                [
                    'id' => 4,
                    'title' => 'Cómo Implementar un Sistema de Inventario Exitoso',
                    'excerpt' => 'Guía completa paso a paso para implementar un sistema de inventario que se adapte a las necesidades de tu empresa.',
                    'date' => '2024-01-08',
                    'author' => 'Luis Fernández',
                    'category' => 'Guías',
                    'image' => 'https://images.pexels.com/photos/590016/pexels-photo-590016.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'icon' => '📋'
                ],
                [
                    'id' => 5,
                    'title' => 'Beneficios del Inventario Digital vs. Tradicional',
                    'excerpt' => 'Comparativa detallada entre sistemas tradicionales y digitales, mostrando las ventajas del inventario automatizado.',
                    'date' => '2024-01-05',
                    'author' => 'Patricia López',
                    'category' => 'Comparativas',
                    'image' => 'https://images.pexels.com/photos/3184325/pexels-photo-3184325.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'icon' => '⚖️'
                ],
                [
                    'id' => 6,
                    'title' => 'Seguridad en Sistemas de Inventario: Mejores Prácticas',
                    'excerpt' => 'Aprende las mejores prácticas de seguridad para proteger tu sistema de inventario contra amenazas cibernéticas.',
                    'date' => '2024-01-03',
                    'author' => 'Roberto Silva',
                    'category' => 'Seguridad',
                    'image' => 'https://images.pexels.com/photos/60504/security-protection-anti-virus-software-60504.jpeg?auto=compress&cs=tinysrgb&w=600',
                    'icon' => '🔒'
                ]
            ];

            foreach ($news as $item): ?>
                <article class="news-card">
                    <div class="news-image">
                        <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                        <div class="news-category">
                            <span><?php echo $item['icon']; ?></span>
                            <span><?php echo $item['category']; ?></span>
                        </div>
                    </div>
                    <div class="news-content">
                        <h3><?php echo $item['title']; ?></h3>
                        <p><?php echo $item['excerpt']; ?></p>
                        <div class="news-meta">
                            <span>👤 <?php echo $item['author']; ?></span>
                            <span>📅 <?php echo date('d/m/Y', strtotime($item['date'])); ?></span>
                        </div>
                        <a href="#" class="read-more">
                            Leer más <span>→</span>
                        </a>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>

        <div class="section-footer">
            <a href="#" class="btn btn-primary">Ver Todas las Noticias</a>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="about-section" id="about">
    <div class="container">
        <div class="section-header">
            <h2>¿Por Qué Elegir Nuestro Sistema de Inventario?</h2>
            <p>Transformamos la gestión de inventario con tecnología de vanguardia, brindando soluciones integrales para el control de hardware y software</p>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-item">
                <div class="stat-number">500+</div>
                <div class="stat-label">Empresas Confiando</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">99.9%</div>
                <div class="stat-label">Tiempo de Actividad</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">24/7</div>
                <div class="stat-label">Soporte Técnico</div>
            </div>
            <div class="stat-item">
                <div class="stat-number">150+</div>
                <div class="stat-label">Países Atendidos</div>
            </div>
        </div>

        <!-- Benefits -->
        <div class="benefits-grid">
            <div class="benefit-card">
                <div class="benefit-icon">📈</div>
                <h3>Reducción de Costos</h3>
                <p>Hasta 40% de ahorro en costos operativos mediante optimización de inventario</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">👥</div>
                <h3>Mejora en Productividad</h3>
                <p>Aumento del 60% en eficiencia operativa con procesos automatizados</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">✅</div>
                <h3>Control Total</h3>
                <p>Visibilidad completa del inventario en tiempo real, 24/7</p>
            </div>
            <div class="benefit-card">
                <div class="benefit-icon">🏆</div>
                <h3>Calidad Garantizada</h3>
                <p>Certificación ISO y cumplimiento de estándares internacionales</p>
            </div>
        </div>

        <!-- Importance Section -->
        <div class="importance-section">
            <h3>La Importancia de un Sistema de Inventario Moderno</h3>
            <div class="importance-grid">
                <div class="importance-column">
                    <h4>Para Hardware</h4>
                    <ul>
                        <li>✅ Control preciso de equipos y componentes</li>
                        <li>✅ Seguimiento de garantías y mantenimiento</li>
                        <li>✅ Optimización de compras y reducción de costos</li>
                        <li>✅ Prevención de pérdidas y robos</li>
                    </ul>
                </div>
                <div class="importance-column">
                    <h4>Para Software</h4>
                    <ul>
                        <li>✅ Gestión completa de licencias y conformidad</li>
                        <li>✅ Control de versiones y actualizaciones</li>
                        <li>✅ Evitar multas por uso no autorizado</li>
                        <li>✅ Optimización de costos de licenciamiento</li>
                    </ul>
                </div>
            </div>
            <div class="importance-footer">
                <a href="#" class="btn btn-primary">Solicitar Demostración</a>
            </div>
        </div>
    </div>
</section>

<?php include 'includes/footer.php'; ?>