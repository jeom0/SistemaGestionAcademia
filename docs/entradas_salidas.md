# Especificación de Entradas y Salidas

Este documento detalla las entradas requeridas y las salidas esperadas para los diferentes módulos del sistema de autenticación y gestión de usuarios.

## 1. Módulo de Autenticación (Login)

| Elemento | Descripción | Tipo de Dato | Restricciones |
| :--- | :--- | :--- | :--- |
| **Entradas** | | | |
| `email` | Correo electrónico del usuario. | Cadena de texto (String) | Formato de email válido, máximo 255 caracteres, requerido. |
| `password` | Contraseña del usuario. | Cadena de texto (String) | Mínimo 8 caracteres, requerido. |
| **Salidas** | | | |
| `token` | Token de acceso (JWT). | Cadena de texto (String) | Vigencia de 24 horas. |
| `user_data` | Información básica del usuario. | Objeto JSON | Contiene `id`, `nombre`, `email`, `rol`. |
| `error_message` | Mensaje en caso de fallo. | Cadena de texto (String) | Ej. "Credenciales inválidas" o "Usuario no encontrado". |

## 2. Módulo de Registro

| Elemento | Descripción | Tipo de Dato | Restricciones |
| :--- | :--- | :--- | :--- |
| **Entradas** | | | |
| `nombre` | Nombre completo del usuario. | Cadena de texto (String) | Requerido, entre 2 y 100 caracteres. |
| `email` | Correo electrónico del usuario. | Cadena de texto (String) | Formato de email válido, único en la base de datos, requerido. |
| `password` | Contraseña del usuario. | Cadena de texto (String) | Requerido, mínimo 8 caracteres, debe contener al menos un número y un carácter especial. |
| `rol` | Rol solicitado para la cuenta. | Enumeración (Enum) | Valores permitidos: `estudiante`, `profesor`. Por defecto: `estudiante`. |
| **Salidas** | | | |
| `status_code` | Código HTTP de respuesta. | Entero (Integer) | `201` para éxito, `400` o `409` para errores. |
| `message` | Mensaje de confirmación. | Cadena de texto (String) | Ej. "Usuario registrado exitosamente." |
| `error_details` | Detalles del error de validación. | Arreglo (Array) | Lista de campos con errores de formato o reglas de negocio. |

## 3. Módulo de Middleware de Autenticación

| Elemento | Descripción | Tipo de Dato | Restricciones |
| :--- | :--- | :--- | :--- |
| **Entradas** | | | |
| `Authorization Header` | Encabezado HTTP con el token. | Cadena de texto (String) | Formato `Bearer <token>`, requerido en rutas protegidas. |
| `ruta_solicitada` | Endpoint al que se intenta acceder. | Cadena de texto (String) | Ruta válida dentro del sistema. |
| **Salidas** | | | |
| `next()` | Función de paso al controlador. | Función | Ejecutada solo si el token es válido y posee permisos. |
| `error_401` | Error de no autenticado. | Objeto JSON | Mensaje: "Token ausente o inválido". |
| `error_403` | Error de no autorizado (Rol). | Objeto JSON | Mensaje: "Permisos insuficientes para acceder a este recurso". |

## 4. Módulo de Layout Dinámico

| Elemento | Descripción | Tipo de Dato | Restricciones |
| :--- | :--- | :--- | :--- |
| **Entradas** | | | |
| `rol_usuario` | Rol actual del usuario en sesión. | Enumeración (Enum) | `admin`, `profesor`, `estudiante`. |
| **Salidas** | | | |
| `menu_items` | Lista de opciones de navegación. | Arreglo de Objetos | Filtrado según el `rol_usuario`. |
| `ui_components` | Componentes visuales a renderizar. | Nodos del DOM | Componentes específicos como paneles de administración o vistas de estudiante. |

## 5. Módulo de Cierre de Sesión (Logout)

| Elemento | Descripción | Tipo de Dato | Restricciones |
| :--- | :--- | :--- | :--- |
| **Entradas** | | | |
| `token` | Token de sesión actual. | Cadena de texto (String) | Presente en encabezados o cookies. |
| **Salidas** | | | |
| `message` | Confirmación de cierre de sesión. | Cadena de texto (String) | Ej. "Sesión finalizada correctamente". |
| `redirect_url` | Ruta de redirección post-logout. | Cadena de texto (String) | Generalmente apunta a `/login` o `/`. |
