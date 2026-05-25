import asyncio
import os
from playwright.async_api import async_playwright

async def run():
    os.makedirs("pruebas_finales/videos", exist_ok=True)
    images = []
    
    async with async_playwright() as p:
        browser = await p.chromium.launch(headless=True)
        page = await browser.new_page(viewport={"width": 1280, "height": 720})

        print("Navegando a la página de login...")
        await page.goto("http://127.0.0.1:8000/login")
        await page.wait_for_timeout(2000)
        await page.screenshot(path="pruebas_finales/videos/frame_1.png")

        print("Llenando credenciales...")
        await page.fill('input[name="email"]', 'admin@conduser.com')
        await page.fill('input[name="password"]', 'Admin123')
        await page.wait_for_timeout(1000)
        await page.screenshot(path="pruebas_finales/videos/frame_2.png")

        print("Haciendo clic en iniciar sesión...")
        await page.click('button[type="submit"]')
        await page.wait_for_timeout(3000)
        await page.screenshot(path="pruebas_finales/videos/frame_3.png")

        print("Navegando a Gestión de Cuentas...")
        await page.goto("http://127.0.0.1:8000/accounts")
        await page.wait_for_timeout(2000)
        await page.screenshot(path="pruebas_finales/videos/frame_4.png")
        
        print("Abriendo detalle de cuenta...")
        elements = await page.locator('.group-hover\\:bg-primary\\/10').element_handles()
        if elements:
            await elements[0].click()
            await page.wait_for_timeout(3000)
            await page.screenshot(path="pruebas_finales/videos/frame_5.png")

        print("Navegando a Configuración...")
        await page.goto("http://127.0.0.1:8000/profile")
        await page.wait_for_timeout(2000)
        await page.screenshot(path="pruebas_finales/videos/frame_6.png")

        print("Navegando a la pestaña de Sistema...")
        await page.click('text=Ajustes del Sistema')
        await page.wait_for_timeout(2000)
        await page.screenshot(path="pruebas_finales/videos/frame_7.png")

        print("Cerrando sesión...")
        await page.goto("http://127.0.0.1:8000/dashboard")
        await page.wait_for_timeout(1000)
        await page.click('text=Cerrar sesión')
        await page.wait_for_timeout(2000)
        await page.screenshot(path="pruebas_finales/videos/frame_8.png")

        await browser.close()
        
    print("Prueba finalizada. Generando GIF animado...")
    try:
        from PIL import Image
        frames = []
        for i in range(1, 9):
            img_path = f"pruebas_finales/videos/frame_{i}.png"
            if os.path.exists(img_path):
                frames.append(Image.open(img_path))
        
        if frames:
            frames[0].save('pruebas_finales/videos/resultado_prueba.gif',
                           save_all=True,
                           append_images=frames[1:],
                           duration=1500,
                           loop=0)
            print("GIF guardado en pruebas_finales/videos/resultado_prueba.gif")
    except ImportError:
        print("Pillow no instalado, usando solo capturas.")

if __name__ == "__main__":
    asyncio.run(run())
