<?php $__env->startSection('title', 'Movimientos'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto">
    <!-- Header Area (Image 1 Style) -->
    <div class="flex justify-between items-center">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-black text-secondary tracking-tight">
                <?php echo e(request()->query('status') === 'pendiente' ? 'Movimientos Pendientes' : 'Historial de Movimientos'); ?>

            </h1>
            <p class="text-on-surface-variant font-medium">
                <?php echo e(request()->query('status') === 'pendiente' ? 'Gestione los registros que aún requieren atención.' : 'Listado completo de todas las transacciones del sistema.'); ?>

            </p>
        </div>
        <a href="<?php echo e(route('movements.create')); ?>" class="h-12 px-6 bg-primary text-white rounded-2xl font-bold flex items-center gap-2 hover:shadow-lg hover:shadow-primary/20 transition-all active:scale-[0.98]">
            <span class="material-symbols-outlined text-[20px] fill-1">add</span>
            Crear
        </a>
    </div>

    <?php if(!request()->filled('status')): ?>
    <!-- Quick Entry Form (Image 1 Style) -->
    <div class="bg-white border border-outline rounded-[2rem] shadow-sm overflow-hidden">
        <div class="p-10 flex flex-col gap-8">
            <form action="<?php echo e(route('movements.store')); ?>" method="POST" class="flex flex-col gap-6">
                <?php echo csrf_field(); ?>
                <div class="grid grid-cols-1 md:grid-cols-5 gap-6">
                    <!-- Monto -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Monto</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-on-surface-variant font-bold">$</span>
                            <input type="number" step="0.01" name="amount" class="w-full h-14 pl-8 pr-4 rounded-2xl bg-surface-variant/50 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-bold" placeholder="0.00" required>
                        </div>
                    </div>
                    <!-- Fecha -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Fecha</label>
                        <input type="date" name="date" value="<?php echo e(date('Y-m-d')); ?>" class="w-full h-14 px-4 rounded-2xl bg-surface-variant/50 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" required>
                    </div>
                    <!-- Tipo -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Tipo</label>
                        <select name="type" class="w-full h-14 px-4 rounded-2xl bg-surface-variant/50 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none" required>
                            <option value="">Seleccione...</option>
                            <option value="ingreso">Ingreso</option>
                            <option value="egreso">Egreso</option>
                        </select>
                    </div>
                    <!-- Estado -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Estado</label>
                        <select name="status" class="w-full h-14 px-4 rounded-2xl bg-surface-variant/50 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none" required>
                            <option value="completado">Completado</option>
                            <option value="pendiente">Pendiente</option>
                        </select>
                    </div>
                    <!-- Asocia -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Asocia</label>
                        <select name="associated_to" class="w-full h-14 px-4 rounded-2xl bg-surface-variant/50 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none">
                            <option value="">Cuenta o Entidad</option>
                            <option value="Banco Principal">Banco Principal</option>
                            <option value="Caja Chica">Caja Chica</option>
                        </select>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="flex flex-col gap-2">
                    <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Descripción</label>
                    <textarea name="description" rows="3" class="w-full p-4 rounded-2xl bg-surface-variant/50 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium resize-none" placeholder="Detalles del movimiento..." required></textarea>
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-8 py-4 bg-secondary text-white rounded-2xl font-black text-sm hover:shadow-xl hover:shadow-secondary/20 transition-all active:scale-[0.98]">
                        Registrar Movimiento
                    </button>
                </div>
            </form>
        </div>
    </div>
    <?php endif; ?>

    <!-- Recent Movements Table (Image 1/3 Style) -->
    <div class="bg-white border border-outline rounded-[2rem] shadow-sm overflow-hidden">
        <div class="p-8 border-b border-outline flex justify-between items-center bg-gray-50/30">
            <h3 class="text-xl font-bold text-secondary">Movimientos Recientes</h3>
            <button class="w-10 h-10 rounded-xl hover:bg-surface-variant flex items-center justify-center text-on-surface-variant transition-all">
                <span class="material-symbols-outlined">filter_list</span>
            </button>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Fecha</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Descripción</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Asocia</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline text-right">Monto</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Estado</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    <?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-primary/[0.02] transition-all group/row">
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-secondary"><?php echo e($m->date->format('d M')); ?></span>
                                    <span class="text-[10px] text-on-surface-variant font-medium"><?php echo e($m->date->format('Y')); ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl <?php echo e($m->type === 'ingreso' ? 'bg-emerald-50 text-primary' : 'bg-red-50 text-red-600'); ?> flex items-center justify-center shrink-0 group-hover/row:scale-110 transition-transform shadow-sm">
                                        <span class="material-symbols-outlined text-[20px]"><?php echo e($m->type === 'ingreso' ? 'trending_up' : 'trending_down'); ?></span>
                                    </div>
                                    <span class="text-sm font-bold text-secondary truncate max-w-[200px]"><?php echo e($m->description); ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-surface-variant/50 text-secondary text-[10px] font-black uppercase tracking-widest rounded-lg">
                                    <?php echo e($m->associated_to ?? 'General'); ?>

                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <span class="text-sm font-black <?php echo e($m->type === 'ingreso' ? 'text-primary' : 'text-red-600'); ?>">
                                    <?php echo e($m->type === 'ingreso' ? '+' : '-'); ?>$<?php echo e(number_format($m->amount, 0)); ?>

                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="badge <?php echo e($m->status === 'completado' ? 'bg-success' : 'bg-amber'); ?>">
                                    <?php echo e($m->status); ?>

                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-center gap-3">
                                    <?php if($m->status === 'pendiente'): ?>
                                        <form action="<?php echo e(route('movements.complete', $m)); ?>" method="POST">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PATCH'); ?>
                                            <button type="submit" class="w-9 h-9 rounded-xl bg-emerald-50 text-primary hover:bg-primary hover:text-white transition-all flex items-center justify-center shadow-sm" title="Completar">
                                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                    <a href="<?php echo e(route('movements.edit', $m)); ?>" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center shadow-sm" title="Editar">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    <form action="<?php echo e(route('movements.destroy', $m)); ?>" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center shadow-sm" title="Eliminar">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <span class="material-symbols-outlined text-5xl text-on-surface-variant/20">search_off</span>
                                    <p class="text-on-surface-variant font-medium">No se encontraron movimientos.</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        
        <?php if($movements instanceof \Illuminate\Pagination\LengthAwarePaginator): ?>
        <div class="p-8 border-t border-outline flex items-center justify-between bg-gray-50/30">
            <span class="text-xs font-bold text-on-surface-variant">Mostrando <?php echo e($movements->firstItem()); ?>-<?php echo e($movements->lastItem()); ?> de <?php echo e($movements->total()); ?> movimientos</span>
            <div class="flex gap-2">
                <?php echo e($movements->links()); ?>

            </div>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PC\Desktop\conduser\resources\views/movements/index.blade.php ENDPATH**/ ?>