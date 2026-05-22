# Diagrama Entidad-Relación (ERD) - Academia Conduser

Este diagrama muestra cómo se relacionan los datos en la base de datos del proyecto.

```mermaid
erDiagram
    USERS ||--o{ MOVEMENTS : "registra"
    USERS ||--o{ AUDIT_LOGS : "genera"
    
    USERS {
        bigint id PK
        string name
        string email
        string password
        string role "root, administrator, collaborator"
        string status "activo, inactivo"
        string avatar "ruta de imagen"
        datetime created_at
    }

    MOVEMENTS {
        bigint id PK
        decimal amount
        enum type "ingreso, egreso"
        date date
        string associated_to "nombre del colaborador/cuenta"
        text description
        string status "pendiente, completado"
        bigint user_id FK "autor del registro"
        datetime created_at
    }

    AUDIT_LOGS {
        bigint id PK
        bigint user_id FK "quién hizo la acción"
        string action "created, updated, deleted"
        string model_type "Modelo afectado"
        bigint model_id "ID del registro afectado"
        text details "descripción del cambio"
        datetime created_at
    }
```

### Explicación de las Relaciones:
1.  **Usuarios ➔ Movimientos**: Un usuario (administrador o colaborador) puede registrar muchos movimientos financieros. Cada movimiento pertenece obligatoriamente a un usuario.
2.  **Usuarios ➔ Auditoría**: Cada vez que un usuario hace un cambio importante, se genera un registro en la tabla de auditoría vinculado a su ID.
3.  **Movimientos**: Son el núcleo de la aplicación, guardando montos, tipos y estados para el flujo de caja.
