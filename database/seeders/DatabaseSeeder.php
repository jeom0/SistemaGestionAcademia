<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Movement;
use App\Models\AuditLog;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Limpiar base de datos de forma segura para SQLite y MySQL
        if (config('database.default') === 'sqlite') {
            DB::statement('PRAGMA foreign_keys = OFF;');
            DB::table('audit_logs')->truncate();
            DB::table('movements')->truncate();
            DB::table('users')->truncate();
            DB::statement('PRAGMA foreign_keys = ON;');
        } else {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            DB::table('audit_logs')->truncate();
            DB::table('movements')->truncate();
            DB::table('users')->truncate();
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }

        // 2. Crear Usuarios Reales con Roles Diferenciados
        // Administrador Root Principal (Carlos Mendoza)
        $rootUser = User::create([
            'name' => 'Carlos Mendoza',
            'email' => 'conduserroot@gmail.com',
            'password' => Hash::make('Conduser@2005'),
            'role' => 'root',
            'status' => 'activo',
        ]);

        // Cuenta Root de Respaldo
        User::create([
            'name' => 'Usuario Root Respaldo',
            'email' => 'root@conduser.com',
            'password' => Hash::make('password123'),
            'role' => 'root',
            'status' => 'activo',
        ]);

        // Administrador Financiero (Laura Gómez)
        $adminUser = User::create([
            'name' => 'Laura Gómez',
            'email' => 'laura.gomez@csconduser.com',
            'password' => Hash::make('AdminConduser2026'),
            'role' => 'administrador',
            'status' => 'activo',
        ]);

        // Administrador Financiero de Pruebas (Excel)
        User::create([
            'name' => 'Admin Pruebas Excel',
            'email' => 'admin@conduser.com',
            'password' => Hash::make('Admin123'),
            'role' => 'administrador',
            'status' => 'activo',
        ]);

        // Colaborador de Caja General (Juan Pérez)
        $colabUser1 = User::create([
            'name' => 'Juan Pérez',
            'email' => 'juan.perez@csconduser.com',
            'password' => Hash::make('JuanCaja2026'),
            'role' => 'colaborador',
            'status' => 'activo',
        ]);

        // Colaborador de Pruebas (Excel)
        User::create([
            'name' => 'Colaborador Pruebas Excel',
            'email' => 'colaborador@conduser.com',
            'password' => Hash::make('Colab123'),
            'role' => 'colaborador',
            'status' => 'activo',
        ]);

        // Colaborador de Flota e Instructor (Andrés Castro)
        $colabUser2 = User::create([
            'name' => 'Andrés Castro',
            'email' => 'andres.castro@csconduser.com',
            'password' => Hash::make('AndresFlota2026'),
            'role' => 'colaborador',
            'status' => 'activo',
        ]);

        // Colaborador de Recepción (María Paz)
        $colabUser3 = User::create([
            'name' => 'María Paz',
            'email' => 'maria.paz@csconduser.com',
            'password' => Hash::make('MariaRecep2026'),
            'role' => 'colaborador',
            'status' => 'activo',
        ]);

        // 3. Crear Cuentas y Movimientos Reales de la Academia de Conducción
        // Definimos las cuentas asociadas en los movimientos (Caja General, Caja Menor, Bancos)
        $cuentas = [
            'Cuenta Ahorros Bancolombia',
            'Caja General Sede Principal',
            'Caja Menor Administrativa',
            'Cuenta Corriente Davivienda'
        ];

        // Ingresos Reales
        $ingresos = [
            [
                'amount' => 850000.00,
                'description' => 'Pago Matrícula Curso Conducción Categoría B1 (Mateo Restrepo)',
                'associated_to' => 'Cuenta Ahorros Bancolombia',
                'date' => Carbon::now()->subDays(15),
                'user_id' => $colabUser3->id,
            ],
            [
                'amount' => 620000.00,
                'description' => 'Inscripción Curso Licencia Motocicleta A2 (Diana Ortiz)',
                'associated_to' => 'Caja General Sede Principal',
                'date' => Carbon::now()->subDays(12),
                'user_id' => $colabUser1->id,
            ],
            [
                'amount' => 1450000.00,
                'description' => 'Curso Especial Conducción C2 Camión Rígido (Transportes del Norte)',
                'associated_to' => 'Cuenta Ahorros Bancolombia',
                'date' => Carbon::now()->subDays(10),
                'user_id' => $adminUser->id,
            ],
            [
                'amount' => 180000.00,
                'description' => 'Venta de 6 Kits y Manuales Teóricos de Conducción Vial',
                'associated_to' => 'Caja Menor Administrativa',
                'date' => Carbon::now()->subDays(8),
                'user_id' => $colabUser3->id,
            ],
            [
                'amount' => 160000.00,
                'description' => 'Examen Médico Psicosensométrico CRC (Felipe Osorio)',
                'associated_to' => 'Caja General Sede Principal',
                'date' => Carbon::now()->subDays(5),
                'user_id' => $colabUser1->id,
            ],
            [
                'amount' => 120000.00,
                'description' => 'Clases Prácticas Adicionales de Refuerzo 4 Horas (Sofía Martínez)',
                'associated_to' => 'Caja General Sede Principal',
                'date' => Carbon::now()->subDays(3),
                'user_id' => $colabUser3->id,
            ],
            [
                'amount' => 220000.00,
                'description' => 'Trámite y Renovación de Licencia de Conducción C1 (Jorge Silva)',
                'associated_to' => 'Caja General Sede Principal',
                'date' => Carbon::now()->subDays(2),
                'user_id' => $colabUser1->id,
            ],
            [
                'amount' => 850000.00,
                'description' => 'Pago Matrícula Curso Conducción Categoría B1 (Camila Ruiz)',
                'associated_to' => 'Cuenta Corriente Davivienda',
                'date' => Carbon::now()->subDay(),
                'user_id' => $colabUser3->id,
            ],
            [
                'amount' => 1200000.00,
                'description' => 'Contrato de Capacitación en Seguridad Vial de Flota (Distribuidora SAS)',
                'associated_to' => 'Cuenta Ahorros Bancolombia',
                'date' => Carbon::now(),
                'user_id' => $adminUser->id,
            ],
        ];

        // Egresos Reales
        $egresos = [
            [
                'amount' => 135000.00,
                'description' => 'Tanqueo de Gasolina corriente Vehículo Chevrolet Aveo Placa HTO-123',
                'associated_to' => 'Caja Menor Administrativa',
                'date' => Carbon::now()->subDays(14),
                'user_id' => $colabUser2->id,
            ],
            [
                'amount' => 280000.00,
                'description' => 'Mantenimiento Preventivo (Cambio de Aceite y Filtros) Suzuki Swift Placa KLS-456',
                'associated_to' => 'Caja Menor Administrativa',
                'date' => Carbon::now()->subDays(11),
                'user_id' => $colabUser2->id,
            ],
            [
                'amount' => 380000.00,
                'description' => 'Pago de Recibo de Energía Eléctrica Sede Principal (EPM)',
                'associated_to' => 'Cuenta Ahorros Bancolombia',
                'date' => Carbon::now()->subDays(10),
                'user_id' => $adminUser->id,
            ],
            [
                'amount' => 120000.00,
                'description' => 'Pago Recibo de Internet Fibra Óptica Claro (Sede Administrativa)',
                'associated_to' => 'Cuenta Ahorros Bancolombia',
                'date' => Carbon::now()->subDays(9),
                'user_id' => $adminUser->id,
            ],
            [
                'amount' => 95000.00,
                'description' => 'Compra de Suministros de Oficina y Papelería Comercial (Almacén Éxito)',
                'associated_to' => 'Caja Menor Administrativa',
                'date' => Carbon::now()->subDays(7),
                'user_id' => $adminUser->id,
            ],
            [
                'amount' => 1200000.00,
                'description' => 'Pago de Nómina Quincenal del Instructor de Conducción Andrés Castro',
                'associated_to' => 'Cuenta Ahorros Bancolombia',
                'date' => Carbon::now()->subDays(5),
                'user_id' => $adminUser->id,
            ],
            [
                'amount' => 450000.00,
                'description' => 'Reparación de Embrague y Kit de Prensa Vehículo Renault Logan Placa JKM-789',
                'associated_to' => 'Cuenta Ahorros Bancolombia',
                'date' => Carbon::now()->subDays(4),
                'user_id' => $colabUser2->id,
            ],
            [
                'amount' => 180000.00,
                'description' => 'Compra de Botiquines y Extintores Reglamentarios para la Flota Escolar',
                'associated_to' => 'Caja Menor Administrativa',
                'date' => Carbon::now()->subDays(2),
                'user_id' => $adminUser->id,
            ],
            [
                'amount' => 580000.00,
                'description' => 'Renovación de SOAT y Técnico-Mecánica Motocicleta Yamaha Placa ZQR-789',
                'associated_to' => 'Cuenta Corriente Davivienda',
                'date' => Carbon::now()->subDay(),
                'user_id' => $colabUser2->id,
            ],
        ];

        // Insertar los Ingresos
        foreach ($ingresos as $ingreso) {
            Movement::create([
                'amount' => $ingreso['amount'],
                'type' => 'ingreso',
                'status' => 'completado',
                'date' => $ingreso['date'],
                'associated_to' => $ingreso['associated_to'],
                'description' => $ingreso['description'],
                'user_id' => $ingreso['user_id'],
            ]);
        }

        // Insertar los Egresos
        foreach ($egresos as $egreso) {
            Movement::create([
                'amount' => $egreso['amount'],
                'type' => 'egreso',
                'status' => 'completado',
                'date' => $egreso['date'],
                'associated_to' => $egreso['associated_to'],
                'description' => $egreso['description'],
                'user_id' => $egreso['user_id'],
            ]);
        }

        // 4. Crear Registros de Auditoría (Audit Logs) para poblar las notificaciones del header
        $movs = Movement::all();
        $auditLogsData = [
            [
                'user_id' => $rootUser->id,
                'action' => 'created',
                'model_type' => 'User',
                'model_id' => $adminUser->id,
                'details' => 'Carlos Mendoza creó el usuario administrador Laura Gómez',
                'created_at' => Carbon::now()->subDays(15),
            ],
            [
                'user_id' => $adminUser->id,
                'action' => 'created',
                'model_type' => 'User',
                'model_id' => $colabUser1->id,
                'details' => 'Laura Gómez creó la cuenta de colaborador de Juan Pérez',
                'created_at' => Carbon::now()->subDays(14),
            ],
            [
                'user_id' => $colabUser3->id,
                'action' => 'created',
                'model_type' => 'Movement',
                'model_id' => $movs->where('type', 'ingreso')->first()->id ?? 1,
                'details' => 'María Paz registró el ingreso de matrícula Curso B1 de Mateo Restrepo',
                'created_at' => Carbon::now()->subDays(15),
            ],
            [
                'user_id' => $colabUser2->id,
                'action' => 'created',
                'model_type' => 'Movement',
                'model_id' => $movs->where('type', 'egreso')->first()->id ?? 2,
                'details' => 'Andrés Castro registró egreso por compra de gasolina Aveo Placa HTO-123',
                'created_at' => Carbon::now()->subDays(14),
            ],
            [
                'user_id' => $adminUser->id,
                'action' => 'updated',
                'model_type' => 'Movement',
                'model_id' => $movs->where('type', 'ingreso')->skip(2)->first()->id ?? 3,
                'details' => 'Laura Gómez autorizó el contrato corporativo de Transportes del Norte',
                'created_at' => Carbon::now()->subDays(10),
            ],
            [
                'user_id' => $colabUser1->id,
                'action' => 'created',
                'model_type' => 'Movement',
                'model_id' => $movs->where('type', 'ingreso')->skip(4)->first()->id ?? 4,
                'details' => 'Juan Pérez cargó el pago por examen psicosensométrico de Felipe Osorio',
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'user_id' => $colabUser2->id,
                'action' => 'created',
                'model_type' => 'Movement',
                'model_id' => $movs->where('type', 'egreso')->skip(6)->first()->id ?? 6,
                'details' => 'Andrés Castro registró el costo de reparación de embrague Renault Logan',
                'created_at' => Carbon::now()->subDays(4),
            ],
            [
                'user_id' => $colabUser3->id,
                'action' => 'created',
                'model_type' => 'Movement',
                'model_id' => $movs->where('type', 'ingreso')->skip(7)->first()->id ?? 7,
                'details' => 'María Paz registró matrícula de Curso B1 de Camila Ruiz',
                'created_at' => Carbon::now()->subDays(1),
            ],
        ];

        foreach ($auditLogsData as $logData) {
            AuditLog::create([
                'user_id' => $logData['user_id'],
                'action' => $logData['action'],
                'model_type' => $logData['model_type'],
                'model_id' => $logData['model_id'],
                'details' => $logData['details'],
                'created_at' => $logData['created_at'],
                'updated_at' => $logData['created_at'],
            ]);
        }
    }
}
