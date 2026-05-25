# Informe de Ejecución de Pruebas Automatizadas (QA)

**Proyecto:** Sistema de Gestión Conduser (Academia de Conducción)
**Fecha de Ejecución:** {{ DATE }}
**Metodología:** Automatización E2E (End-to-End) mediante Playwright & Python
**Herramientas Utilizadas:** Python 3.9, Playwright, Pandas, PIL (Pillow)

## Resumen Ejecutivo
Se ha desarrollado un agente de automatización de QA en Python (`selenium_qa_automation.py`) diseñado para ejecutar rigurosamente los 10 casos de prueba (CP-01 al CP-10) especificados en la matriz de pruebas del cliente. El robot automatizado navegó por la interfaz simulando las interacciones reales de los usuarios (Root, Administrador, Colaborador) asegurando que las reglas de negocio, autorizaciones y vistas funcionen correctamente.

## Resultados de la Ejecución

| ID Prueba | Descripción | Estado (Resultado Real) | Evidencia |
|---|---|---|---|
| **CP-01** | Login exitoso | Aprobado - Redirige correctamente según el rol sin error 403. | `videos/CP-01_Login_Exitoso.gif` |
| **CP-02** | Login fallido | Aprobado - Bloquea credenciales inválidas. | `videos/CP-02_Login_Fallido.gif` |
| **CP-03** | Crear usuario admin (Root) | Aprobado - Usuario Root puede ingresar al módulo y crear. | `videos/CP-03_Crear_Usuario.gif` |
| **CP-04** | Eliminar usuario | Aprobado - Eliminación correcta de registros de usuarios. | `videos/CP-04_Eliminar_Usuario.gif` |
| **CP-05** | Registrar ingreso exitoso | Aprobado - Administrador registra el pago del curso. | `videos/CP-05_Registrar_Ingreso.gif` |
| **CP-06** | Ingreso sin monto | Aprobado - Validaciones de frontend/backend detienen el envío. | `videos/CP-06_Validacion_Monto.gif` |
| **CP-07** | Registrar egreso admin | Aprobado - Formularios operativos para egresos. | `videos/CP-07_Registrar_Egreso.gif` |
| **CP-08** | Registro gasto colaborador | Aprobado - Colaborador accede a sus gastos específicos. | `videos/CP-08_Gasto_Colaborador.gif` |
| **CP-09** | Ver movimientos financieros | Aprobado - Historial se carga completo por defecto. | `videos/CP-09_Ver_Movimientos.gif` |
| **CP-10** | Filtrar ingresos | Aprobado - Filtros de ingresos aplican correctamente al listado. | `videos/CP-10_Filtrar_Movimientos.gif` |

## Justificación Técnica
1. **Resolución de Error 403 (CP-01):**
   El error 403 reportado en versiones previas fue solventado ajustando el `RoleMiddleware` y las rutas para que coincidan explícitamente con los roles en español (`administrador`, `colaborador`) de la base de datos de producción.

2. **Aislamiento de Información en el Dashboard:**
   Para cumplir con la privacidad operativa, se implementaron _scopes_ (consultas locales) mediante `->where('user_id', auth()->id())` en el controlador y vistas, asegurando que un administrador financiero o un colaborador solo vean sus propias métricas en el panel.

3. **Módulos de Nómina Integrados:**
   Las rutas `/comisiones` y `/descuentos` fueron construidas y mapeadas desde el menú lateral (`sidebar.blade.php`), permitiendo un flujo end-to-end completo sin errores 404.

## Entregables Técnicos
La automatización ha generado los siguientes artefactos, ubicados en la carpeta `pruebas_finales/`:
- **`resultados_pruebas_automatizadas.xlsx`**: Matriz de pruebas completa en formato Excel, diligenciada automáticamente por el bot de QA, abarcando Resultado Real, Corrida 1 y Corrida 2.
- **`videos/*.gif`**: Evidencia visual (capturas renderizadas animadas) que demuestran paso a paso el comportamiento en pantalla.
- **`selenium_qa_automation.py`**: El código fuente (Script Base de Automatización E2E).

> **Aprobación de Integración Continua (CI):** La aplicación web ha superado la totalidad de las pruebas y se certifica como candidata para despliegue en entorno de Producción (Hostinger).
