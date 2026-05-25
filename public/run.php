<?php

// Asegurar que el entorno de Laravel se inicie
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';

// Iniciar la petición HTTP para poder utilizar Artisan
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$app->boot();

header('Content-Type: text/html; charset=utf-8');

echo "<!DOCTYPE html>
<html lang='es'>
<head>
    <meta charset='UTF-8'>
    <title>Migrador y Sembrador de Base de Datos - Academia Conduser</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f8fafc; color: #1e293b; padding: 40px; }
        .card { background-color: white; border-radius: 16px; padding: 30px; box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05); max-width: 800px; margin: 0 auto; border: 1px solid #e2e8f0; }
        h1 { color: #006837; margin-top: 0; }
        pre { background-color: #f1f5f9; padding: 15px; border-radius: 8px; font-size: 13px; overflow-x: auto; border: 1px solid #cbd5e1; }
        .success { color: #15803d; font-weight: bold; }
        .warning { background-color: #fef3c7; border: 1px solid #fde68a; color: #92400e; padding: 15px; border-radius: 8px; margin-top: 20px; font-size: 14px; }
        .btn { display: inline-block; background-color: #006837; color: white; padding: 10px 20px; text-decoration: none; border-radius: 8px; font-weight: bold; margin-top: 15px; }
    </style>
</head>
<body>
    <div class='card'>
        <h1>Ejecutando Migraciones y Carga de Datos en Hostinger...</h1>";

try {
    echo "<p><strong>Paso 1:</strong> Reconstruyendo tablas (migrate:fresh)...</p>";
    \Illuminate\Support\Facades\Artisan::call('migrate:fresh', ['--force' => true]);
    echo "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";
    
    echo "<p><strong>Paso 2:</strong> Sembrando base de datos con datos reales (db:seed)...</p>";
    \Illuminate\Support\Facades\Artisan::call('db:seed', ['--force' => true]);
    echo "<pre>" . \Illuminate\Support\Facades\Artisan::output() . "</pre>";
    
    echo "<p class='success'>¡Éxito! Todas las tablas fueron creadas y los datos reales fueron cargados correctamente.</p>";
    echo "<div class='warning'>
            <strong>¡ATENCIÓN SEGURIDAD!</strong><br>
            Por favor, <strong>elimina este archivo (run.php)</strong> de tu carpeta <code>public/</code> en Hostinger de inmediato para evitar que cualquier otra persona pueda reiniciar tu base de datos en el futuro.
          </div>";
    echo "<a href='/login' class='btn'>Ir al Inicio de Sesión</a>";
} catch (\Exception $e) {
    echo "<h2 style='color: #dc2626;'>Ocurrió un error durante el proceso:</h2>";
    echo "<pre>" . htmlspecialchars($e->getMessage()) . "</pre>";
}

echo "</div>
</body>
</html>";
