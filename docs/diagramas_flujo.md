# Diagramas de Flujo del Sistema

Este documento presenta los diagramas de flujo modelados mediante Mermaid, detallando el ciclo de vida de la autenticación y autorización en la aplicación web.

## 1. Flujo General de Autenticación y Layout Dinámico

El siguiente diagrama muestra el recorrido completo desde que un usuario intenta acceder al sistema hasta que se le presenta el layout correspondiente a su rol, o bien cierra su sesión.

```mermaid
flowchart TD
    A[Inicio: Usuario accede a la plataforma] --> B{¿Tiene cuenta?}
    
    %% Flujo de Registro
    B -- No --> C[Accede a pantalla de Registro]
    C --> D[Ingresa datos: Nombre, Email, Password]
    D --> E{Validación de datos}
    E -- Errores --> C
    E -- Válido --> F[Guardar usuario en BD]
    F --> G[Redirigir a Login]
    
    %% Flujo de Login
    B -- Sí --> G[Accede a pantalla de Login]
    G --> H[Ingresa credenciales]
    H --> I{Validar Credenciales}
    I -- Inválidas --> G
    
    %% Middleware y Generación de Token
    I -- Válidas --> J[Generar Token JWT]
    J --> K[Almacenar Token en Cliente]
    K --> L[Solicitar acceso a ruta protegida]
    
    %% Flujo de Middleware de Autenticación
    L --> M[Middleware de Autenticación]
    M --> N{¿Token válido?}
    N -- No --> O[Error 401: Redirigir a Login]
    O --> G
    
    %% Middleware de Roles y Layout
    N -- Sí --> P[Extraer Rol de Usuario]
    P --> Q{Verificar Permisos de Ruta}
    Q -- Denegado --> R[Error 403: Acceso Denegado]
    
    Q -- Permitido --> S[Cargar Layout Dinámico]
    
    S --> T{¿Rol del Usuario?}
    T -- Admin --> U[Renderizar Panel de Administración]
    T -- Profesor --> V[Renderizar Panel de Profesor]
    T -- Estudiante --> W[Renderizar Vista de Estudiante]
    
    %% Flujo de Logout
    U --> X[Usuario solicita Logout]
    V --> X
    W --> X
    X --> Y[Invalidar/Eliminar Token]
    Y --> Z[Redirigir a Pantalla de Inicio / Login]
    Z --> G
```

## 2. Diagrama de Secuencia: Validación y Middleware

Detalle específico de la interacción entre el cliente, el middleware y la base de datos durante una petición segura.

```mermaid
sequenceDiagram
    participant C as Cliente (Navegador)
    participant M as Middleware (Auth)
    participant S as Servidor (API)
    participant BD as Base de Datos

    C->>S: POST /api/login (email, password)
    S->>BD: Consultar usuario
    BD-->>S: Retorna usuario y hash
    S->>S: Verificar hash
    S-->>C: Retorna JWT y user_data

    Note over C,S: El usuario está autenticado
    
    C->>M: GET /api/dashboard + Bearer Token
    M->>M: Validar firma del JWT
    alt Token Inválido o Expirado
        M-->>C: 401 Unauthorized
    else Token Válido
        M->>S: Token decodificado (Rol y UserID)
        S->>BD: Obtener datos del dashboard
        BD-->>S: Retorna datos
        S-->>C: 200 OK + JSON Datos Layout
    end
```
