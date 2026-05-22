# Checklist de Pruebas Manuales - Sistema Academia Conduser

## Pruebas de Autenticación

### Login Correcto
- [ ] Iniciar sesión con usuario root (root@conduser.com / password123)
- [ ] Verificar redirección al dashboard correspondiente
- [ ] Confirmar que el nombre del usuario aparece en la interfaz
- [ ] Verificar que el rol se muestra correctamente

### Login Incorrecto
- [ ] Intentar login con correo incorrecto
- [ ] Intentar login con contraseña incorrecta
- [ ] Verificar mensaje de error claro y específico
- [ ] Confirmar que no se permite el acceso

### Logout
- [ ] Cerrar sesión desde cualquier dashboard
- [ ] Verificar redirección a página de login
- [ ] Intentar acceder a rutas protegidas sin sesión
- [ ] Confirmar que redirige al login

### Registro de Usuarios
- [ ] Registrar nuevo usuario con datos válidos
- [ ] Verificar que se crea como colaborador por defecto
- [ ] Intentar registrar con correo duplicado
- [ ] Verificar validación de contraseña (mínimo 8 caracteres)

### Usuario Inactivo
- [ ] Crear usuario y marcarlo como inactivo
- [ ] Intentar iniciar sesión con usuario inactivo
- [ ] Verificar mensaje de cuenta inactiva
- [ ] Confirmar que no permite el acceso

## Pruebas de Usuario Root

### Gestión de Usuarios
- [ ] Crear usuario administrador
- [ ] Crear usuario colaborador
- [ ] Editar datos de un usuario existente
- [ ] Cambiar rol de administrador a colaborador
- [ ] Cambiar estado de activo a inactivo
- [ ] Reactivar usuario inactivo
- [ ] Eliminar usuario (que no sea root)

### Restricciones Root
- [ ] Intentar eliminar el propio usuario root
- [ ] Intentar inactivar el propio usuario root
- [ ] Intentar cambiar el propio rol de root
- [ ] Verificar que todas las restricciones funcionan

### Dashboard Root
- [ ] Ver estadísticas de usuarios
- [ ] Ver lista de usuarios con acciones
- [ ] Navegar a creación de usuarios
- [ ] Acceder a edición de usuarios
- [ ] Ver información del sistema

## Pruebas de Usuario Administrador

### Registro de Movimientos
- [ ] Registrar un ingreso con datos válidos
- [ ] Registrar un egreso con datos válidos
- [ ] Verificar que se asigna automáticamente el usuario
- [ ] Intentar registrar monto negativo o cero
- [ ] Intentar registrar sin descripción

### Gestión de Movimientos
- [ ] Editar un movimiento existente
- [ ] Cambiar tipo de ingreso a egreso
- [ ] Cambiar monto y descripción
- [ ] Eliminar un movimiento
- [ ] Verificar confirmación de eliminación

### Filtros de Movimientos
- [ ] Filtrar por tipo "ingreso"
- [ ] Filtrar por tipo "egreso"
- [ ] Filtrar por rango de fechas
- [ ] Combinar filtros de tipo y fecha
- [ ] Limpiar todos los filtros

### Dashboard Administrador
- [ ] Ver estadísticas financieras
- [ ] Ver resumen de movimientos del día
- [ ] Acceder a formulario de registro rápido
- [ ] Ver movimientos recientes

## Pruebas de Usuario Colaborador

### Registro de Egresos
- [ ] Registrar egreso con datos válidos
- [ ] Verificar que solo permite tipo "egreso"
- [ ] Intentar cambiar tipo a "ingreso" (no debe permitir)
- [ ] Verificar que se asigna a su propio usuario

### Visualización de Movimientos
- [ ] Ver solo sus propios movimientos
- [ ] Intentar acceder a movimientos de otros usuarios
- [ ] Verificar que no muestra movimientos ajenos
- [ ] Editar sus propios movimientos

