<?php $__env->startSection('title', 'Gestión de Descuentos'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-10">
    <div class="flex flex-col gap-1">
        <h1 class="text-4xl font-black text-secondary tracking-tight">Descuentos de la Empresa</h1>
        <p class="text-on-surface-variant font-medium">Deducciones aplicadas a los colaboradores por diversos conceptos.</p>
    </div>

    <div class="bg-white border border-outline rounded-[3rem] shadow-premium overflow-hidden hover-lift">
        <div class="p-10 border-b border-outline bg-gray-50/30">
            <h3 class="text-2xl font-black text-secondary">Historial de Descuentos</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Fecha</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Colaborador</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline text-right">Monto</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline text-center">Estado</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    <?php $__empty_1 = true; $__currentLoopData = $descuentos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-primary/[0.02] transition-all">
                            <td class="px-8 py-6 text-sm font-bold text-secondary"><?php echo e($m->date->format('d/m/Y')); ?></td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-red-100 text-red-600 flex items-center justify-center text-xs font-black">
                                        <?php echo e(strtoupper(substr($m->user->name ?? 'C', 0, 1))); ?>

                                    </div>
                                    <span class="text-sm font-bold text-secondary"><?php echo e($m->user->name ?? 'Colaborador'); ?></span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right text-sm font-black text-red-600">-$<?php echo e(number_format($m->amount, 0)); ?></td>
                            <td class="px-8 py-6 text-center">
                                <span class="badge <?php echo e($m->status === 'completado' ? 'bg-success' : 'bg-amber'); ?>">
                                    <?php echo e($m->status); ?>

                                </span>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center text-on-surface-variant">No hay descuentos registrados.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <?php if($descuentos->hasPages()): ?>
            <div class="p-8 border-t border-outline">
                <?php echo e($descuentos->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\PC\Desktop\conduser\resources\views/payroll/descuentos.blade.php ENDPATH**/ ?>