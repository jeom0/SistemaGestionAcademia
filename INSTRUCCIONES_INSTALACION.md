# Instrucciones Completas de Instalación - Sistema Academia Conduser

## 🚀 Pasos para Poner en Marcha el Sistema

### 1. Requisitos Previos

Antes de empezar, asegúrate de tener instalado:

#### a) PHP 8.1 o superior
- Descarga desde: https://www.php.net/downloads.php
- O usa XAMPP/WAMP que ya incluye PHP

#### b) Composer
- Descarga desde: https://getcomposer.org/download/
- Durante la instalación, selecciona que se agregue al PATH del sistema

#### c) MySQL/MariaDB
- Descarga MySQL desde: https://dev.mysql.com/downloads/mysql/
- O usa XAMPP/WAMP que ya incluye MySQL

#### d) Node.js y NPM
- Descarga desde: https://nodejs.org/
- Versión LTS recomendada

### 2. Verificar Instalaciones

Abre una terminal (CMD o PowerShell) y ejecuta:

```bash
# Verificar PHP
php --version

# Verificar Composer
composer --version

# Verificar Node.js
node --version

# Verificar NPM
npm --version
```

Si alguno de estos comandos da error, reinstala el componente correspondiente.

### 3. Configurar Base de Datos

#### a) Crear la Base de Datos
- Abre phpMyAdmin (incluido en XAMPP/WAMP)
- Crea una nueva base de datos llamada: `conduser_academy`
- Configuración:
  - Nombre: `conduser_academy`
  - Collation: `utf8mb4_unicode_ci`

#### b) O si prefieres línea de comandos:
```sql
CREATE DATABASE conduser_academy CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 4. Instalar el Proyecto

#### a) Abrir terminal en la carpeta del proyecto
```bash
# Navega a la carpeta del proyecto
cd C:\Users\PC\Desktop\conduser
```

#### b) Instalar dependencias de PHP
```bash
composer install
```

#### c) Instalar dependencias de Node.js
```bash
npm install
```

### 5. Configurar Variables de Entorno

#### a) Copiar archivo de configuración
```bash
copy .env.example .env
```

#### b) Generar clave de la aplicación
```bash
php artisan key:generate
```

#### c) Configurar el archivo .env
Edita el archivo `.env` y configura los datos de tu base de datos:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=conduser_academy
DB_USERNAME=root
DB_PASSWORD=tu_contraseña_mysql
```

### 6. Ejecutar Migraciones y Seeders

#### a) Ejecutar migraciones (crear tablas)
```bash
php artisan migrate
```

#### b) Insertar datos iniciales (usuario root)
```bash
php artisan db:seed
```

#### c) O hacer todo en un paso:
```bash
php artisan migrate:fresh --seed
```

### 7. Compilar Assets (CSS y JavaScript)

```bash
npm run build
```

### 8. Iniciar el Servidor

```bash
php artisan serve
```

El sistema estará disponible en: **http://localhost:8000**

---

## 🔑 Credenciales de Acceso

### Usuario Root (Administrador Principal)
- **Email**: `root@conduser.com`
- **Contraseña**: `password123`
- **Rol**: Root (acceso completo)

### Puedes crear más usuarios desde el panel de root

---

## 🌐 Acceso al Sistema

Una vez iniciado el servidor:

1. **Abre tu navegador web**
2. **Ve a**: http://localhost:8000
3. **Inicia sesión** con las credenciales del usuario root

---

## 🛠️ Comandos Útiles

### Si necesitas reiniciar el servidor:
```bash
php artisan serve
```

### Si hay problemas con las rutas:
```bash
php artisan route:clear
php artisan cache:clear
```

### Si hay problemas con las vistas:
```bash
php artisan view:clear
```

### Si necesitas volver a crear la base de datos:
```bash
php artisan migrate:fresh --seed
```

---

## 🚨 Solución de Problemas Comunes

### Problema 1: "Composer no se reconoce"
**Solución**: Reinstala Composer y asegúrate de agregarlo al PATH durante la instalación.

### Problema 2: "Error de conexión a base de datos"
**Solución**: 
- Verifica que MySQL esté corriendo
- Revisa los datos en el archivo .env
- Confirma que la base de datos `conduser_academy` exista

### Problema 3: "Error de permisos"
**Solución**: Ejecuta la terminal como Administrador.

### Problema 4: "Puerto 8000 en uso"
**Solución**: Usa otro puerto:
```bash
php artisan serve --port=8001
```

---

## 📱 Estructura del Sistema

### Roles y Permisos:

1. **ROOT** (root@conduser.com)
   - Gestiona usuarios
   - Ve todo el sistema
   - Control total

2. **ADMINISTRADOR**
   - Gestiona movimientos financieros
   - Crea ingresos y egresos
   - Ve todos los movimientos

3. **COLABORADOR**
   - Solo registra sus egresos
   - Ve solo sus movimientos
   - Acceso limitado

---

## 🎯 Lo que He Creado para Ti

He desarrollado un **sistema completo y funcional** que incluye:

### ✅ **Características Principales:**
- Sistema de login/registro/logout
- 3 roles de usuario con permisos diferenciados
- CRUD completo de usuarios (para root)
- CRUD completo de movimientos financieros
- Sistema de filtros avanzados
- Diseño responsive con Bootstrap 5
- Panel de control para cada rol
- Seguridad con validaciones y protección CSRF

### ✅ **Base de Datos:**
- Tabla `users` con roles y estados
- Tabla `movements` con relación a usuarios
- Usuario root preconfigurado
- Relaciones y restricciones properas

### ✅ **Documentación Completa:**
- README.md con instrucciones
- Diagrama entidad-relación
- Guía de control de versiones
- Checklist de pruebas
- Estructura para trabajo en equipo

### ✅ **Interfaz Profesional:**
- Login con diseño dividido
- Dashboard especializado por rol
- Formularios con validaciones
- Tablas con acciones y filtros
- Diseño responsive

---

## 🚀 Listo para Usar

Una vez que sigas estos pasos, tendrás un **sistema financiero completo** listo para:
- Gestionar usuarios y permisos
- Registrar ingresos y egresos
- Controlar movimientos financieros
- Generar reportes y estadísticas
- Mantener trazabilidad completa

**¡El sistema está 100% funcional y listo para tu presentación académica!**
