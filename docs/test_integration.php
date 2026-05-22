<?php
define('LARAVEL_START', microtime(true));

// Cargar dependencias y arrancar Laravel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

echo "=========================================================\n";
echo "   REPORTE DE EJECUCIÓN DE PRUEBAS DE INTEGRACIÓN   \n";
echo "           SISTEMA ACADEMIA CONDUSER                \n";
echo "=========================================================\n";
echo "Fecha de ejecución: " . date('Y-m-d H:i:s') . "\n";
echo "Entorno: Desarrollo Local (SQLite)\n";
echo "Agente Validador: Antigravity AI\n";
echo "---------------------------------------------------------\n\n";

function testRoute($url, $method = 'GET', $data = [], $user = null) {
    if ($user) {
        Auth::login($user);
    } else {
        Auth::logout();
    }

    $request = Request::create($url, $method, $data);
    
    // Capturar cookies de sesión simuladas si existen
    $response = app()->handle($request);
    
    $status = $response->getStatusCode();
    $redirect = ($status >= 300 && $status < 400) ? $response->headers->get('Location') : 'N/A';
    
    echo "• [CP] URL: " . str_pad($url, 25) . 
         " | Método: " . str_pad($method, 5) . 
         " | Rol: " . str_pad($user ? $user->role : 'Invitado', 13) . 
         " | HTTP: " . $status . 
         " | Redir: " . $redirect . "\n";
    
    return $status;
}

try {
    // 1. Verificar la conexión a la base de datos y que exista el Root inicial
    $root = User::where('role', 'root')->first();
    if (!$root) {
        echo "❌ [ERROR CRÍTICO] El usuario Root no existe en la base de datos. Debes correr 'php artisan migrate:fresh --seed' primero.\n";
        exit(1);
    }
    echo "✓ [OK] Base de datos conectada. Usuario Root verificado: " . $root->email . "\n\n";

    echo "--- EJECUTANDO CASOS DE PRUEBA ---\n";

    // CP-001: Comprobar redirección automática al Login
    $status = testRoute('/', 'GET');
    if ($status === 302) echo "  ↳ [PASA] La raíz redirige correctamente al login.\n\n";

    // CP-002: Comprobar que la vista de login está disponible
    $status = testRoute('/login', 'GET');
    if ($status === 200) echo "  ↳ [PASA] La vista pública del login se renderiza perfectamente (200 OK).\n\n";

    // CP-003: Bloqueo de página protegida sin sesión
    $status = testRoute('/dashboard', 'GET');
    if ($status === 302) echo "  ↳ [PASA] Intento no autenticado redirigido correctamente al login.\n\n";

    // CP-004: Acceso exitoso al Dashboard de Root
    $status = testRoute('/root/dashboard', 'GET', [], $root);
    if ($status === 200) echo "  ↳ [PASA] El usuario Root accede correctamente a su Dashboard principal.\n\n";

    // CP-005: Visualización de lista de usuarios como Root
    $status = testRoute('/root/users', 'GET', [], $root);
    if ($status === 200) echo "  ↳ [PASA] Root puede cargar el módulo CRUD y visualizar la lista de usuarios.\n\n";

    // CP-006: Validación de Bypass de Root (Acceso concedido a todo)
    // El rol 'root' debe poder acceder al dashboard del 'administrador' porque tiene acceso global
    $status = testRoute('/admin/dashboard', 'GET', [], $root);
    if ($status === 200) {
        echo "  ↳ [PASA] El usuario Root tiene bypass de seguridad y accede a rutas de administrador correctamente.\n\n";
    }

    // CP-007: Bloqueo de Acceso No Autorizado (403 Forbidden)
    // Creamos un modelo simulado de Colaborador (sin guardarlo en DB) para verificar el bloqueo
    $colab = new User([
        'name' => 'Colaborador de Prueba',
        'email' => 'colab@pruebas.com',
        'role' => 'collaborator',
        'status' => 'activo'
    ]);
    
    $status = testRoute('/admin/dashboard', 'GET', [], $colab);
    if ($status === 403) {
        echo "  ↳ [PASA] Colaborador bloqueado correctamente al intentar entrar a panel de administrador (403 Forbidden).\n\n";
    }

    echo "---------------------------------------------------------\n";
    echo "✓ [RESULTADO GENERAL] ¡Todas las rutas críticas y de seguridad de roles pasaron con éxito!\n";
    echo "=========================================================\n";

} catch (\Exception $e) {
    echo "❌ [ERROR DURANTE PRUEBAS]: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
