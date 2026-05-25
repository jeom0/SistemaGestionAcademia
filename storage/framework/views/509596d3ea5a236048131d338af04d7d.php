<?php $__env->startSection('title', 'Mi Perfil'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-10 max-w-[1000px] mx-auto" x-data="{ activeTab: 'perfil' }">
    <!-- Header -->
    <div class="flex flex-col gap-1">
        <h1 class="text-4xl font-black text-secondary tracking-tight">Configuración del Sistema</h1>
        <p class="text-on-surface-variant font-medium">Gestiona tu información personal, preferencias del sistema y seguridad.</p>
    </div>

    <!-- Tabs -->
    <div class="flex overflow-x-auto hide-scrollbar gap-2 border-b border-outline pb-4">
        <button @click="activeTab = 'perfil'" :class="activeTab === 'perfil' ? 'bg-secondary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant'" class="px-6 py-3 rounded-2xl font-bold text-sm transition-all whitespace-nowrap">Mi Perfil</button>
        <button @click="activeTab = 'sistema'" :class="activeTab === 'sistema' ? 'bg-secondary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant'" class="px-6 py-3 rounded-2xl font-bold text-sm transition-all whitespace-nowrap">Ajustes del Sistema</button>
        <button @click="activeTab = 'notificaciones'" :class="activeTab === 'notificaciones' ? 'bg-secondary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant'" class="px-6 py-3 rounded-2xl font-bold text-sm transition-all whitespace-nowrap">Notificaciones</button>
        <button @click="activeTab = 'seguridad'" :class="activeTab === 'seguridad' ? 'bg-secondary text-white shadow-md' : 'bg-white text-on-surface-variant hover:bg-surface-variant'" class="px-6 py-3 rounded-2xl font-bold text-sm transition-all whitespace-nowrap">Seguridad</button>
    </div>

    <!-- Profile Form -->
    <div x-show="activeTab === 'perfil'" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
        <div class="p-6 md:p-12">
            <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Avatar Upload Section -->
                <div class="flex flex-col sm:flex-row items-center gap-6 sm:gap-8 pb-10 border-b border-outline text-center sm:text-left">
                    <div class="relative group cursor-pointer" onclick="document.getElementById('avatar').click()">
                        <div class="w-32 h-32 rounded-[2rem] overflow-hidden border-4 border-surface-variant group-hover:border-primary transition-all shadow-lg">
                            <?php if(auth()->user()->avatar): ?>
                                <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name)); ?>&background=006837&color=fff&size=128" class="w-full h-full">
                            <?php endif; ?>
                        </div>
                        <div class="absolute -right-2 -bottom-2 w-10 h-10 bg-primary text-white rounded-xl flex items-center justify-center hover:scale-110 transition-all shadow-xl">
                            <span class="material-symbols-outlined text-[20px]">photo_camera</span>
                        </div>
                        <input type="file" name="avatar" id="avatar" class="hidden" accept="image/*">
                    </div>
                    <div class="flex flex-col gap-1">
                        <h4 class="text-lg font-black text-secondary">Foto de Perfil</h4>
                        <p class="text-xs text-on-surface-variant font-medium">Recomendado: 400x400px, JPG o PNG.</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Nombre Completo</label>
                        <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" required>
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Correo Electrónico</label>
                        <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" required>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center ml-1">
                            <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest">Nueva Contraseña</label>
                            <span class="text-[9px] font-black text-primary uppercase tracking-widest bg-primary-light px-2 py-0.5 rounded-full">Opcional</span>
                        </div>
                        <input type="password" name="password" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="••••••••">
                    </div>

                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="••••••••">
                    </div>
                </div>

                <div class="flex justify-end pt-4">
                    <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl font-black text-sm hover:shadow-xl hover:shadow-primary/20 transition-all active:scale-[0.98]">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- System Tab -->
    <div x-show="activeTab === 'sistema'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
        <div class="p-6 md:p-12 flex flex-col gap-8">
            <h3 class="text-xl font-black text-secondary border-b border-outline pb-4">Preferencias Globales</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="flex flex-col gap-2">
                    <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Moneda Principal</label>
                    <select class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none">
                        <option>Peso Colombiano (COP)</option>
                        <option>Dólar Estadounidense (USD)</option>
                        <option>Euro (EUR)</option>
                    </select>
                </div>
                <div class="flex flex-col gap-2">
                    <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Zona Horaria</label>
                    <select class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none">
                        <option>America/Bogota (UTC-5)</option>
                        <option>America/Mexico_City (UTC-6)</option>
                        <option>America/New_York (UTC-4)</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center justify-between p-6 bg-surface-variant/30 rounded-3xl border border-outline">
                <div class="flex flex-col">
                    <span class="text-sm font-bold text-secondary">Modo Oscuro Automático</span>
                    <span class="text-xs text-on-surface-variant">Sincronizar el tema con las preferencias del sistema operativo.</span>
                </div>
                <div class="w-12 h-6 bg-primary rounded-full relative cursor-pointer">
                    <div class="absolute right-1 top-1 w-4 h-4 bg-white rounded-full"></div>
                </div>
            </div>
            <div class="flex justify-end pt-4">
                <button class="px-10 py-4 bg-surface-variant text-on-surface-variant rounded-2xl font-black text-sm transition-all hover:bg-outline">Guardar Sistema</button>
            </div>
        </div>
    </div>

    <!-- Notifications Tab -->
    <div x-show="activeTab === 'notificaciones'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
        <div class="p-6 md:p-12 flex flex-col gap-8">
            <h3 class="text-xl font-black text-secondary border-b border-outline pb-4">Alertas y Correos</h3>
            
            <div class="flex flex-col gap-4">
                <label class="flex items-center gap-4 p-4 border border-outline rounded-2xl cursor-pointer hover:border-primary transition-all">
                    <input type="checkbox" checked class="w-5 h-5 rounded text-primary focus:ring-primary border-outline">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-secondary">Nuevos Registros de Ingreso</span>
                        <span class="text-xs text-on-surface-variant">Recibir alerta cuando un colaborador registra un pago.</span>
                    </div>
                </label>
                <label class="flex items-center gap-4 p-4 border border-outline rounded-2xl cursor-pointer hover:border-primary transition-all">
                    <input type="checkbox" checked class="w-5 h-5 rounded text-primary focus:ring-primary border-outline">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-secondary">Reportes Semanales</span>
                        <span class="text-xs text-on-surface-variant">Envío de resumen contable al correo principal cada lunes.</span>
                    </div>
                </label>
                <label class="flex items-center gap-4 p-4 border border-outline rounded-2xl cursor-pointer hover:border-primary transition-all">
                    <input type="checkbox" class="w-5 h-5 rounded text-primary focus:ring-primary border-outline">
                    <div class="flex flex-col">
                        <span class="text-sm font-bold text-secondary">Actividad de Usuarios</span>
                        <span class="text-xs text-on-surface-variant">Notificar inicios de sesión en dispositivos nuevos.</span>
                    </div>
                </label>
            </div>
            <div class="flex justify-end pt-4">
                <button class="px-10 py-4 bg-surface-variant text-on-surface-variant rounded-2xl font-black text-sm transition-all hover:bg-outline">Guardar Alertas</button>
            </div>
        </div>
    </div>

    <!-- Security Tab -->
    <div x-show="activeTab === 'seguridad'" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4" x-transition:enter-end="opacity-100 translate-y-0" class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
        <div class="p-6 md:p-12 flex flex-col gap-8">
            <h3 class="text-xl font-black text-secondary border-b border-outline pb-4">Seguridad de la Cuenta</h3>
            
            <div class="flex items-center justify-between p-6 bg-red-50 rounded-3xl border border-red-100">
                <div class="flex flex-col gap-1">
                    <span class="text-sm font-bold text-red-900">Autenticación de Dos Pasos (2FA)</span>
                    <span class="text-xs text-red-700">Protege tu cuenta con una capa adicional de seguridad usando Google Authenticator.</span>
                </div>
                <button class="px-6 py-2 bg-white text-red-700 font-bold text-sm rounded-xl border border-red-200 hover:bg-red-100 transition-all">Activar 2FA</button>
            </div>
            
            <div class="flex flex-col gap-4 mt-4">
                <h4 class="text-sm font-black text-secondary uppercase tracking-widest">Sesiones Activas</h4>
                <div class="flex items-center gap-4 p-4 border border-outline rounded-2xl">
                    <span class="material-symbols-outlined text-[32px] text-primary">laptop_mac</span>
                    <div class="flex flex-col flex-1">
                        <span class="text-sm font-bold text-secondary">Mac OS - Chrome</span>
                        <span class="text-xs text-on-surface-variant">Bogotá, Colombia • Activo ahora</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    document.getElementById('avatar').onchange = evt => {
        const [file] = document.getElementById('avatar').files
        if (file) {
            const preview = document.querySelector('.w-32.h-32 img');
            preview.src = URL.createObjectURL(file);
        }
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mariapazpelaezrestrepo/Documents/Proyectos Desarrollapp/conduser/resources/views/profile/edit.blade.php ENDPATH**/ ?>