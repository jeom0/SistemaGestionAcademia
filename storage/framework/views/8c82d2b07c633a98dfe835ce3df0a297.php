<?php $__env->startSection('title', 'Mi Perfil'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-10 max-w-[800px] mx-auto">
    <!-- Header -->
    <div class="flex flex-col gap-1">
        <h1 class="text-4xl font-black text-secondary tracking-tight">Mi Perfil</h1>
        <p class="text-on-surface-variant font-medium">Gestiona tu información personal y foto de perfil.</p>
    </div>

    <!-- Profile Form -->
    <div class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
        <div class="p-12">
            <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="flex flex-col gap-10">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>

                <!-- Avatar Upload Section -->
                <div class="flex items-center gap-8 pb-10 border-b border-outline">
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

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PC\Desktop\conduser\resources\views/profile/edit.blade.php ENDPATH**/ ?>