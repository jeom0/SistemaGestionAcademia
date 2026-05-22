# Control de Versiones - Sistema Academia Conduser

## Estrategia de Control de Versiones con Git

Este documento explica cómo se manejará el control de versiones para el proyecto **Sistema Integral para el Control Financiero y Administrativo - Academia Conduser** utilizando Git.

## Ramas Sugeridas

### Ramas Principales

1. **main**
   - Rama principal y estable
   - Contiene el código listo para producción
   - Solo se actualiza mediante Pull Requests aprobados

2. **develop**
   - Rama de desarrollo integrado
   - Contiene el código más reciente pero estable
   - Base para nuevas funcionalidades

### Ramas de Funcionalidades (Feature Branches)

3. **feature/base-database**
   - Configuración inicial del proyecto
   - Modelos, migraciones y seeders
   - Base de datos y estructura inicial

4. **feature/auth-roles-layout**
   - Sistema de autenticación
   - Middleware de roles
   - Layouts y vistas base

5. **feature/root-users-crud**
   - CRUD de usuarios para rol root
   - Validaciones y restricciones
   - Dashboard de gestión de usuarios

6. **feature/movements-crud-docs**
   - CRUD de movimientos financieros
   - Filtros y búsquedas
   - Documentación final y ER diagram

7. **feature/dashboard-ui**
   - Interfaces de usuario optimizadas
   - Mejoras visuales y experiencia de usuario
   - Componentes interactivos

## Commits Sugeridos

### Feature/base-database
```bash
git commit -m "Add project base database models migrations and seeders"
git commit -m "Create User and Movement models with relationships"
git commit -m "Add database seeder for root user"
git commit -m "Configure database connections and environment"
```

### Feature/auth-roles-layout
```bash
git commit -m "Add authentication flow with login and register"
git commit -m "Implement role-based middleware system"
git commit -m "Create base layouts with Bootstrap 5"
git commit -m "Build dashboard views for all user roles"
```

### Feature/root-users-crud
```bash
git commit -m "Build root users CRUD functionality"
git commit -m "Add user validation and security rules"
git commit -m "Implement user status toggle functionality"
git commit -m "Add user management interface"
```

### Feature/movements-crud-docs
```bash
git commit -m "Build financial movements CRUD"
git commit -m "Add movement filters and search functionality"
git commit -m "Implement role-based movement permissions"
git commit -m "Add comprehensive documentation and ER diagram"
```

### Feature/dashboard-ui
```bash
git commit -m "Optimize dashboard user interfaces"
git commit -m "Add responsive design improvements"
git commit -m "Implement interactive components"
git commit -m "Add visual statistics and charts"
```

## Flujo de Trabajo

### 1. Inicio del Proyecto
```bash
# Crear repositorio
git init
git add .
git commit -m "Initial Laravel project setup"

# Crear rama develop
git checkout -b develop
git push -u origin develop
```

### 2. Desarrollo de Funcionalidades

Para cada integrante:

```bash
# Actualizar develop
git checkout develop
git pull origin develop

# Crear rama de funcionalidad
git checkout -b feature/nombre-funcionalidad

# Desarrollar la funcionalidad
# ... trabajo de desarrollo ...

# Commits frecuentes y descriptivos
git add .
git commit -m "Add specific feature implementation"

# Subir al repositorio
git push origin feature/nombre-funcionalidad
```

### 3. Integración de Cambios

```bash
# Crear Pull Request desde feature → develop
# Revisión por compañeros
# Corrección si es necesario
# Merge a develop

# Actualizar main
git checkout main
git merge develop
git push origin main
```

## Convención de Nombres

### Ramas
- `feature/nombre-descriptivo`: Para nuevas funcionalidades
- `bugfix/descripcion-del-problema`: Para corrección de errores
- `hotfix/correccion-urgente`: Para correcciones críticas
- `release/version-x.x.x`: Para preparación de lanzamiento

### Commits
- **Formato**: `tipo: descripcion-concisa`
- **Tipos**:
  - `feat`: Nueva funcionalidad
  - `fix`: Corrección de error
  - `docs`: Documentación
  - `style`: Formato/código sin lógica
  - `refactor`: Refactorización
  - `test`: Pruebas
  - `chore`: Tareas de mantenimiento

### Ejemplos de Commits
```bash
feat: Add user authentication system
fix: Resolve login validation error
docs: Update API documentation
style: Format CSS according to standards
refactor: Optimize database queries
test: Add unit tests for user model
chore: Update dependencies
```

## Estrategia de Integración por Integrantes

### Integrante 1: Base de Datos y Configuración
**Rama**: `feature/base-database`
**Responsabilidades**:
- Estructura del proyecto Laravel
- Configuración de base de datos
- Modelos y migraciones
- Seeders iniciales

