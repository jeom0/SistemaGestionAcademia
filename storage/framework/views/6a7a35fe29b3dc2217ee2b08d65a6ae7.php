<?php $__env->startSection('title', 'Gestión de Usuarios'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto">
    <!-- Header Section -->
    <div class="flex justify-between items-center">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-black text-secondary tracking-tight">Gestión de Usuarios</h1>
            <p class="text-on-surface-variant font-medium">Administra el acceso de administradores y colaboradores a la plataforma.</p>
        </div>
        <a href="<?php echo e(route('root.users.create')); ?>" class="h-12 px-6 bg-primary text-white rounded-2xl font-bold flex items-center gap-2 hover:shadow-xl transition-all active:scale-[0.98]">
            <span class="material-symbols-outlined text-[20px] fill-1">person_add</span>
            Crear Usuario
        </a>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="p-8 bg-white border border-outline rounded-[2rem] shadow-sm">
            <div class="flex items-center gap-6">
                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px]">group</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-3xl font-black text-secondary"><?php echo e($users->count()); ?></span>
                    <span class="text-[10px] text-on-surface-variant font-black uppercase tracking-widest">Total Usuarios</span>
                </div>
            </div>
        </div>
        <div class="p-8 bg-white border border-outline rounded-[2rem] shadow-sm">
            <div class="flex items-center gap-6">
                <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px]">admin_panel_settings</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-3xl font-black text-secondary"><?php echo e($users->where('role', 'administrador')->count()); ?></span>
                    <span class="text-[10px] text-on-surface-variant font-black uppercase tracking-widest">Administradores</span>
                </div>
            </div>
        </div>
        <div class="p-8 bg-white border border-outline rounded-[2rem] shadow-sm">
            <div class="flex items-center gap-6">
                <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px]">person</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-3xl font-black text-secondary"><?php echo e($users->where('role', 'colaborador')->count()); ?></span>
                    <span class="text-[10px] text-on-surface-variant font-black uppercase tracking-widest">Colaboradores</span>
                </div>
            </div>
        </div>
        <div class="p-8 bg-white border border-outline rounded-[2rem] shadow-sm">
            <div class="flex items-center gap-6">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                    <span class="material-symbols-outlined text-[28px]">check_circle</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-3xl font-black text-secondary"><?php echo e($users->where('status', 'activo')->count()); ?></span>
                    <span class="text-[10px] text-on-surface-variant font-black uppercase tracking-widest">Activos</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Section -->
    <div class="bg-white border border-outline rounded-[2.5rem] shadow-sm overflow-hidden">
        <div class="p-8 border-b border-outline flex justify-between items-center bg-gray-50/30">
            <h3 class="text-xl font-bold text-secondary">Lista de Usuarios</h3>
            <div class="flex gap-4">
                <div class="relative">
                    <input type="text" placeholder="Buscar usuario..." class="h-11 pl-10 pr-4 bg-surface-variant/50 border border-outline rounded-xl text-sm focus:bg-white transition-all w-64">
                    <span class="material-symbols-outlined absolute left-3 top-1/2 -translate-y-1/2 text-on-surface-variant text-[20px]">search</span>
                </div>
            </div>
        </div>
        
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-[#f1f5f9]/50">
                        <th class="px-8 py-5 text-[11px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Usuario</th>
                        <th class="px-8 py-5 text-[11px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Rol</th>
                        <th class="px-8 py-5 text-[11px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Estado</th>
                        <th class="px-8 py-5 text-[11px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Fecha de Registro</th>
                        <th class="px-8 py-5 text-[11px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-surface transition-all group">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-2xl bg-surface-variant flex items-center justify-center text-primary font-black border border-outline">
                                        <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-secondary"><?php echo e($user->name); ?></span>
                                        <span class="text-xs text-on-surface-variant font-medium"><?php echo e($user->email); ?></span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?php echo e($user->role === 'administrador' ? 'bg-blue-50 text-blue-700' : ($user->role === 'root' ? 'bg-purple-50 text-purple-700' : 'bg-amber-50 text-amber-700')); ?>">
                                    <?php echo e($user->role); ?>

                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-2.5 h-2.5 rounded-full <?php echo e($user->status === 'activo' ? 'bg-emerald-500 shadow-lg shadow-emerald-500/50' : 'bg-red-500 shadow-lg shadow-red-500/50'); ?>"></div>
                                    <span class="text-xs font-bold text-secondary uppercase tracking-widest"><?php echo e($user->status); ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm font-medium text-on-surface-variant">
                                <?php echo e($user->created_at->format('d M, Y')); ?>

                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex justify-end gap-3 md:opacity-0 md:group-hover:opacity-100 transition-all">
                                    <a href="<?php echo e(route('root.users.edit', $user)); ?>" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-outline text-on-surface-variant hover:text-primary hover:border-primary transition-all shadow-sm">
                                        <span class="material-symbols-outlined text-[20px]">edit</span>
                                    </a>
                                    
                                    <form action="<?php echo e(route('root.users.toggle-status', $user)); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-outline <?php echo e($user->status === 'activo' ? 'text-red-500 hover:border-red-500' : 'text-emerald-500 hover:border-emerald-500'); ?> transition-all shadow-sm">
                                            <span class="material-symbols-outlined text-[20px]"><?php echo e($user->status === 'activo' ? 'block' : 'check_circle'); ?></span>
                                        </button>
                                    </form>

                                    <form action="<?php echo e(route('root.users.destroy', $user)); ?>" method="POST" onsubmit="return confirm('¿Eliminar usuario?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center rounded-xl bg-white border border-outline text-on-surface-variant hover:bg-red-600 hover:text-white transition-all shadow-sm">
                                            <span class="material-symbols-outlined text-[20px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        
        <div class="p-8 bg-gray-50/30 border-t border-outline flex justify-between items-center">
            <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Mostrando <?php echo e($users->count()); ?> usuarios</span>
            <div class="flex gap-3">
                <button class="h-10 px-5 border border-outline rounded-xl text-xs font-black text-on-surface-variant hover:bg-white transition-all disabled:opacity-30" disabled>Anterior</button>
                <button class="h-10 px-5 border border-outline rounded-xl text-xs font-black text-on-surface-variant hover:bg-white transition-all disabled:opacity-30" disabled>Siguiente</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mariapazpelaezrestrepo/Documents/Proyectos Desarrollapp/conduser/resources/views/users/index.blade.php ENDPATH**/ ?>