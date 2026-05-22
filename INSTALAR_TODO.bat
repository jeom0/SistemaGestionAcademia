@echo off
echo ========================================
echo INSTALADOR AUTOMATICO - SISTEMA CONDUSER
echo ========================================
echo.

echo [PASO 1] Verificando instalacion actual...
echo.

REM Verificar PHP
php --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] PHP no esta instalado
    echo Descargando XAMPP (incluye PHP, MySQL, Apache)...
    start https://www.apachefriends.org/download.html
    echo.
    echo Por favor instala XAMPP y luego ejecuta este archivo nuevamente.
    pause
    exit
) else (
    echo [OK] PHP esta instalado
    php --version
)

echo.
echo [PASO 2] Verificando Composer...
composer --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [INFO] Composer no esta instalado. Descargando e instalando...
    echo.
    echo Descargando Composer Setup...
    powershell -Command "Invoke-WebRequest -Uri 'https://getcomposer.org/Composer-Setup.exe' -OutFile 'composer-setup.exe'"
    echo.
    echo Ejecutando instalador de Composer...
    start /wait composer-setup.exe
    echo.
    echo Por favor cierra esta ventana y vuelve a abrirla despues de instalar Composer.
    pause
    exit
) else (
    echo [OK] Composer esta instalado
    composer --version
)

echo.
echo [PASO 3] Verificando Node.js...
node --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [INFO] Node.js no esta instalado. Descargando...
    echo.
    echo Descargando instalador de Node.js...
    powershell -Command "Invoke-WebRequest -Uri 'https://nodejs.org/dist/v20.12.2/node-v20.12.2-x64.msi' -OutFile 'nodejs-setup.msi'"
    echo.
    echo Ejecutando instalador de Node.js...
    start /wait nodejs-setup.msi
    echo.
    echo Por favor cierra esta ventana y vuelve a abrirla despues de instalar Node.js.
    pause
    exit
) else (
    echo [OK] Node.js esta instalado
    node --version
)

echo.
echo [PASO 4] Verificando NPM...
npm --version >nul 2>&1
if %errorlevel% neq 0 (
    echo [ERROR] NPM no esta disponible
    pause
    exit
) else (
    echo [OK] NPM esta disponible
    npm --version
)

echo.
echo ========================================
echo TODAS LAS HERRAMIENTAS ESTAN LISTAS
echo ========================================
echo.
echo [PASO 5] Instalando dependencias del proyecto...
echo.

REM Cambiar al directorio del proyecto
cd /d "C:\Users\PC\Desktop\conduser"

REM Instalar dependencias de PHP
echo Instalando dependencias de PHP (Composer)...
composer install
if %errorlevel% neq 0 (
    echo [ERROR] Error al instalar dependencias de PHP
    pause
    exit
)
echo [OK] Dependencias de PHP instaladas

echo.
echo Instalando dependencias de JavaScript (NPM)...
npm install
if %errorlevel% neq 0 (
    echo [ERROR] Error al instalar dependencias de JavaScript
    pause
    exit
)
echo [OK] Dependencias de JavaScript instaladas

echo.
echo [PASO 6] Configurando proyecto...
echo.

REM Crear archivo .env
if not exist .env (
    echo Creando archivo .env...
    copy .env.example .env
    echo [OK] Archivo .env creado
) else (
    echo [OK] Archivo .env ya existe
)

REM Generar clave de la aplicacion
echo Generando clave de la aplicacion...
php artisan key:generate
if %errorlevel% neq 0 (
    echo [ERROR] Error al generar clave
    pause
    exit
)
echo [OK] Clave generada

echo.
echo [PASO 7] Configurando base de datos...
echo.

echo IMPORTANTE: Necesitas crear una base de datos llamada 'conduser_academy'
echo.
echo Si usas XAMPP:
echo 1. Inicia XAMPP Control Panel
echo 2. Inicia Apache y MySQL
echo 3. Ve a http://localhost/phpmyadmin
echo 4. Crea base de datos: conduser_academy
echo.
echo Presiona cualquier tecla cuando hayas creado la base de datos...
pause

REM Ejecutar migraciones y seeders
echo Creando tablas y datos iniciales...
php artisan migrate:fresh --seed
if %errorlevel% neq 0 (
    echo [ERROR] Error en la base de datos. Revisa la configuracion en .env
    pause
    exit
)
echo [OK] Base de datos configurada

echo.
echo [PASO 8] Compilando archivos estaticos...
echo.
npm run build
if %errorlevel% neq 0 (
    echo [ERROR] Error al compilar archivos
    pause
    exit
)
echo [OK] Archivos compilados

echo.
echo ========================================
echo SISTEMA INSTALADO CORRECTAMENTE
echo ========================================
echo.
echo El sistema estara disponible en: http://localhost:8000
echo.
echo Usuario: root@conduser.com
echo Contrasena: password123
echo.
echo Iniciando servidor...
php artisan serve

pause
