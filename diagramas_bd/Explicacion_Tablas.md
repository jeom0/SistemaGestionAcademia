# Diagrama Entidad-Relación (ER) - Academia Conduser

Este documento describe la estructura completa de la base de datos del Sistema de Gestión Financiera.

## Tablas y Atributos

### 1. USUARIOS (`users`)
Gestiona los accesos y roles del sistema.
- **id** (PK): Identificador único.
- **name**: Nombre completo del usuario.
- **email**: Correo electrónico (único).
- **role**: Rol del usuario (`root`, `administrador`, `colaborador`).
- **avatar**: Ruta de la imagen de perfil.
- **password**: Contraseña encriptada.
- **remember_token**: Token de sesión persistente.
- **email_verified_at**: Fecha de verificación del correo.
- **created_at / updated_at**: Fechas de auditoría de creación y actualización.

### 2. CUENTAS (`accounts`)
Representa las fuentes de dinero (bancos, caja menor, etc.).
- **id** (PK): Identificador único.
- **name**: Nombre de la cuenta (Ej: Banco Colombia, Caja Menor).
- **initial_balance**: Saldo inicial al momento de crear la cuenta.
- **current_balance**: Saldo actual calculado.
- **status**: Estado de la cuenta (Activa/Inactiva).
- **color**: Color en formato HEX para la interfaz gráfica.
- **created_at / updated_at**: Tiempos de registro.

### 3. CATEGORÍAS (`categories`)
Permite clasificar los movimientos financieros.
- **id** (PK): Identificador único.
- **name**: Nombre de la categoría (Ej: Servicios Públicos, Comisiones).
- **type**: Tipo de operación que permite (`ingreso`, `egreso`, `transferencia`).
- **description**: Descripción extendida de la categoría.
- **color**: Color visual en el sistema.
- **icon**: Nombre del icono en Material Symbols.
- **created_at / updated_at**: Tiempos de registro.

### 4. MOVIMIENTOS (`movements`)
Registra todas las transacciones de entrada, salida o traslado de dinero, incluyendo pagos, descuentos y comisiones.
- **id** (PK): Identificador único.
- **type**: Tipo de movimiento (`ingreso`, `egreso`, `transferencia`).
- **amount**: Monto del movimiento.
- **description**: Detalle de qué fue el movimiento.
- **date**: Fecha y hora en que ocurrió.
- **account_id** (FK): Referencia a `accounts` (Cuenta de la que sale o entra el dinero).
- **destination_account_id** (FK, Nullable): Referencia a `accounts` (Cuenta destino, solo aplica para transferencias).
- **category_id** (FK): Referencia a `categories`.
- **user_id** (FK): Referencia a `users` (El empleado afectado en caso de comisiones/descuentos, o el responsable).
- **voucher_path** (Nullable): Ruta del comprobante o soporte adjunto.
- **status**: Estado del movimiento (`completado`, `pendiente`).
- **created_at / updated_at**: Tiempos de registro.

### 5. AUDITORÍA GLOBAL (`global_audits`)
Bitácora de seguridad que registra cada acción importante hecha por los usuarios.
- **id** (PK): Identificador único.
- **user_id** (FK): Usuario que realizó la acción.
- **action**: Acción ejecutada (`crear`, `editar`, `eliminar`).
- **model_type**: Nombre de la tabla afectada.
- **model_id**: ID del registro que fue modificado.
- **details**: Descripción técnica del cambio.
- **ip_address**: Dirección IP desde donde se conectó el usuario.
- **created_at / updated_at**: Fecha exacta del cambio.

---

## Relaciones (Cardinalidad)

1. **Un USUARIO tiene muchos MOVIMIENTOS** (Relación 1:N). 
   - Un empleado puede recibir muchas comisiones o realizar muchos movimientos.
2. **Un USUARIO genera muchos registros de AUDITORÍA** (Relación 1:N).
3. **Una CUENTA tiene muchos MOVIMIENTOS (como origen)** (Relación 1:N).
4. **Una CUENTA tiene muchos MOVIMIENTOS (como destino)** (Relación 1:N).
5. **Una CATEGORÍA clasifica muchos MOVIMIENTOS** (Relación 1:N).
