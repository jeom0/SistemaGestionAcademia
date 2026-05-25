<?php $__env->startSection('title', auth()->user()->isCollaborator() ? 'Registrar Egreso' : 'Registrar Movimiento'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-10 max-w-[1200px] mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-black text-secondary tracking-tight">
                <?php echo e(auth()->user()->isCollaborator() ? 'Registrar Egreso' : 'Registrar Movimiento'); ?>

            </h1>
            <p class="text-on-surface-variant font-medium">Añade una nueva transacción financiera al sistema de control.</p>
        </div>
        <a href="<?php echo e(route('movements.index')); ?>" class="h-12 px-6 border border-outline text-secondary rounded-2xl font-bold flex items-center justify-center gap-2 hover:bg-surface-variant transition-all cursor-pointer shrink-0">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Volver
        </a>
    </div>

    <!-- Core Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Main Form Column (2/3 Width) -->
        <div class="lg:col-span-2 flex flex-col gap-8">
            <div class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
                <div class="p-8 md:p-10 border-b border-outline bg-gray-50/20">
                    <h3 class="text-xl font-bold text-secondary flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary fill-1">payments</span>
                        Información Financiera
                    </h3>
                </div>
                
                <div class="p-8 md:p-12">
                    <form action="<?php echo e(route('movements.store')); ?>" method="POST" class="flex flex-col gap-8">
                        <?php echo csrf_field(); ?>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Type of Movement -->
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Tipo de Movimiento</label>
                                <?php if(auth()->user()->isCollaborator()): ?>
                                    <input type="hidden" name="type" value="egreso">
                                    <div class="w-full h-14 px-5 rounded-2xl bg-surface-variant/40 border border-outline flex items-center gap-3 text-red-600 font-bold select-none">
                                        <span class="material-symbols-outlined">trending_down</span>
                                        Egreso <span class="text-[10px] text-on-surface-variant/60 font-semibold uppercase tracking-wider ml-1">(Rol Colaborador)</span>
                                    </div>
                                <?php else: ?>
                                    <div class="relative">
                                        <select class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none" 
                                                id="type" 
                                                name="type" 
                                                required>
                                            <option value="">Selecciona tipo...</option>
                                            <option value="ingreso" <?php echo e(old('type') == 'ingreso' ? 'selected' : ''); ?>>Ingreso (+)</option>
                                            <option value="egreso" <?php echo e(old('type') == 'egreso' ? 'selected' : ''); ?>>Egreso (-)</option>
                                        </select>
                                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                                    </div>
                                    <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="text-xs text-red-500 font-bold ml-1"><?php echo e($message); ?></span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <?php endif; ?>
                            </div>

                            <!-- Amount -->
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Monto ($ COP)</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-on-surface-variant font-bold">$</span>
                                    <input type="number" 
                                           step="0.01" 
                                           min="0.01" 
                                           class="w-full h-14 pl-10 pr-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-bold" 
                                           id="amount" 
                                           name="amount" 
                                           value="<?php echo e(old('amount')); ?>" 
                                           placeholder="0.00" 
                                           required>
                                </div>
                                <?php $__errorArgs = ['amount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-xs text-red-500 font-bold ml-1"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Date -->
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Fecha del Movimiento</label>
                                <input type="date" 
                                       class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" 
                                       id="date" 
                                       name="date" 
                                       value="<?php echo e(old('date', date('Y-m-d'))); ?>" 
                                       required>
                                <?php $__errorArgs = ['date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-xs text-red-500 font-bold ml-1"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <!-- Associated to -->
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Asociado a (Cuenta / Entidad)</label>
                                <input type="text" 
                                       class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" 
                                       id="associated_to" 
                                       name="associated_to" 
                                       value="<?php echo e(old('associated_to')); ?>" 
                                       placeholder="Banco Principal, Caja Chica, etc.">
                                <?php $__errorArgs = ['associated_to'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="text-xs text-red-500 font-bold ml-1"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="flex flex-col gap-2">
                            <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Descripción</label>
                            <textarea class="w-full p-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium resize-none" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Describe detalladamente el movimiento (mínimo 3 caracteres)..." 
                                      required><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="text-xs text-red-500 font-bold ml-1"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <?php if(!auth()->user()->isCollaborator()): ?>
                            <div class="p-5 bg-emerald-50 border border-emerald-100 text-emerald-950 rounded-2xl flex items-start gap-3">
                                <span class="material-symbols-outlined text-primary shrink-0">info</span>
                                <p class="text-[11px] font-medium leading-relaxed">
                                    Este movimiento quedará registrado a nombre del usuario administrativo <strong><?php echo e(auth()->user()->name); ?></strong> el <?php echo e(date('d/m/Y H:i')); ?>.
                                </p>
                            </div>
                        <?php endif; ?>

                        <div class="flex flex-col sm:flex-row justify-end gap-4 border-t border-outline pt-8">
                            <a href="<?php echo e(route('movements.index')); ?>" class="h-14 px-8 rounded-2xl border border-outline text-on-surface-variant font-bold text-sm hover:bg-surface-variant flex items-center justify-center transition-all">
                                Cancelar
                            </a>
                            <button type="submit" class="h-14 px-8 bg-primary text-white rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-primary/20 transition-all active:scale-[0.98]">
                                <?php echo e(auth()->user()->isCollaborator() ? 'Registrar Egreso' : 'Registrar Movimiento'); ?>

                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Tips & Permissions Column (1/3 Width) -->
        <div class="flex flex-col gap-8">
            <!-- Concept Tips Card -->
            <div class="bg-white border border-outline rounded-[2.5rem] p-8 shadow-premium flex flex-col gap-6">
                <h4 class="text-xs font-black text-secondary uppercase tracking-widest border-b border-outline pb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-amber-500 fill-1">lightbulb</span>
                    Recomendaciones
                </h4>
                
                <div class="flex flex-col gap-6">
                    <div class="flex flex-col gap-2">
                        <h5 class="text-xs font-black text-primary uppercase tracking-wider flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">trending_up</span> Ingresos
                        </h5>
                        <ul class="text-xs font-medium text-on-surface-variant flex flex-col gap-1.5 pl-5 list-disc leading-relaxed">
                            <li>Pagos de matrículas o cursos.</li>
                            <li>Ventas de guías y exámenes.</li>
                            <li>Incentivos u otros abonos.</li>
                        </ul>
                    </div>
                    
                    <div class="flex flex-col gap-2">
                        <h5 class="text-xs font-black text-red-500 uppercase tracking-wider flex items-center gap-1.5">
                            <span class="material-symbols-outlined text-[16px]">trending_down</span> Egresos
                        </h5>
                        <ul class="text-xs font-medium text-on-surface-variant flex flex-col gap-1.5 pl-5 list-disc leading-relaxed">
                            <li>Combustible y SOAT de flota.</li>
                            <li>Mantenimiento mecánico de vehículos.</li>
                            <li>Suministros de oficina y servicios públicos.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Role Permissions Card -->
            <div class="bg-white border border-outline rounded-[2.5rem] p-8 shadow-premium flex flex-col gap-4">
                <h4 class="text-xs font-black text-secondary uppercase tracking-widest border-b border-outline pb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-indigo-600 fill-1">shield</span>
                    Permisos de Cuenta
                </h4>
                
                <ul class="flex flex-col gap-3">
                    <?php if(auth()->user()->isCollaborator()): ?>
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-emerald-500 text-[18px] shrink-0">check_circle</span>
                            <span>Registro exclusivo de egresos de caja.</span>
                        </li>
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-emerald-500 text-[18px] shrink-0">check_circle</span>
                            <span>Gestión de tu propio historial personal.</span>
                        </li>
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-red-500 text-[18px] shrink-0">cancel</span>
                            <span>No está autorizado a registrar ingresos.</span>
                        </li>
                    <?php else: ?>
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-emerald-500 text-[18px] shrink-0">check_circle</span>
                            <span>Control completo de ingresos y egresos.</span>
                        </li>
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-emerald-500 text-[18px] shrink-0">check_circle</span>
                            <span>Aprobación y edición global del historial.</span>
                        </li>
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-emerald-500 text-[18px] shrink-0">check_circle</span>
                            <span>Permisos de eliminación autorizados.</span>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mariapazpelaezrestrepo/Documents/Proyectos Desarrollapp/conduser/resources/views/movements/create.blade.php ENDPATH**/ ?>