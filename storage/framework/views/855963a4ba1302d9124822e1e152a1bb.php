<?php $__env->startSection('title', 'Reportes Financieros'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto no-print" x-data="{ activeTab: 'movements' }">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-outline shadow-premium relative overflow-hidden">
        <div class="relative z-10 flex flex-col gap-2">
            <h1 class="text-4xl font-black text-secondary tracking-tight">Reportes Financieros</h1>
            <p class="text-on-surface-variant font-medium">Análisis consolidado, auditoría de transacciones y trazabilidad del sistema.</p>
        </div>
        <div class="relative z-10 flex flex-wrap gap-3">
            <button onclick="window.print()" class="h-12 px-6 bg-white border border-outline text-secondary rounded-2xl font-bold hover:bg-surface-variant transition-all flex items-center gap-2 cursor-pointer">
                <span class="material-symbols-outlined text-[20px]">print</span>
                Imprimir
            </button>
            <button onclick="window.print()" class="h-12 px-6 bg-secondary text-white rounded-2xl font-bold flex items-center gap-2 hover:bg-slate-800 transition-all active:scale-[0.98] cursor-pointer">
                <span class="material-symbols-outlined text-[20px]">picture_as_pdf</span>
                Guardar PDF
            </button>
            <button onclick="exportToExcel()" class="h-12 px-6 bg-primary text-white rounded-2xl font-bold flex items-center gap-2 hover:shadow-lg transition-all active:scale-[0.98] cursor-pointer">
                <span class="material-symbols-outlined text-[20px]">grid_on</span>
                Exportar Excel
            </button>
        </div>
        <!-- Decorative bg -->
        <div class="absolute right-0 top-0 h-full w-1/3 bg-primary/5 -skew-x-12 translate-x-1/2"></div>
    </div>

    <!-- Interactive Filters Form -->
    <div class="bg-white border border-outline rounded-[2.5rem] p-8 shadow-premium">
        <form action="<?php echo e(route('reports.index')); ?>" method="GET" class="flex flex-col gap-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Date range from -->
                <div class="flex flex-col gap-2">
                    <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Fecha Desde</label>
                    <input type="date" name="from_date" value="<?php echo e(request('from_date')); ?>" class="w-full h-12 px-4 rounded-xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" />
                </div>
                <!-- Date range to -->
                <div class="flex flex-col gap-2">
                    <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Fecha Hasta</label>
                    <input type="date" name="to_date" value="<?php echo e(request('to_date')); ?>" class="w-full h-12 px-4 rounded-xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" />
                </div>
                <!-- Account select dropdown -->
                <div class="flex flex-col gap-2">
                    <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Cuenta / Entidad</label>
                    <select name="account" class="w-full h-12 px-4 rounded-xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none">
                        <option value="">Todas las cuentas</option>
                        <?php $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $acc): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($acc); ?>" <?php echo e(request('account') === $acc ? 'selected' : ''); ?>><?php echo e($acc); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
            
            <div class="flex justify-end gap-3 border-t border-outline pt-6">
                <a href="<?php echo e(route('reports.index')); ?>" class="h-12 px-6 rounded-xl border border-outline text-on-surface-variant font-bold hover:bg-surface-variant flex items-center justify-center transition-all text-sm">
                    Limpiar Filtros
                </a>
                <button type="submit" class="h-12 px-8 bg-primary text-white rounded-xl font-bold hover:shadow-md transition-all active:scale-[0.98] text-sm cursor-pointer">
                    Aplicar Filtros
                </button>
            </div>
        </form>
    </div>

    <!-- Analytics Dashboard Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Summary Total Incomes -->
        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-4">
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Ingresos Totales</span>
                    <div class="w-10 h-10 rounded-xl bg-emerald-50 text-primary flex items-center justify-center">
                        <span class="material-symbols-outlined text-[20px]">trending_up</span>
                    </div>
                </div>
                <h3 class="text-3xl font-black text-primary tracking-tighter">+$<?php echo e(number_format($ingresos, 2)); ?></h3>
            </div>
        </div>

        <!-- Summary Total Expenses -->
        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-4">
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Egresos Totales</span>
                    <div class="w-10 h-10 rounded-xl bg-red-50 text-red-600 flex items-center justify-center">
                        <span class="material-symbols-outlined text-[20px]">trending_down</span>
                    </div>
                </div>
                <h3 class="text-3xl font-black text-red-600 tracking-tighter">-$<?php echo e(number_format($egresos, 2)); ?></h3>
            </div>
        </div>

        <!-- Summary Net Balance -->
        <div class="p-8 bg-secondary border border-secondary/20 rounded-[2.5rem] shadow-2xl shadow-secondary/15 hover-lift text-white">
            <div class="flex flex-col gap-4">
                <div class="flex justify-between items-center">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-75">Flujo Caja Neto</span>
                    <div class="w-10 h-10 rounded-xl bg-white/10 text-white flex items-center justify-center backdrop-blur-md">
                        <span class="material-symbols-outlined text-[20px]">account_balance_wallet</span>
                    </div>
                </div>
                <h3 class="text-3xl font-black tracking-tighter">$<?php echo e(number_format($balance, 2)); ?></h3>
            </div>
        </div>
    </div>

    <!-- Calculated Financial Ratios & Indicators -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 bg-surface-variant/20 border border-outline rounded-[2rem] p-6 md:p-8">
        <!-- Margin Ratio -->
        <div class="flex flex-col gap-1 border-b md:border-b-0 md:border-r border-outline pb-4 md:pb-0 md:pr-4">
            <span class="text-[9px] font-black uppercase text-on-surface-variant tracking-wider">Margen de Operación</span>
            <?php
                $margin = $ingresos > 0 ? ($balance / $ingresos) * 100 : 0;
            ?>
            <span class="text-xl font-black <?php echo e($margin >= 0 ? 'text-primary' : 'text-red-500'); ?>"><?php echo e(number_format($margin, 1)); ?>%</span>
            <span class="text-[9px] text-on-surface-variant font-medium">Margen neto consolidado</span>
        </div>
        <!-- Total Transactions -->
        <div class="flex flex-col gap-1 border-b md:border-b-0 md:border-r border-outline pb-4 md:pb-0 md:px-4">
            <span class="text-[9px] font-black uppercase text-on-surface-variant tracking-wider">Volumen Operativo</span>
            <span class="text-xl font-black text-secondary"><?php echo e($movements->count()); ?></span>
            <span class="text-[9px] text-on-surface-variant font-medium">Transacciones registradas</span>
        </div>
        <!-- Average Income -->
        <div class="flex flex-col gap-1 border-b md:border-b-0 md:border-r border-outline pb-4 md:pb-0 md:px-4">
            <span class="text-[9px] font-black uppercase text-on-surface-variant tracking-wider">Ingreso Promedio</span>
            <?php
                $incomeCount = $movements->where('type', 'ingreso')->count();
                $avgIncome = $incomeCount > 0 ? $ingresos / $incomeCount : 0;
            ?>
            <span class="text-xl font-black text-primary">$<?php echo e(number_format($avgIncome, 0)); ?></span>
            <span class="text-[9px] text-on-surface-variant font-medium">Por curso o matrícula</span>
        </div>
        <!-- Average Expense -->
        <div class="flex flex-col gap-1 px-4">
            <span class="text-[9px] font-black uppercase text-on-surface-variant tracking-wider">Gasto Promedio</span>
            <?php
                $expenseCount = $movements->where('type', 'egreso')->count();
                $avgExpense = $expenseCount > 0 ? $egresos / $expenseCount : 0;
            ?>
            <span class="text-xl font-black text-red-500">$<?php echo e(number_format($avgExpense, 0)); ?></span>
            <span class="text-[9px] text-on-surface-variant font-medium">Por mantenimiento/nómina</span>
        </div>
    </div>

    <!-- Tabs & Tables Section (Historial Contable vs Trazabilidad) -->
    <div class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
        <!-- Interactive Tabs Header -->
        <div class="border-b border-outline bg-gray-50/20 px-8 py-5 flex justify-between items-center flex-wrap gap-4">
            <div class="flex gap-4">
                <button @click="activeTab = 'movements'" 
                        :class="activeTab === 'movements' ? 'bg-primary-light text-primary' : 'text-on-surface-variant hover:text-secondary hover:bg-surface-variant/30'"
                        class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all cursor-pointer">
                    Historial Contable
                </button>
                <button @click="activeTab = 'traceability'" 
                        :class="activeTab === 'traceability' ? 'bg-primary-light text-primary' : 'text-on-surface-variant hover:text-secondary hover:bg-surface-variant/30'"
                        class="px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest transition-all cursor-pointer">
                    Trazabilidad de Auditoría
                </button>
            </div>
            <span class="text-xs text-on-surface-variant font-medium" x-text="activeTab === 'movements' ? '<?php echo e($movements->count()); ?> movimientos' : '<?php echo e($auditLogs->count()); ?> bitácoras'"></span>
        </div>

        <!-- Tab Content 1: Movements History -->
        <div x-show="activeTab === 'movements'" class="overflow-x-auto">
            <table class="w-full text-left min-w-[700px]">
                <thead>
                    <tr class="bg-[#f1f5f9]/50">
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Fecha</th>
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Detalle / Concepto</th>
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Cuenta</th>
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Registrador</th>
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Estado</th>
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline text-right">Monto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    <?php $__empty_1 = true; $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-surface transition-all">
                        <td class="px-8 py-5 text-xs font-bold text-on-surface-variant">
                            <?php echo e($m->date->format('d M, Y')); ?>

                        </td>
                        <td class="px-8 py-5">
                            <div class="flex flex-col gap-0.5 max-w-xs">
                                <span class="text-xs font-black text-secondary"><?php echo e($m->description); ?></span>
                                <span class="text-[9px] font-bold uppercase tracking-wider <?php echo e($m->type === 'ingreso' ? 'text-primary' : 'text-red-500'); ?>"><?php echo e($m->type); ?></span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-xs font-bold text-secondary uppercase tracking-tight">
                            <?php echo e($m->associated_to ?? 'General'); ?>

                        </td>
                        <td class="px-8 py-5 text-xs font-semibold text-on-surface-variant">
                            <?php echo e($m->user ? $m->user->name : 'Sistema'); ?>

                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider <?php echo e($m->status === 'completado' ? 'bg-emerald-50 text-primary border border-emerald-100' : 'bg-amber-50 text-amber-600 border border-amber-100'); ?>">
                                <?php echo e($m->status); ?>

                            </span>
                        </td>
                        <td class="px-8 py-5 text-xs font-black text-right <?php echo e($m->type === 'ingreso' ? 'text-primary' : 'text-red-600'); ?>">
                            <?php echo e($m->type === 'ingreso' ? '+' : '-'); ?>$<?php echo e(number_format($m->amount, 2)); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="text-center py-20 text-xs font-bold text-on-surface-variant opacity-60">No se encontraron movimientos con los filtros aplicados.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Tab Content 2: Audit Traceability Log -->
        <div x-show="activeTab === 'traceability'" x-cloak class="overflow-x-auto">
            <table class="w-full text-left min-w-[700px]">
                <thead>
                    <tr class="bg-[#f1f5f9]/50">
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Fecha y Hora</th>
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Administrador</th>
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Acción</th>
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Entidad / Modelo</th>
                        <th class="px-8 py-5 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Descripción Completa del Cambio</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    <?php $__empty_1 = true; $__currentLoopData = $auditLogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $log): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-surface transition-all">
                        <td class="px-8 py-5 text-xs font-bold text-on-surface-variant">
                            <?php echo e($log->created_at->format('d M, Y • h:i A')); ?>

                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg bg-surface-variant flex items-center justify-center text-primary font-black border border-outline text-xs">
                                    <?php echo e(strtoupper(substr($log->user ? $log->user->name : 'S', 0, 1))); ?>

                                </div>
                                <div class="flex flex-col">
                                    <span class="text-xs font-black text-secondary"><?php echo e($log->user ? $log->user->name : 'Sistema'); ?></span>
                                    <span class="text-[9px] text-on-surface-variant uppercase font-bold tracking-wider"><?php echo e($log->user ? $log->user->role : 'root'); ?></span>
                                </div>
                            </div>
                        </td>
                        <td class="px-8 py-5">
                            <span class="px-3 py-1 rounded-full text-[9px] font-black uppercase tracking-wider <?php echo e($log->action === 'created' ? 'bg-emerald-50 text-primary border border-emerald-100' : ($log->action === 'deleted' ? 'bg-red-50 text-red-700 border border-red-100' : 'bg-blue-50 text-blue-600 border border-blue-100')); ?>">
                                <?php echo e($log->action); ?>

                            </span>
                        </td>
                        <td class="px-8 py-5 text-xs font-bold text-on-surface-variant">
                            <?php echo e($log->model_type); ?> (ID: <?php echo e($log->model_id); ?>)
                        </td>
                        <td class="px-8 py-5 text-xs font-semibold text-secondary leading-relaxed">
                            <?php echo e($log->details); ?>

                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="5" class="text-center py-20 text-xs font-bold text-on-surface-variant opacity-60">No hay registros de auditoría en la bitácora.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ========================================== -->
