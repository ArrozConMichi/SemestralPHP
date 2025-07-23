# Sistema de Inventario - InvenTech

Sistema web completo para gestión de inventario de hardware y software, desarrollado en PHP puro con MySQL.

## Características

- ✅ **Sistema de Login/Registro** completo con validación
- ✅ **Página principal** con noticias sobre hardware y software
- ✅ **Diseño responsive** que se adapta a todos los dispositivos
- ✅ **Navbar dinámico** con menú móvil
- ✅ **Footer informativo** con enlaces y contacto
- ✅ **Base de datos MySQL** para usuarios y contenido
- ✅ **Seguridad** con hash de contraseñas y validación de datos
- ✅ **CSS moderno** con variables y animaciones

## Estructura del Proyecto

```
proyecto-php/
├── index.php              # Página principal
├── login.php              # Página de login
├── register.php           # Página de registro
├── logout.php             # Cerrar sesión
├── database.sql           # Script de base de datos
├── config/
│   └── database.php       # Configuración de BD
├── includes/
│   ├── header.php         # Header HTML
│   ├── navbar.php         # Barra de navegación
│   └── footer.php         # Footer
├── css/
│   └── styles.css         # Estilos CSS
└── README.md              # Este archivo
```

## Instalación

### 1. Requisitos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx) o XAMPP/WAMP

### 2. Configuración de Base de Datos
1. Crear base de datos en MySQL:
   ```sql
   CREATE DATABASE inventario_sistema;
   ```

2. Importar el archivo `database.sql` en phpMyAdmin o ejecutar:
   ```bash
   mysql -u root -p inventario_sistema < database.sql
   ```

3. Configurar conexión en `config/database.php`:
   ```php
   $host = 'localhost';
   $dbname = 'inventario_sistema';
   $username = 'root';
   $password = 'tu_password';
   ```

### 3. Instalación en Servidor Local

#### Con XAMPP:
1. Copiar archivos a `C:\xampp\htdocs\inventario\`
2. Iniciar Apache y MySQL en XAMPP
3. Visitar `http://localhost/inventario/`

#### Con servidor propio:
1. Subir archivos al directorio web
2. Configurar permisos de escritura si es necesario
3. Acceder desde el navegador

## Uso

### Registro de Usuario
1. Ir a `register.php`
2. Completar formulario con:
   - Nombre completo
   - Email
   - Empresa
   - Contraseña (mínimo 6 caracteres)
   - Confirmar contraseña
   - Aceptar términos

### Login
1. Ir a `login.php`
2. Ingresar email y contraseña
3. Opción "Recordarme" disponible

### Navegación
- **Inicio**: Página principal con hero, noticias y beneficios
- **Nosotros**: Información sobre la importancia del inventario
- **Noticias**: Artículos sobre hardware y software
- **Contacto**: Información de contacto

## Características Técnicas

### Seguridad
- Contraseñas hasheadas con `password_hash()`
- Validación de datos con `filter_var()`
- Protección contra SQL injection con PDO
- Sesiones seguras para autenticación

### Diseño
- **Responsive**: Se adapta a móviles, tablets y desktop
- **Colores**: Paleta profesional azul/gris para tecnología
- **Tipografía**: Fuentes del sistema para mejor rendimiento
- **Animaciones**: Transiciones suaves y efectos hover
- **Iconos**: Emojis para compatibilidad universal

### Base de Datos
- Tabla `users`: Gestión de usuarios registrados
- Tabla `news`: Contenido de noticias (opcional)
- Índices optimizados para consultas rápidas

## Personalización

### Colores
Modificar variables CSS en `css/styles.css`:
```css
:root {
    --primary-color: #1E40AF;    /* Azul principal */
    --secondary-color: #64748B;   /* Gris secundario */
    --success-color: #059669;     /* Verde éxito */
    --error-color: #DC2626;       /* Rojo error */
}
```

### Contenido
- Editar noticias en `index.php` (array `$news`)
- Modificar información de empresa en `includes/footer.php`
- Cambiar logo y nombre en `includes/navbar.php`

### Base de Datos
- Agregar campos a tabla `users` si necesitas más información
- Crear tablas adicionales para inventario real
- Modificar `config/database.php` para diferentes entornos

## Próximos Pasos

Para convertir esto en un sistema de inventario completo:

1. **Módulo de Inventario**:
   - Tabla de productos/equipos
   - CRUD para hardware/software
   - Categorías y ubicaciones

2. **Dashboard**:
   - Panel de control para usuarios
   - Estadísticas y reportes
   - Gráficos de inventario

3. **Gestión de Usuarios**:
   - Roles y permisos
   - Perfil de usuario
   - Recuperación de contraseña

4. **API REST**:
   - Endpoints para móvil
   - Integración con otros sistemas
   - Exportación de datos

## Soporte

Para dudas o problemas:
- Revisar logs de PHP y MySQL
- Verificar permisos de archivos
- Comprobar configuración de base de datos
- Validar versiones de PHP/MySQL

## Licencia

Proyecto de código abierto para uso educativo y comercial.