### Restricciones Colaborador
- [ ] Intentar acceder a rutas de /root/*
- [ ] Intentar acceder a creación de usuarios
- [ ] Intentar registrar ingresos (no debe permitir)
- [ ] Verificar que todas las restricciones funcionan

### Dashboard Colaborador
- [ ] Ver estadísticas de sus propios movimientos
- [ ] Ver formulario limitado a egresos
- [ ] Ver resumen de sus gastos

## Pruebas de Seguridad

### Rutas Protegidas
- [ ] Intentar acceder a /dashboard sin login
- [ ] Intentar acceder a /root/users sin login
- [ ] Intentar acceder a /movements sin login
- [ ] Verificar redirección a login en todos los casos

### Protección por Roles
- [ ] Usuario colaborador intenta acceder a rutas root
- [ ] Usuario administrador intenta acceder a rutas root
- [ ] Verificar error 403 o redirección apropiada

### CSRF y Formularios
- [ ] Verificar que los formularios incluyen token CSRF
- [ ] Intentar enviar formulario sin token CSRF
- [ ] Verificar que los formularios PUT/DELETE usan @method

### Contraseñas
- [ ] Verificar que las contraseñas se guardan hasheadas
- [ ] Revisar tabla users en base de datos
- [ ] Confirmar que no hay contraseñas en texto plano

## Pruebas de Base de Datos

### Migraciones
- [ ] Ejecutar `php artisan migrate:fresh --seed`
- [ ] Verificar que se crean todas las tablas
- [ ] Confirmar que se inserta el usuario root
- [ ] Verificar relaciones entre tablas

### Integridad de Datos
- [ ] Crear usuario y movimientos
- [ ] Eliminar usuario y verificar cascade
- [ ] Intentar insertar movimiento sin usuario válido
- [ ] Verificar unicidad de correos electrónicos

### Consistencia
- [ ] Comparar estructura con diagrama ER
- [ ] Verificar que database.sql coincide con migraciones
- [ ] Confirmar tipos de datos correctos
- [ ] Validar relaciones foreign key

## Pruebas de Interfaz de Usuario

### Diseño Responsivo
- [ ] Probar en pantalla de escritorio
- [ ] Probar en pantalla de tablet
- [ ] Probar en pantalla de móvil
- [ ] Verificar que los elementos se ajustan correctamente

### Bootstrap y Estilos
- [ ] Verificar que los estilos de Bootstrap cargan
- [ ] Probar componentes de Bootstrap (cards, tables, forms)
- [ ] Verificar colores Conduser (verde, blanco, gris)
- [ ] Probar tooltips y componentes interactivos

### Formularios
- [ ] Validación en tiempo real
- [ ] Mensajes de error claros
- [ ] Campos obligatorios marcados
- [ ] Placeholder informativos

### Navegación
- [ ] Sidebar funcional
- [ ] Menús según rol
- [ ] Enlaces internos funcionales
- [ ] Botones de acciones correctos

## Pruebas Funcionales Específicas

### CRUD Completo
- [ ] Crear → Leer → Actualizar → Eliminar usuarios
- [ ] Crear → Leer → Actualizar → Eliminar movimientos
- [ ] Verificar que los cambios persisten en BD
- [ ] Probar validaciones en cada paso

### Filtros y Búsquedas
- [ ] Filtrar movimientos por tipo
- [ ] Filtrar por rango de fechas
- [ ] Combinar múltiples filtros
- [ ] Limpiar filtros y mostrar todos

### Estadísticas y Reportes
- [ ] Verificar cálculos de totales
- [ ] Confirmar balances correctos
- [ ] Ver estadísticas por usuario
- [ ] Ver resúmenes por período

## Pruebas de Casos Límite

### Datos Extremos
- [ ] Montos muy grandes (999999.99)
- [ ] Descripciones muy largas
- [ ] Fechas futuras y pasadas
- [ ] Caracteres especiales en campos

### Concurrencia
- [ ] Dos usuarios editando mismo movimiento
- [ ] Crear usuarios simultáneamente
- [ ] Múltiples sesiones activas
- [ ] Logout desde múltiples dispositivos

### Rendimiento
- [ ] Cargar dashboard con muchos movimientos
- [ ] Listar usuarios con registros grandes
- [ ] Aplicar filtros en datasets grandes
- [ ] Tiempos de respuesta aceptables

## Pruebas de Documentación

### Diagrama Entidad-Relación
- [ ] Verificar que README.md contiene diagrama Mermaid
- [ ] Confirmar que docs/DIAGRAMA_ENTIDAD_RELACION.md existe
- [ ] Comparar diagrama con migraciones reales
- [ ] Verificar que movements.user_id → users.id

### Archivos de Documentación
- [ ] README.md está completo y actualizado
- [ ] CONTROL_VERSION.md explica flujo Git
- [ ] ENTREGABLES.md lista archivos correctos
- [ ] CHECKLIST_PRUEBAS.md incluye todas las pruebas

### Instalación desde Cero
- [ ] Seguir instrucciones del README.md
- [ ] Ejecutar composer install
- [ ] Configurar .env correctamente
- [ ] Ejecutar migraciones y seeders
- [ ] Iniciar servidor y verificar funcionamiento

## Pruebas Finales de Entrega

### Verificación Completa
- [ ] Todas las funcionalidades principales operan
- [ ] No hay errores en la consola del navegador
- [ ] No hay errores en los logs de Laravel
- [ ] El sistema está listo para producción

### Validación de Requisitos
- [ ] Sistema permite login de usuarios
- [ ] Sistema permite gestión de usuarios (root)
- [ ] Sistema permite registro de movimientos
- [ ] Sistema implementa filtros correctamente
- [ ] Sistema respeta restricciones por rol
- [ ] Sistema mantiene trazabilidad de movimientos

### Checklist de Entrega
- [ ] Todos los archivos esenciales presentes
- [ ] No hay información sensible en el repositorio
- [ ] Documentación completa y coherente
- [ ] Diagrama ER coincide con implementación
- [ ] Proyecto se instala y funciona desde cero

---

## Notas Adicionales

### Durante las Pruebas
- Tomar capturas de pantalla de cada prueba exitosa
- Documentar cualquier error encontrado
- Registrar soluciones aplicadas
- Anotar mejoras sugeridas

### Problemas Comunes a Verificar
- Formularios que no envían datos correctamente
- Rutas que devuelven 404
- Permisos que no funcionan como esperado
- Validaciones que no se ejecutan
- Estilos que no se aplican correctamente

### Herramientas Útiles
- Laravel Telescope para depuración
- Laravel Debugbar para análisis
- Herramientas de desarrollador del navegador
- Postman/Insomnia para probar APIs
- phpMyAdmin para revisar base de datos

---

**Fecha de Pruebas**: {{ date('d/m/Y') }}  
**Probado por**: [Nombre del Tester]  
**Versión del Sistema**: 1.0.0