### Integrante 2: Autenticación y Layouts
**Rama**: `feature/auth-roles-layout`
**Responsabilidades**:
- Sistema de login/register
- Middleware de roles
- Layouts base
- Vistas de autenticación

### Integrante 3: CRUD de Usuarios
**Rama**: `feature/root-users-crud`
**Responsabilidades**:
- CRUD completo de usuarios
- Validaciones y seguridad
- Dashboard root
- Gestión de permisos

### Integrante 4: Movimientos y Documentación
**Rama**: `feature/movements-crud-docs`
**Responsabilidades**:
- CRUD de movimientos
- Filtros y búsquedas
- Documentación completa
- Diagrama entidad-relación

## Orden de Integración

1. **Primero**: Integrante 1 (base-database)
   - Base del sistema
   - Estructura fundamental
   - Modelos y migraciones

2. **Segundo**: Integrante 2 (auth-roles-layout)
   - Depende de la base de datos
   - Sistema de acceso
   - Estructura visual

3. **Tercero**: Integrante 3 (root-users-crud)
   - Depende de autenticación
   - Gestión de usuarios
   - Panel de administración

4. **Cuarto**: Integrante 4 (movements-crud-docs)
   - Depende de usuarios y autenticación
   - Funcionalidad principal
   - Documentación final

## Buenas Prácticas

### Antes de Commits
```bash
# Verificar cambios
git status

# Agregar archivos relevantes
git add archivo-especifico

# Revisar diff
git diff --staged

# Commit descriptivo
git commit -m "tipo: descripcion clara y concisa"
```

### Antes de Push
```bash
# Actualizar rama base
git checkout develop
git pull origin develop

# Reintegrar cambios
git checkout feature/mi-funcionalidad
git rebase develop

# Resolver conflictos si existen
# git add .
# git rebase --continue

# Subir cambios
git push origin feature/mi-funcionalidad
```

### Revisión de Código
- Todo Pull Request debe ser revisado por al menos un compañero
- Verificar que las pruebas pasen
- Confirmar que sigue las convenciones del proyecto
- Verificar que no introduce regresiones

## Resolución de Conflictos

### Conflictos Comunes
1. **Migraciones**: Dos personas modifican la misma migración
2. **Rutas**: Definición de rutas duplicadas
3. **Vistas**: Modificación del mismo layout
4. **Modelos**: Cambios en relaciones o métodos

### Estrategia de Resolución
1. Comunicarse con el otro desarrollador
2. Analizar qué cambios son necesarios
3. Combinar los cambios manualmente
4. Probar la solución
5. Continuar con el rebase/merge

## Etiquetas (Tags)

### Versiones
```bash
# Crear tag para versión
git tag -a v1.0.0 -m "Versión 1.0.0 - Sistema Academia Conduser"

# Subir tags
git push origin v1.0.0
git push origin --tags
```

### Hitos Importantes
- `v0.1.0`: Base de datos y configuración
- `v0.2.0`: Autenticación y roles
- `v0.3.0`: CRUD de usuarios
- `v1.0.0`: Sistema completo y documentado

## Flujo de Validación Final

Antes de la entrega final:

```bash
# 1. Integrar todas las ramas
git checkout main
git merge develop

# 2. Limpiar ramas locales
git branch -d feature/base-database
git branch -d feature/auth-roles-layout
git branch -d feature/root-users-crud
git branch -d feature/movements-crud-docs

# 3. Verificar que todo funciona
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan serve

# 4. Crear tag de versión final
git tag -a v1.0.0 -m "Versión final - Sistema Academia Conduser"
git push origin main --tags
```

## Herramientas Recomendadas

### Para Trabajo en Equipo
- **GitHub/GitLab**: Para repositorio remoto y Pull Requests
- **GitHub Desktop**: Interfaz gráfica para quienes prefieren GUI
- **GitKraken**: Cliente Git avanzado
- **VS Code Git Integration**: Integración directa en el editor

### Para Calidad de Código
- **PHP CS Fixer**: Formato de código PHP
- **PHPStan**: Análisis estático de código
- **ESLint**: Análisis de JavaScript
- **StyleCI**: Integración continua de estilo

## Monitoreo del Progreso

El profesor podrá revisar el historial completo mediante:

```bash
# Ver todo el historial
git log --oneline --graph --all

# Ver commits por autor
git shortlog -s -n

# Ver actividad reciente
git log --since="1 week ago" --pretty=format:"%h - %an, %ar : %s"

# Ver estadísticas del proyecto
git log --stat --summary
```

---

Este sistema de control de versiones garantiza un desarrollo organizado, trazabilidad completa y fácil colaboración entre los integrantes del equipo.