<!-- REPORTE DE IMPRESIÓN OFICIAL (PRINT ONLY) -->
<!-- ========================================== -->
<div class="print-only p-10 flex flex-col gap-8 text-black" style="display: none;">
    <!-- Letterhead Header -->
    <div class="flex justify-between items-center border-b-4 border-emerald-800 pb-6">
        <div class="flex flex-col">
            <h1 class="text-3xl font-black text-[#006837] tracking-tight">ACADEMIA CONDUSER</h1>
            <span class="text-xs font-bold tracking-widest text-slate-500 uppercase">Sistema Integral de Control Financiero y Auditoría</span>
            <span class="text-xs text-slate-400 mt-1">Generado automáticamente por Antigravity AI el <?php echo e(date('d/m/Y - h:i A')); ?></span>
        </div>
        <div class="text-right flex flex-col justify-end">
            <h3 class="text-lg font-black text-slate-800">REPORTE FINANCIERO OFICIAL</h3>
            <span class="text-xs font-medium">Entorno de Producción: Hostinger</span>
            <span class="text-[10px] font-bold text-slate-500 mt-1 uppercase tracking-wide">
                Filtros: <?php echo e(request('account') ? 'Cuenta: ' . request('account') : 'Todas las cuentas'); ?> 
                <?php echo e(request('from_date') ? '• Desde: ' . request('from_date') : ''); ?> 
                <?php echo e(request('to_date') ? '• Hasta: ' . request('to_date') : ''); ?>

            </span>
        </div>
    </div>

    <!-- Financial Balances -->
    <div class="grid grid-cols-3 gap-6 text-center">
        <div class="border border-slate-300 p-6 rounded-2xl flex flex-col gap-1">
            <span class="text-[9px] font-bold uppercase text-slate-500 tracking-wider">Total Ingresos</span>
            <h2 class="text-2xl font-black text-emerald-700">+$<?php echo e(number_format($ingresos, 2)); ?></h2>
        </div>
        <div class="border border-slate-300 p-6 rounded-2xl flex flex-col gap-1">
            <span class="text-[9px] font-bold uppercase text-slate-500 tracking-wider">Total Egresos</span>
            <h2 class="text-2xl font-black text-red-600">-$<?php echo e(number_format($egresos, 2)); ?></h2>
        </div>
        <div class="border border-slate-300 p-6 rounded-2xl flex flex-col gap-1" style="background-color: #f8fafc;">
            <span class="text-[9px] font-bold uppercase text-slate-500 tracking-wider">Balance de Caja Neto</span>
            <h2 class="text-2xl font-black text-slate-800">$<?php echo e(number_format($balance, 2)); ?></h2>
        </div>
    </div>

    <!-- Financial Ratios & Performance Indicators -->
    <div class="border border-slate-300 p-6 rounded-2xl flex flex-col gap-4">
        <h4 class="text-xs font-black uppercase text-slate-800 tracking-wider border-b border-slate-200 pb-2">Indicadores Contables</h4>
        <div class="grid grid-cols-4 gap-4 text-center">
            <div class="flex flex-col">
                <span class="text-[9px] font-bold text-slate-500 uppercase">Margen Neto</span>
                <span class="text-sm font-black"><?php echo e(number_format($margin, 2)); ?>%</span>
            </div>
            <div class="flex flex-col">
                <span class="text-[9px] font-bold text-slate-500 uppercase">Volumen</span>
                <span class="text-sm font-black"><?php echo e($movements->count()); ?> transacciones</span>
            </div>
            <div class="flex flex-col">
                <span class="text-[9px] font-bold text-slate-500 uppercase">Ingreso Promedio</span>
                <span class="text-sm font-black">$<?php echo e(number_format($avgIncome, 2)); ?></span>
            </div>
            <div class="flex flex-col">
                <span class="text-[9px] font-bold text-slate-500 uppercase">Gasto Promedio</span>
                <span class="text-sm font-black">$<?php echo e(number_format($avgExpense, 2)); ?></span>
            </div>
        </div>
    </div>

    <!-- Movements Table -->
    <div class="flex flex-col gap-3">
        <h4 class="text-xs font-black uppercase text-slate-800 tracking-wider border-b-2 border-slate-800 pb-2">Desglose Detallado de Movimientos</h4>
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="border-b border-slate-400 font-black text-slate-600 bg-slate-100">
                    <th class="py-2 px-3">Fecha</th>
                    <th class="py-2 px-3">Detalle / Concepto</th>
                    <th class="py-2 px-3">Cuenta Asociada</th>
                    <th class="py-2 px-3">Registrador</th>
                    <th class="py-2 px-3 text-right">Monto</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-200">
                <?php $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="py-2 px-3 font-semibold"><?php echo e($m->date->format('d/m/Y')); ?></td>
                    <td class="py-2 px-3 font-black"><?php echo e($m->description); ?> (<?php echo e($m->type); ?>)</td>
                    <td class="py-2 px-3"><?php echo e($m->associated_to ?? 'General'); ?></td>
                    <td class="py-2 px-3"><?php echo e($m->user ? $m->user->name : 'Sistema'); ?></td>
                    <td class="py-2 px-3 text-right font-bold <?php echo e($m->type === 'ingreso' ? 'text-emerald-700' : 'text-red-700'); ?>">
                        <?php echo e($m->type === 'ingreso' ? '+' : '-'); ?>$<?php echo e(number_format($m->amount, 2)); ?>

                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>

    <!-- Signatures -->
    <div class="grid grid-cols-2 gap-10 mt-16 text-center text-xs">
        <div class="flex flex-col gap-1">
            <div class="border-b border-slate-500 w-48 mx-auto h-10"></div>
            <span class="font-black text-slate-800"><?php echo e(auth()->user()->name); ?></span>
            <span class="text-[9px] text-slate-500 uppercase tracking-wide">Firma Responsable (<?php echo e(auth()->user()->role); ?>)</span>
        </div>
        <div class="flex flex-col gap-1">
            <div class="border-b border-slate-500 w-48 mx-auto h-10"></div>
            <span class="font-black text-slate-800">Sello Academia Conduser</span>
            <span class="text-[9px] text-slate-500 uppercase tracking-wide">Dirección de Auditoría Interna</span>
        </div>
    </div>
