<?php $__env->startSection('title', 'Cuentas'); ?>

<?php $__env->startSection('content'); ?>
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto" x-data="{ modalOpen: false, activeAccountName: '', activeAccountBalance: 0, activeAccountMovements: [] }">
    <!-- Header -->
    <div class="flex justify-between items-center bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-outline shadow-premium relative overflow-hidden">
        <div class="relative z-10 flex flex-col gap-2">
            <h1 class="text-2xl md:text-4xl font-black text-secondary tracking-tight">Mis Cuentas</h1>
            <p class="text-xs md:text-sm text-on-surface-variant font-medium">Saldos y movimientos agrupados por entidad financiera o cliente.</p>
        </div>
        <div class="relative z-10 hidden md:block">
            <div class="w-20 h-20 bg-indigo-50 rounded-3xl flex items-center justify-center text-indigo-600 shadow-inner">
                <span class="material-symbols-outlined text-[48px] fill-1">account_balance</span>
            </div>
        </div>
        <!-- Decorative bg -->
        <div class="absolute right-0 top-0 h-full w-1/3 bg-indigo-50/30 -skew-x-12 translate-x-1/2"></div>
    </div>

    <!-- Accounts Grid (Clickable cards to trigger modal) -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <?php $__empty_1 = true; $__currentLoopData = $accounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="bg-white border border-outline rounded-[2.5rem] p-10 shadow-premium hover-lift group cursor-pointer transition-all hover:border-primary/30"
             @click="activeAccountName = '<?php echo e(addslashes($account->associated_to)); ?>'; 
                     activeAccountBalance = <?php echo e($account->balance); ?>; 
                     activeAccountMovements = <?php echo e(json_encode($movementsGrouped[$account->associated_to] ?? [])); ?>;
                     modalOpen = true; 
                     $nextTick(() => { buildAccountChart(activeAccountMovements) });">
            <div class="flex flex-col gap-8">
                <div class="flex justify-between items-start">
                    <div class="w-14 h-14 bg-surface-variant rounded-2xl flex items-center justify-center group-hover:bg-primary/10 group-hover:text-primary transition-all">
                        <span class="material-symbols-outlined text-3xl">domain</span>
                    </div>
                    <span class="px-4 py-1 bg-emerald-50 text-primary rounded-full text-[10px] font-black uppercase tracking-widest">Activa</span>
                </div>
                
                <div class="flex flex-col">
                    <h3 class="text-xl font-black text-secondary uppercase tracking-tight truncate w-full"><?php echo e($account->associated_to); ?></h3>
                    <span class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest mt-1">Saldo Consolidado</span>
                </div>

                <div class="pt-6 border-t border-outline flex items-end justify-between">
                    <span class="text-3xl font-black <?php echo e($account->balance >= 0 ? 'text-primary' : 'text-red-600'); ?>">
                        $<?php echo e(number_format($account->balance, 2)); ?>

                    </span>
                    <button class="w-10 h-10 rounded-xl bg-surface-variant flex items-center justify-center text-secondary group-hover:bg-primary group-hover:text-white transition-all cursor-pointer">
                        <span class="material-symbols-outlined">visibility</span>
                    </button>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-span-3 py-20 flex flex-col items-center gap-6 opacity-30">
            <span class="material-symbols-outlined text-[100px]">account_balance_wallet</span>
            <h4 class="text-xl font-black uppercase tracking-widest">No hay cuentas registradas</h4>
            <p class="text-sm font-medium text-center max-w-xs">Los movimientos que asocies a una entidad aparecerán aquí automáticamente.</p>
        </div>
        <?php endif; ?>
    </div>

    <!-- Info Banner -->
    <div class="bg-secondary rounded-[2.5rem] p-6 md:p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl shadow-secondary/20">
        <div class="flex flex-col gap-3">
            <h2 class="text-2xl font-black">¿Necesitas añadir una nueva cuenta?</h2>
            <p class="text-white/60 font-medium">Solo tienes que registrar un movimiento y escribir el nombre de la nueva entidad en el campo "Asociado a".</p>
        </div>
        <a href="<?php echo e(route('movements.index')); ?>" class="px-10 py-4 bg-primary text-white rounded-2xl font-black text-sm hover:scale-[1.05] transition-all shadow-xl shadow-primary/20">
            Ir a Movimientos
        </a>
    </div>

    <!-- FULL-SCREEN DETAIL MODAL (AlpineJS) -->
    <div x-show="modalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 bg-white flex flex-col p-6 md:p-10 overflow-y-auto"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-4">
         
        <!-- Modal Top Bar -->
        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-6 border-b border-outline pb-6 mb-8">
            <div class="flex items-center gap-4">
                <button @click="modalOpen = false" class="w-12 h-12 rounded-2xl hover:bg-surface-variant flex items-center justify-center text-secondary transition-all cursor-pointer shrink-0">
                    <span class="material-symbols-outlined">arrow_back</span>
                </button>
                <div class="flex flex-col min-w-0">
                    <h2 class="text-xl md:text-3xl font-black text-secondary uppercase tracking-tight truncate" x-text="activeAccountName"></h2>
                    <span class="text-[10px] md:text-[11px] font-bold text-on-surface-variant uppercase tracking-widest mt-0.5">Expediente Completo de Cuenta</span>
                </div>
            </div>
            
            <div class="flex items-center justify-between sm:justify-end gap-3 w-full sm:w-auto border-t sm:border-t-0 pt-4 sm:pt-0 border-outline">
                <!-- Export Account Data button -->
                <button @click="exportAccountCSV()" class="h-12 px-6 bg-emerald-50 text-primary border border-emerald-100 rounded-2xl font-bold hover:bg-primary hover:text-white transition-all flex items-center justify-center gap-2 cursor-pointer flex-1 sm:flex-none">
                    <span class="material-symbols-outlined text-[20px]">download</span>
                    Exportar Datos
                </button>
                <button @click="modalOpen = false" class="w-12 h-12 rounded-2xl bg-surface-variant hover:bg-red-50 hover:text-red-500 flex items-center justify-center text-on-surface-variant transition-all cursor-pointer shrink-0">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
        </div>

        <!-- Modal Responsive Core Layout -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 flex-1">
            <!-- Left Side: Table List of Transactions (2/3 width) -->
            <div class="lg:col-span-2 flex flex-col gap-6">
                <div class="bg-white border border-outline rounded-[2rem] shadow-sm overflow-hidden flex flex-col">
                    <div class="p-6 border-b border-outline bg-gray-50/20 flex justify-between items-center">
                        <h4 class="text-lg font-bold text-secondary">Historial de Transacciones</h4>
                        <span class="text-xs text-on-surface-variant font-medium" x-text="`${activeAccountMovements.length} registros cargados`"></span>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left min-w-[600px]">
                            <thead>
                                <tr class="bg-[#f1f5f9]/50">
                                    <th class="px-6 py-4 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Fecha</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Detalle / Concepto</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Registrado por</th>
                                    <th class="px-6 py-4 text-[10px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline text-right">Monto</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-outline">
                                <template x-for="m in activeAccountMovements" :key="m.id">
                                    <tr class="hover:bg-surface transition-all">
                                        <td class="px-6 py-4 text-xs font-bold text-on-surface-variant" x-text="m.date ? new Date(m.date).toLocaleDateString('es-ES', {day: '2-digit', month: 'short', year: 'numeric'}) : 'N/A'"></td>
                                        <td class="px-6 py-4">
                                            <div class="flex flex-col gap-0.5">
                                                <span class="text-xs font-black text-secondary" x-text="m.description"></span>
                                                <span class="text-[9px] font-bold uppercase tracking-wide" :class="m.type === 'ingreso' ? 'text-primary' : 'text-red-500'" x-text="m.type"></span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-xs font-semibold text-on-surface-variant" x-text="m.user ? m.user.name : 'Sistema'"></td>
                                        <td class="px-6 py-4 text-xs font-black text-right" :class="m.type === 'ingreso' ? 'text-primary' : 'text-red-600'" x-text="(m.type === 'ingreso' ? '+' : '-') + '$' + parseFloat(m.amount).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})"></td>
                                    </tr>
                                </template>
                                <template x-if="activeAccountMovements.length === 0">
                                    <tr>
                                        <td colspan="4" class="text-center py-10 text-xs font-bold text-on-surface-variant opacity-60">No hay transacciones registradas para esta cuenta.</td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Side: Account Balance Card & Donut Chart (1/3 width) -->
            <div class="lg:col-span-1 flex flex-col gap-8">
                <!-- Dynamic Balance Card -->
                <div class="p-8 rounded-[2rem] border text-white flex flex-col gap-4 shadow-xl shadow-secondary/5"
                     :class="activeAccountBalance >= 0 ? 'bg-gradient-to-br from-primary to-[#004d29] border-primary/20' : 'bg-gradient-to-br from-red-700 to-red-950 border-red-800'">
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] opacity-80">Saldo Consolidado</span>
                    <h3 class="text-4xl font-black tracking-tighter" x-text="'$' + parseFloat(activeAccountBalance).toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2})"></h3>
                    <div class="flex items-center gap-2 mt-2">
                        <span class="material-symbols-outlined text-[18px]">verified</span>
                        <span class="text-xs font-bold" x-text="activeAccountBalance >= 0 ? 'Cuenta con Saldo Favorable' : 'Cuenta en Sobregiro'"></span>
                    </div>
                </div>

                <!-- Donut Chart Segment -->
                <div class="bg-white border border-outline rounded-[2rem] p-8 flex flex-col gap-6 shadow-premium">
                    <h4 class="text-sm font-black text-secondary uppercase tracking-widest border-b border-outline pb-4">Composición Financiera</h4>
                    
                    <div class="relative w-full h-[220px]">
                        <canvas id="accountDetailChart"></canvas>
                    </div>
                    
                    <div class="flex justify-around items-center pt-2 border-t border-outline text-center">
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black uppercase text-primary tracking-wide">Total Ingresos</span>
                            <span class="text-sm font-black text-secondary" x-text="'$' + parseFloat(activeAccountMovements.filter(m => m.type === 'ingreso').reduce((a, b) => a + parseFloat(b.amount), 0)).toLocaleString(undefined, {maximumFractionDigits: 0})"></span>
                        </div>
                        <div class="flex flex-col">
                            <span class="text-[9px] font-black uppercase text-red-500 tracking-wide">Total Egresos</span>
                            <span class="text-sm font-black text-secondary" x-text="'$' + parseFloat(activeAccountMovements.filter(m => m.type === 'egreso').reduce((a, b) => a + parseFloat(b.amount), 0)).toLocaleString(undefined, {maximumFractionDigits: 0})"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let accountChart = null;

    function buildAccountChart(movements) {
        
        let incomes = 0;
        let expenses = 0;
        
        movements.forEach(m => {
            if (m.type === 'ingreso') {
                incomes += parseFloat(m.amount);
            } else {
                expenses += parseFloat(m.amount);
            }
        });

        const ctx = document.getElementById('accountDetailChart').getContext('2d');
        
        if (accountChart) {
            accountChart.destroy();
        }
        
        // Si no hay datos, inicializamos con valores vacíos para que no crasheé
        const chartData = (incomes === 0 && expenses === 0) ? [1, 1] : [incomes, expenses];
        const chartLabels = (incomes === 0 && expenses === 0) ? ['Sin Registros', 'Sin Registros'] : ['Ingresos', 'Egresos'];

        accountChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: chartLabels,
                datasets: [{
                    data: chartData,
                    backgroundColor: ['#006837', '#ef4444'],
                    hoverOffset: 4,
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            font: {
                                family: 'Inter',
                                weight: 'bold',
                                size: 10
                            }
                        }
                    }
                },
                cutout: '65%'
            }
        });
    }

    function exportAccountCSV() {
        const modalScope = document.querySelector('[x-data]');
        const name = modalScope.__x.$data.activeAccountName;
        const movements = modalScope.__x.$data.activeAccountMovements;
        
        if (movements.length === 0) return alert('No hay movimientos que exportar.');

        let csvContent = "data:text/csv;charset=utf-8,";
        csvContent += "Fecha,Tipo,Descripcion,Registrado Por,Monto\n";

        movements.forEach(m => {
            const formattedDate = new Date(m.date).toLocaleDateString('es-ES');
            const row = `"${formattedDate}","${m.type}","${m.description.replace(/"/g, '""')}","${m.user ? m.user.name : 'Sistema'}","${m.amount}"`;
            csvContent += row + "\n";
        });

        const encodedUri = encodeURI(csvContent);
        const link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", `reporte_cuenta_${name.toLowerCase().replace(/\s+/g, '_')}.csv`);
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mariapazpelaezrestrepo/Documents/Proyectos Desarrollapp/conduser/resources/views/accounts/index.blade.php ENDPATH**/ ?>