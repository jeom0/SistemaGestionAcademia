# Orden de Subida a GitHub (Proyecto Final - 3 Integrantes)

Para asegurar que el proyecto funcione correctamente en el repositorio central, sigan este orden estricto de subida. Cada integrante debe realizar un Pull Request (PR) o subir a su rama en este orden:

---

### 1. Integrante 1: DISEÑO Y ESTRUCTURA BASE
**Objetivo**: Establecer los cimientos visuales del proyecto.
- **Acción**: Subir el archivo `app.css`, el `app.blade.php` (Layout) y `sidebar.blade.php`.
- **Por qué**: Sin esto, las páginas de los demás integrantes no tendrán estilos ni navegación.
- **Extra**: También sube el módulo de **Auditoría** para que el sistema empiece a rastrear cambios desde el inicio.

### 2. Integrante 2: PERFIL, DASHBOARDS Y NÓMINA
**Objetivo**: Habilitar la personalización y las vistas financieras específicas.
- **Acción**: Subir el `ProfileController`, las vistas de perfil, los Dashboards de roles y el sistema de **Nómina (Comisión/Descuento)**.
- **Por qué**: Esto conecta el diseño del Integrante 1 con los datos de usuario y las categorías financieras especiales del encabezado.

### 3. Integrante 3: USUARIOS Y MOVIMIENTOS
**Objetivo**: Completar el núcleo administrativo del sistema.
- **Acción**: Subir el CRUD de usuarios y el sistema de movimientos financieros (ingresos/egresos).
- **Por qué**: Es el paso final que llena de contenido real la aplicación y utiliza todos los estilos y componentes previos.

---

## Instrucciones Finales para Todos:
1. **Clonar**: `git clone https://github.com/jeom0/SistemaGestionAcademia.git`
2. **Rama**: Creen su propia rama antes de subir: `git checkout -b su-nombre-rama`
3. **Validar**: Asegúrense de que los archivos estén en las rutas correctas dentro de la carpeta `app/` y `resources/`.
4. **Subir**: `git push origin su-nombre-rama`

**Nota**: Todos los archivos dentro de sus carpetas en `grupo/` ya están actualizados con la versión final que funciona perfectamente.
