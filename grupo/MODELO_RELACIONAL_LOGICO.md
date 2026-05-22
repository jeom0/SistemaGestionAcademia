# Modelo Relacional Lógico (Técnico) - Academia Conduser

Este diagrama detalla la estructura física de la base de datos, incluyendo tablas, llaves primarias (PK), llaves foráneas (FK) y tipos de datos exactos.

```mermaid
erDiagram
    users ||--o{ movements : "FK: user_id"
    users ||--o{ audit_logs : "FK: user_id"
    users ||--o{ accounts : "FK: user_id"

    users {
        bigint id PK
        string name
        string email UK
        string password
        string role
        string status
        string avatar
        timestamp created_at
    }

    movements {
        bigint id PK
        decimal amount
        string type
        date date
        string associated_to
        text description
        string status
        bigint user_id FK
        timestamp created_at
    }

    audit_logs {
        bigint id PK
        string action
        string model_type
        bigint model_id
        text details
        bigint user_id FK
        timestamp created_at
    }

    accounts {
        bigint id PK
        string bank_name
        string account_number
        decimal balance
        bigint user_id FK
        timestamp created_at
    }
```

### Detalles Técnicos:
1.  **Tablas**: Representan la implementación física en MySQL.
2.  **Llaves (PK/FK)**: Garantizan la integridad referencial. Por ejemplo, si se borra un usuario, sus movimientos se eliminan en cascada (`onDelete: cascade`).
3.  **Restricciones**: El campo `email` en la tabla `users` es único (`UK`) para evitar duplicados.
4.  **Trazabilidad**: Todas las tablas incluyen `timestamps` (`created_at`, `updated_at`) para control de auditoría temporal.
