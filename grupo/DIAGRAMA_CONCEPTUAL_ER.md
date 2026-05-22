# Diagrama Entidad-Relación (Conceptual) - Academia Conduser

Este diagrama representa la lógica de negocio y las relaciones de alto nivel entre las entidades principales del sistema.

```mermaid
erDiagram
    USUARIO ||--o{ MOVIMIENTO : "registra y gestiona"
    USUARIO ||--o{ AUDITORIA : "genera registros de"
    USUARIO ||--o{ CUENTA : "administra"

    USUARIO {
        string nombre
        string email
        string rol
        string estado
    }

    MOVIMIENTO {
        decimal monto
        string tipo
        string descripcion
        date fecha
        string estado
    }

    AUDITORIA {
        string accion
        string modulo
        text detalles
        datetime fecha_hora
    }

    CUENTA {
        string nombre_banco
        string numero_cuenta
        decimal saldo_actual
    }
```

### Descripción del Modelo:
*   **USUARIO**: Es la entidad central (Root, Administrador o Colaborador).
*   **MOVIMIENTO**: Representa el flujo de caja (Ingresos, Egresos, Comisiones, Descuentos).
*   **AUDITORIA**: Registra la trazabilidad de seguridad de cada usuario.
*   **CUENTA**: Gestiona los diferentes depósitos o bancos donde se mueve el dinero.
