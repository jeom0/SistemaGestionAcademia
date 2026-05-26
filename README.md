# Sistema Integral para el Control Financiero y Administrativo - Academia Conduser

Bienvenido al repositorio oficial del **Sistema Integral para el Control Financiero y Administrativo de la Academia Conduser**. Este documento (README) consolida toda la información necesaria para la evaluación, despliegue y uso del sistema.

Este proyecto reemplaza la antigua gestión manual financiera (llevada en Excel) y proporciona una plataforma web segura, rápida y con trazabilidad completa, centralizando el control financiero con distintos niveles de acceso.

---

## 📅 Información de Entrega
- **Fecha de Entrega:** 25 de Mayo de 2026
- **Entidad:** Academia Conduser

---

## 👥 Equipo de Trabajo (Roles Oficiales)

Este proyecto fue desarrollado bajo una metodología ágil (Scrum). A continuación, se detallan los integrantes del equipo y sus respectivos roles. **Este mismo equipo es el encargado de brindar el soporte oficial del sistema.**

- **Juan Esteban Ospina** - *Product Owner* (Dueño del Producto). Encargado de definir los requisitos del negocio, la visión del proyecto y validar que las funcionalidades entreguen el valor esperado a la academia.
- **Sofia Vanegas** - *Scrum Master*. Líder ágil encargada de garantizar las ceremonias, eliminar impedimentos del equipo de desarrollo y asegurar la fluidez del proyecto.
- **Kevin Quiroga** - *Desarrollador*. Encargado del desarrollo de la lógica del sistema, estructura de la base de datos y funcionalidades de backend.
- **Juan José Henao** - *Desarrollador*. Encargado de la implementación de código, construcción de interfaces, integración visual (Frontend) y experiencia de usuario.

---

## 🚀 Acceso al Sistema en Producción

El proyecto se encuentra totalmente desplegado y accesible a través de internet. Para validar el funcionamiento del sistema en vivo, el docente debe acceder al siguiente enlace:

- **Dominio Principal de Acceso:** [https://gestion.csconduser.com/login](https://gestion.csconduser.com/login)

### Credenciales de Ingreso (Pruebas)
Para revisar el panel de control con privilegios totales, utilice las siguientes credenciales:
- **Usuario (Correo):** `root@conduser.com`
- **Contraseña:** `password123`

*(Nota: Existen otros usuarios de prueba documentados en los archivos de testing para validar los roles de Administrador y Colaborador).*

---

## 📁 Guía de Documentos para Revisión del Docente

Para facilitar la revisión y calificación del proyecto, hemos consolidado todos los entregables en carpetas específicas. **El profesor debe revisar los siguientes archivos clave** que demuestran la arquitectura, el diseño y la calidad del software:

### 1. Documentación Técnica y Diagramas (Carpeta `docs/`)
Toda la documentación arquitectónica se encuentra en el directorio `/docs`:
- 📄 `docs/DIAGRAMA_ENTIDAD_RELACION.md` - Contiene la estructura detallada de la base de datos y el **Diagrama Entidad-Relación** del sistema.
- 📄 `docs/Casos_Pruebas_Software.tex` - Documentación formal en formato LaTeX detallando los **Casos de Uso** y escenarios de pruebas.
- 📄 `docs/INFORME_PRUEBAS.md` - Informe detallado con el resumen de la calidad del software.
- 🖼️ `docs/conduser_mockup.png` y `mockup_layout.json` - Prototipos e interfaces (UI/UX) diseñadas antes del desarrollo.
- 👨‍💻 `docs/test_integration.php` - Script de integración para validación de servicios.

### 2. Pruebas de Calidad, UI y Automatización (Carpeta `pruebas_finales/`)
El sistema fue sometido a rigurosas pruebas de estrés, UI (Interfaz Gráfica) y flujos. Los resultados están aquí:
- 📊 `pruebas_finales/resultados_pruebas_automatizadas.xlsx` - **El archivo Excel principal** que consolida la sábana de pruebas automatizadas y manuales.
- 📊 `pruebas_finales/resultados_pruebas.csv` - Data cruda de los resultados de pruebas.
- 📄 `pruebas_finales/Informe_Pruebas_Finales.md` - Conclusiones finales de la auditoría de software.
- 🤖 `pruebas_finales/selenium_qa_automation.py` - Script en Python utilizando Selenium para la **automatización de pruebas**.
- 🎥 `pruebas_finales/videos/` - Carpeta con las evidencias en video de los flujos del sistema funcionando.

### 3. Evidencias Visuales Adicionales (Carpeta `pruebas_screenshots/`)
- 🖼️ `pruebas_screenshots/evidencia_documento.png` - Documento visual solicitado y cargado como evidencia específica (Corresponde al archivo *Captura de pantalla 2026-05-25 a la(s) 7.37.51 p.m.*).

---

## ⚙️ Detalles Técnicos y Arquitectura

- **Framework Backend:** Laravel 10 (PHP 8.1+)
- **Frontend:** Blade Templates estructurados con Tailwind CSS y componentes responsivos.
- **Base de Datos:** MySQL (El modelo relacional se puede consultar en `docs/DIAGRAMA_ENTIDAD_RELACION.md`).
- **Arquitectura:** Patrón Modelo-Vista-Controlador (MVC).

### Resumen de Roles y Permisos
- **Root:** Control maestro, gestión del CRUD de todos los usuarios, puede ver la totalidad de movimientos financieros.
- **Administrador:** Especializado en la auditoría financiera, registra y visualiza todos los ingresos y egresos.
- **Colaborador:** Acceso restringido. Solo registra sus propios gastos y no tiene visibilidad financiera global.

---

## 🛠 Instalación Local (Opcional)

Si desea correr el proyecto de manera local, siga estos pasos:

1. Clone el repositorio:
   ```bash
   git clone https://github.com/jeom0/SistemaGestionAcademia.git
   ```
2. Instale las dependencias de PHP y Node:
   ```bash
   composer install
   npm install
   ```
3. Configure su archivo `.env` basándose en `.env.example` y genere la llave:
   ```bash
   php artisan key:generate
   ```
4. Ejecute las migraciones y seeders para cargar la base de datos:
   ```bash
   php artisan migrate:fresh --seed
   ```
5. Compile los assets y corra el servidor:
   ```bash
   npm run build
   php artisan serve
   ```

---
*Fin del documento. Para dudas puntuales, contactar al equipo desarrollador listado en la sección de soporte.*
