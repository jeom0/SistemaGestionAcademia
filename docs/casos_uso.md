# Casos de Uso del Sistema

Este documento describe de manera formal los casos de uso principales relacionados con la autenticación, autorización y gestión de sesiones del sistema web.

## CU-01: Registro de Nuevo Usuario

**Actor:** Usuario Anónimo (Visitante)  
**Descripción:** Permite a un visitante crear una cuenta nueva en el sistema proporcionando su información básica y credenciales.  
**Precondiciones:** El usuario no debe tener una sesión activa. El correo electrónico no debe estar registrado previamente.

**Flujo Principal:**
1. El usuario accede a la página de registro.
2. El sistema presenta un formulario solicitando: Nombre, Email, Contraseña y Confirmación de Contraseña.
3. El usuario completa los campos y envía el formulario.
4. El sistema valida el formato de los datos (ej. formato de email, longitud de contraseña).
5. El sistema verifica que el correo electrónico no exista en la base de datos.
6. El sistema encripta la contraseña y almacena el nuevo registro con un rol por defecto.
7. El sistema notifica el éxito de la operación.
8. El sistema redirige al usuario a la página de Login.

**Postcondiciones:** Se crea una nueva entidad de usuario en la base de datos. El usuario está listo para autenticarse.

---

## CU-02: Inicio de Sesión (Login)

**Actor:** Usuario Registrado  
**Descripción:** Permite a un usuario registrado acceder al sistema mediante la validación de sus credenciales.  
**Precondiciones:** El usuario debe tener una cuenta existente en el sistema.

**Flujo Principal:**
1. El usuario navega a la vista de inicio de sesión.
2. El sistema muestra un formulario solicitando Email y Contraseña.
3. El usuario ingresa sus credenciales y presiona "Ingresar".
4. El sistema busca el correo electrónico en la base de datos.
5. El sistema valida que la contraseña ingresada coincida con el hash almacenado.
6. El sistema genera un Token de Acceso (JWT) con la información de sesión y rol.
7. El sistema envía el token al cliente y redirige al dashboard correspondiente según el rol.

**Postcondiciones:** El cliente almacena el token. El sistema reconoce al usuario en peticiones subsecuentes.

---

## CU-03: Carga de Layout Dinámico según Rol

**Actor:** Usuario Autenticado  
**Descripción:** El sistema adapta la interfaz gráfica y las opciones del menú de navegación basándose en el nivel de acceso (rol) del usuario actual.  
**Precondiciones:** El usuario ha iniciado sesión exitosamente y posee un token válido.

**Flujo Principal:**
1. El usuario accede a la página principal o dashboard.
2. El cliente extrae el rol del usuario a partir del token o los datos de sesión almacenados.
3. El sistema evalúa el rol del usuario (ej. Estudiante, Profesor, Administrador).
4. El sistema renderiza los componentes específicos:
   - Si es **Administrador**: Se muestran enlaces a gestión de usuarios y configuraciones globales.
   - Si es **Profesor**: Se muestran opciones para crear cursos y evaluar.
   - Si es **Estudiante**: Se muestran los cursos inscritos y calificaciones.
5. El usuario visualiza la interfaz adaptada a sus permisos.

**Postcondiciones:** Se presenta una interfaz limpia y segura, ocultando funcionalidades para las cuales el usuario no tiene autorización.

---

## CU-04: Acceso Interceptado por Middleware de Autenticación

**Actor:** Sistema (Middleware)  
**Descripción:** Proceso automático que protege las rutas privadas, asegurando que solo usuarios con credenciales válidas y permisos suficientes puedan consumir recursos.  
**Precondiciones:** El usuario o cliente intenta acceder a un endpoint protegido (ej. `/api/admin/users`).

**Flujo Principal:**
1. El cliente realiza una petición HTTP al endpoint protegido incluyendo el token en las cabeceras.
2. El middleware intercepta la petición antes de llegar al controlador.
3. El middleware verifica la existencia del token.
4. El middleware verifica la firma criptográfica y la vigencia del token.
5. El middleware extrae el rol contenido en el token decodificado.
6. El middleware contrasta el rol del usuario con los roles permitidos para esa ruta específica.
7. Al ser válido y tener permisos, el middleware permite que la solicitud continúe hacia el controlador.

**Postcondiciones:** La petición es procesada por el servidor y el cliente recibe la respuesta esperada.

---

## CU-05: Cierre de Sesión (Logout)

**Actor:** Usuario Autenticado  
**Descripción:** Permite al usuario finalizar su sesión activa de manera segura, revocando el acceso a recursos protegidos desde su dispositivo actual.  
**Precondiciones:** El usuario debe tener una sesión activa.

**Flujo Principal:**
1. El usuario hace clic en el botón de "Cerrar Sesión" ubicado en el layout.
2. El sistema solicita confirmación (opcional).
3. El cliente elimina el token almacenado (LocalStorage, SessionStorage o Cookies).
4. El sistema redirige al usuario a la página pública principal o a la vista de Login.
5. El usuario visualiza la vista pública sin componentes protegidos.

**Postcondiciones:** El cliente ya no posee un token válido. Cualquier intento posterior de acceder a rutas protegidas requerirá un nuevo inicio de sesión.
