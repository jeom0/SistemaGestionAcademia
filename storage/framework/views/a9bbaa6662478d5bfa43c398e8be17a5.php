<?php $__env->startSection('title', 'Dashboard Root'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto">
    <!-- Welcome Header -->
    <div class="flex justify-between items-center bg-white p-10 rounded-[2.5rem] border border-outline shadow-sm relative overflow-hidden">
        <div class="relative z-10 flex flex-col gap-2">
            <h1 class="text-4xl font-black text-secondary tracking-tight">Bienvenido, <?php echo e(auth()->user()->name); ?></h1>
            <p class="text-on-surface-variant font-medium">Panel de control administrativo - Gestión global de la plataforma.</p>
        </div>
        <!-- Decorative bg -->
        <div class="absolute right-0 top-0 h-full w-1/3 bg-primary/5 -skew-x-12 translate-x-1/2"></div>
        <div class="relative z-10 hidden md:block">
            <div class="w-20 h-20 bg-primary/10 rounded-3xl flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[48px] fill-1">admin_panel_settings</span>
            </div>
        </div>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="p-8 bg-gradient-to-br from-primary to-[#004d29] border border-primary/20 rounded-[2.5rem] shadow-2xl shadow-primary/20 hover-lift group text-white">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-white/20 text-white flex items-center justify-center group-hover:scale-110 transition-all backdrop-blur-md">
                    <span class="material-symbols-outlined text-[28px]">account_balance</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] opacity-80">Balance Global</span>
                    <?php
                        $balance = \App\Models\Movement::where('type', 'ingreso')->sum('amount') - \App\Models\Movement::where('type', 'egreso')->sum('amount');
                    ?>
                    <span class="text-4xl font-black mt-2 tracking-tighter">$<?php echo e(number_format($balance, 0)); ?></span>
                </div>
            </div>
        </div>

        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-indigo-600 group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">group</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Usuarios Totales</span>
                    <span class="text-4xl font-black text-secondary mt-2 tracking-tighter"><?php echo e(\App\Models\User::count()); ?></span>
                </div>
            </div>
        </div>

        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">verified_user</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Activos Ahora</span>
                    <span class="text-4xl font-black text-secondary mt-2 tracking-tighter"><?php echo e(\App\Models\User::where('status', 'activo')->count()); ?></span>
                </div>
            </div>
        </div>

        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-amber-600 group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">pending_actions</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Por Procesar</span>
                    <span class="text-4xl font-black text-secondary mt-2 tracking-tighter"><?php echo e(\App\Models\Movement::where('status', 'pendiente')->count()); ?></span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
        <!-- Recent Users Card -->
        <div class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden hover-lift group">
            <div class="p-8 border-b border-outline flex justify-between items-center bg-gray-50/30">
                <h3 class="text-xl font-bold text-secondary">Usuarios Recientes</h3>
                <a href="<?php echo e(route('root.users.index')); ?>" class="text-sm font-bold text-primary hover:underline">Ver todos</a>
            </div>
            <div class="p-8">
                <div class="flex flex-col gap-6">
                    <?php $__currentLoopData = $users->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between group/item p-2 rounded-2xl hover:bg-surface-variant transition-all">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-2xl bg-white flex items-center justify-center text-primary font-black border border-outline text-lg shadow-sm group-hover/item:scale-110 transition-transform">
                                    <?php echo e(strtoupper(substr($user->name, 0, 1))); ?>

                                </div>
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-secondary"><?php echo e($user->name); ?></span>
                                    <span class="text-[10px] text-on-surface-variant uppercase font-black tracking-widest"><?php echo e($user->role); ?></span>
                                </div>
                            </div>
                            <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest <?php echo e($user->status === 'activo' ? 'bg-emerald-100 text-primary' : 'bg-red-50 text-red-700'); ?>">
                                <?php echo e($user->status); ?>

                            </span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>

        <!-- Movements Summary Card -->
        <div class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden flex flex-col hover-lift group">
            <div class="p-8 border-b border-outline flex justify-between items-center bg-gray-50/30">
                <h3 class="text-xl font-bold text-secondary">Resumen de Movimientos</h3>
                <a href="<?php echo e(route('movements.index')); ?>" class="text-sm font-bold text-primary hover:underline">Ver Historial</a>
            </div>
            <div class="p-8 flex-1">
                <div class="flex flex-col gap-6">
                    <?php
                        $recentMovements = \App\Models\Movement::orderBy('created_at', 'desc')->take(6)->get();
                    ?>
                    <?php $__currentLoopData = $recentMovements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 rounded-xl <?php echo e($m->type === 'ingreso' ? 'bg-emerald-50 text-primary' : 'bg-red-50 text-red-600'); ?> flex items-center justify-center shrink-0">
                                    <span class="material-symbols-outlined text-[20px]"><?php echo e($m->type === 'ingreso' ? 'trending_up' : 'trending_down'); ?></span>
                                </div>
                                <div class="flex flex-col overflow-hidden">
                                    <span class="text-sm font-bold text-secondary truncate w-40"><?php echo e($m->description); ?></span>
                                    <span class="text-[10px] text-on-surface-variant font-black uppercase tracking-widest"><?php echo e($m->date->format('d M, Y')); ?></span>
                                </div>
                            </div>
                            <div class="flex flex-col items-end">
                                <span class="text-sm font-black <?php echo e($m->type === 'ingreso' ? 'text-primary' : 'text-red-600'); ?>">
                                    <?php echo e($m->type === 'ingreso' ? '+' : '-'); ?>$<?php echo e(number_format($m->amount, 0)); ?>

                                </span>
                                <span class="text-[9px] font-bold uppercase <?php echo e($m->status === 'completado' ? 'text-emerald-500' : 'text-amber-500'); ?>">
                                    <?php echo e($m->status); ?>

                                </span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="mt-10 p-6 bg-secondary rounded-[2rem] flex items-center justify-between text-white shadow-xl shadow-secondary/10">
                    <div class="flex flex-col">
                        <span class="text-[10px] text-on-surface-variant font-black uppercase tracking-[0.2em] opacity-60">Flujo de Caja</span>
                        <span class="text-lg font-bold">Resumen Diario</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-emerald-400 rounded-full animate-pulse"></div>
                        <span class="text-[11px] font-black uppercase tracking-widest">Actualizado</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mariapazpelaezrestrepo/Documents/Proyectos Desarrollapp/conduser/resources/views/dashboards/root.blade.php ENDPATH**/ ?>