# Reparto de trabajo del grupo

Este directorio organiza los archivos que debe subir cada integrante al repositorio de GitHub.

## Importante

La carpeta `grupo` no se sube completa al repositorio.

Cada integrante debe copiar los archivos de su carpeta `archivos/` dentro del proyecto Laravel real, respetando las rutas, y luego subir su avance en una rama de Git.

## Integrantes

1. **Integrante 1**: Base del proyecto, base de datos, modelos, migraciones y seeders.
2. **Integrante 2**: Login, registro, logout, roles, middleware y layout.
3. **Integrante 3**: CRUD de usuarios para root.
4. **Integrante 4**: CRUD de movimientos, filtros, documentación y diagrama entidad-relación.

## Orden correcto

1. **Primero sube el integrante 1** - Base del sistema
2. **Luego sube el integrante 2** - Autenticación y layout
3. **Luego sube el integrante 3** - Gestión de usuarios
4. **Finalmente sube el integrante 4** - Movimientos y documentación

## Recomendación

Cada integrante debe trabajar en una rama diferente y hacer pull antes de empezar para evitar conflictos.

## Flujo de Trabajo

1. El integrante 1 sube su parte a la rama `feature/base-database`
2. Se hace merge a `main`
3. El integrante 2 hace pull de `main` y trabaja en `feature/auth-roles-layout`
4. Se hace merge a `main`
5. El integrante 3 hace pull de `main` y trabaja en `feature/root-users-crud`
6. Se hace merge a `main`
7. El integrante 4 hace pull de `main` y trabaja en `feature/movements-crud-docs`
8. Se hace merge final a `main`

## Notas Importantes

- No modificar archivos de otros integrantes sin coordinación
- Seguir estrictamente las rutas especificadas
- Probar localmente antes de hacer push
- Revisar que no se suben archivos sensibles (.env, vendor, node_modules)

## Contacto

Para dudas sobre el reparto de trabajo, contactar al líder del equipo o revisar el archivo `ORDEN_DE_SUBIDA_A_GITHUB.md`.