</div>

<style>
    @media print {
        .no-print, header, footer, aside, .absolute, button, a {
            display: none !important;
        }
        body, main {
            background-color: white !important;
            color: black !important;
            padding: 0 !important;
            margin: 0 !important;
        }
        .print-only {
            display: flex !important;
        }
    }
</style>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script>
    function exportToExcel() {
        const wb = XLSX.utils.book_new();
        
        // 1. Cabecera general
        const summaryData = [
            ["REPORTE FINANCIERO OFICIAL - ACADEMIA CONDUSER"],
            ["Fecha de Generación", new Date().toLocaleString()],
            ["Margen de Operación", "<?php echo e(number_format($margin, 2)); ?>%"],
            ["Ingresos Totales", "<?php echo e($ingresos); ?>"],
            ["Egresos Totales", "<?php echo e($egresos); ?>"],
            ["Balance Neto", "<?php echo e($balance); ?>"],
            [],
            ["HISTORIAL DE MOVIMIENTOS"],
            ["Fecha", "Concepto", "Tipo", "Cuenta Asociada", "Monto"]
        ];

        <?php $__currentLoopData = $movements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            summaryData.push([
                "<?php echo e($m->date->format('d/m/Y')); ?>",
                "<?php echo e(str_replace('"', '""', $m->description)); ?>",
                "<?php echo e($m->type); ?>",
                "<?php echo e(str_replace('"', '""', $m->associated_to ?? 'General')); ?>",
                <?php echo e($m->amount); ?>

            ]);
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        const ws = XLSX.utils.aoa_to_sheet(summaryData);
        XLSX.utils.book_append_sheet(wb, ws, "Reporte Financiero");
        
        XLSX.writeFile(wb, "reporte_financiero_conduser.xlsx");
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mariapazpelaezrestrepo/Documents/Proyectos Desarrollapp/conduser/resources/views/reports/index.blade.php ENDPATH**/ ?>