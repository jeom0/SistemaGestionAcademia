@extends('layouts.app')

@section('title', 'Dashboard Administrador')

@section('content')
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-outline shadow-sm relative overflow-hidden">
        <div class="relative z-10 flex flex-col gap-2">
            <h1 class="text-2xl md:text-4xl font-black text-secondary tracking-tight">Panel de Administración</h1>
            <p class="text-xs md:text-sm text-on-surface-variant font-medium">Gestión contable y financiera de la flota.</p>
        </div>
        <div class="flex flex-wrap gap-3 relative z-10 w-full md:w-auto">
            <button class="h-12 px-6 bg-white border border-outline text-secondary rounded-2xl font-bold hover:bg-surface-variant transition-all flex items-center justify-center gap-2 flex-1 sm:flex-none">
                <span class="material-symbols-outlined text-[20px]">download</span>
                Exportar Reporte
            </button>
            <a href="{{ route('movements.create') }}" class="h-12 px-6 bg-primary text-white rounded-2xl font-bold flex items-center justify-center gap-2 hover:shadow-lg transition-all active:scale-[0.98] flex-1 sm:flex-none">
                <span class="material-symbols-outlined text-[20px] fill-1">add</span>
                Nuevo Registro
            </a>
        </div>
        <!-- Decorative bg -->
        <div class="absolute right-0 top-0 h-full w-1/3 bg-primary/5 -skew-x-12 translate-x-1/2"></div>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
        <div class="p-8 bg-gradient-to-br from-secondary to-[#0f172a] border border-secondary/20 rounded-[2.5rem] shadow-2xl shadow-secondary/20 hover-lift group text-white">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-white/20 text-white flex items-center justify-center group-hover:scale-110 transition-all backdrop-blur-md">
                    <span class="material-symbols-outlined text-[28px]">account_balance_wallet</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] opacity-80">Balance Global</span>
                    @php
                        $balance = \App\Models\Movement::where('user_id', auth()->id())->where('type', 'ingreso')->sum('amount') - \App\Models\Movement::where('user_id', auth()->id())->where('type', 'egreso')->sum('amount');
                    @endphp
                    <span class="text-4xl font-black mt-2 tracking-tighter">${{ number_format($balance, 0) }}</span>
                </div>
            </div>
        </div>

        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-amber-600 group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">pending_actions</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Movimientos Pendientes</span>
                    <span class="text-4xl font-black text-secondary mt-2 tracking-tighter">{{ \App\Models\Movement::where('user_id', auth()->id())->where('status', 'pendiente')->count() }}</span>
                </div>
            </div>
        </div>

        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-emerald-50 text-primary flex items-center justify-center group-hover:scale-110 group-hover:bg-primary group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">trending_up</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Total Ingresos</span>
                    <span class="text-4xl font-black text-primary mt-2 tracking-tighter">${{ number_format(\App\Models\Movement::where('user_id', auth()->id())->where('type', 'ingreso')->sum('amount'), 0) }}</span>
                </div>
            </div>
        </div>

        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">trending_down</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Total Egresos</span>
                    <span class="text-4xl font-black text-blue-600 mt-2 tracking-tighter">${{ number_format(\App\Models\Movement::where('user_id', auth()->id())->where('type', 'egreso')->sum('amount'), 0) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Analytics Card (Togleable Pie, Line, Bar) -->
    <div class="bg-white border border-outline rounded-[2.5rem] shadow-premium p-8 md:p-10 flex flex-col gap-6 hover-lift">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
            <div>
                <h3 class="text-xl font-bold text-secondary">Rendimiento Operativo de la Academia</h3>
                <p class="text-xs text-on-surface-variant font-medium mt-1">Análisis consolidado de ingresos de cursos y gastos de flota.</p>
            </div>
            <!-- Selector de Tipo de Gráfico -->
            <div class="flex items-center gap-2 bg-surface-variant/30 p-1.5 rounded-2xl border border-outline">
                <button onclick="changeChartType('bar')" id="btn-chart-bar" class="px-4 py-2 text-xs font-black uppercase tracking-wider rounded-xl bg-white text-primary shadow-sm transition-all cursor-pointer">Barras</button>
                <button onclick="changeChartType('line')" id="btn-chart-line" class="px-4 py-2 text-xs font-black uppercase tracking-wider rounded-xl text-on-surface-variant hover:text-secondary transition-all cursor-pointer">Líneas</button>
                <button onclick="changeChartType('pie')" id="btn-chart-pie" class="px-4 py-2 text-xs font-black uppercase tracking-wider rounded-xl text-on-surface-variant hover:text-secondary transition-all cursor-pointer">Pastel</button>
            </div>
        </div>
        
        <div class="relative w-full h-[320px] md:h-[380px]">
            <canvas id="dashboardChart"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Register Form Column -->
        <div class="lg:col-span-2 flex flex-col gap-8">
            <div class="bg-white border border-outline rounded-[2.5rem] shadow-sm overflow-hidden">
                <div class="p-8 border-b border-outline bg-gray-50/30">
                    <h3 class="text-xl font-bold text-secondary">Registrar Nuevo Movimiento</h3>
                </div>
                <div class="p-10">
                    <form action="{{ route('movements.store') }}" method="POST" class="flex flex-col gap-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Tipo de Operación</label>
                                <select name="type" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none" required>
                                    <option value="">Selecciona tipo...</option>
                                    <option value="ingreso">Ingreso (+)</option>
                                    <option value="egreso">Egreso (-)</option>
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Monto ($)</label>
                                <input type="number" step="0.01" name="amount" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-bold" placeholder="0.00" required/>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Fecha</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" required/>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Asociado a</label>
                                <input type="text" name="associated_to" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="Cliente o Entidad"/>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Descripción del Movimiento</label>
                            <textarea name="description" rows="3" class="w-full p-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium resize-none" placeholder="Detalles del registro..." required></textarea>
                        </div>

                        <button type="submit" class="w-full h-14 bg-secondary text-white rounded-2xl font-bold shadow-xl shadow-secondary/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-3">
                            <span class="material-symbols-outlined">save</span>
                            Guardar Movimiento
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Recent Activity & Info -->
        <div class="flex flex-col gap-8">
            <div class="bg-white border border-outline rounded-[2.5rem] shadow-sm overflow-hidden flex flex-col hover-lift">
                <div class="p-8 border-b border-outline bg-gray-50/30">
                    <h3 class="text-xl font-bold text-secondary">Última Actividad</h3>
                </div>
                <div class="p-8">
                    <div class="flex flex-col gap-8">
                        @php
                            $recent = \App\Models\Movement::where('user_id', auth()->id())->orderBy('created_at', 'desc')->take(5)->get();
                        @endphp
                        @foreach($recent as $m)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl {{ $m->type === 'ingreso' ? 'bg-emerald-50 text-primary' : 'bg-blue-50 text-blue-600' }} flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[20px]">{{ $m->type === 'ingreso' ? 'add' : 'remove' }}</span>
                                    </div>
                                    <div class="flex flex-col overflow-hidden">
                                        <span class="text-sm font-bold text-secondary truncate w-40">{{ $m->description }}</span>
                                        <span class="text-[10px] text-on-surface-variant font-black uppercase tracking-widest">{{ $m->date->format('d M, Y') }}</span>
                                    </div>
                                </div>
                                <span class="text-sm font-black {{ $m->type === 'ingreso' ? 'text-primary' : 'text-blue-600' }}">
                                    {{ $m->type === 'ingreso' ? '+' : '-' }}${{ number_format($m->amount, 0) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{ route('movements.index') }}" class="mt-10 w-full h-12 border border-outline rounded-2xl flex items-center justify-center text-xs font-black text-on-surface-variant uppercase tracking-widest hover:bg-surface-variant transition-all">
                        Ver todo el historial
                    </a>
                </div>
            </div>

            <div class="p-8 bg-primary rounded-[2.5rem] text-white shadow-2xl shadow-primary/20 relative overflow-hidden group">
                <div class="relative z-10 flex flex-col gap-6">
                    <div class="w-14 h-14 bg-white/20 rounded-2xl flex items-center justify-center backdrop-blur-md">
                        <span class="material-symbols-outlined text-3xl">help_center</span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <h4 class="text-xl font-bold">¿Necesitas ayuda?</h4>
                        <p class="text-sm text-white/70 leading-relaxed font-medium">Consulte nuestra guía de gestión financiera o contacte con soporte.</p>
                    </div>
                    <a href="https://wa.me/573000000000" target="_blank" class="h-11 w-full bg-white text-primary rounded-xl text-xs font-black uppercase tracking-widest hover:bg-opacity-90 transition-all shadow-lg flex items-center justify-center">
                        Ir al Centro de Ayuda
                    </a>
                </div>
                <span class="absolute -right-6 -bottom-6 material-symbols-outlined text-[140px] text-white/5 rotate-12 group-hover:scale-110 transition-transform">contact_support</span>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    let currentChart = null;
    
    // Calcular datos reales de la base de datos
    @php
        $cursoB1 = \App\Models\Movement::where('user_id', auth()->id())->where('description', 'like', '%B1%')->sum('amount');
        $cursoA2 = \App\Models\Movement::where('user_id', auth()->id())->where('description', 'like', '%A2%')->sum('amount');
        $cursoC2 = \App\Models\Movement::where('user_id', auth()->id())->where('description', 'like', '%C2%')->sum('amount');
        $examenes = \App\Models\Movement::where('user_id', auth()->id())->where(function($q){ $q->where('description', 'like', '%Examen%')->orWhere('description', 'like', '%Renovación%')->orWhere('description', 'like', '%Trámite%'); })->sum('amount');
        $mantenimiento = \App\Models\Movement::where('user_id', auth()->id())->where(function($q){ $q->where('description', 'like', '%Mantenimiento%')->orWhere('description', 'like', '%Reparación%')->orWhere('description', 'like', '%SOAT%'); })->sum('amount');
        $nomina = \App\Models\Movement::where('user_id', auth()->id())->where(function($q){ $q->where('description', 'like', '%Nómina%')->orWhere('description', 'like', '%Energía%')->orWhere('description', 'like', '%Internet%')->orWhere('description', 'like', '%Oficina%'); })->sum('amount');
        $gasolina = \App\Models\Movement::where('user_id', auth()->id())->where('description', 'like', '%Gasolina%')->sum('amount');
    @endphp

    const categories = ['Cursos B1', 'Cursos A2', 'Cursos C2', 'Exámenes CRC', 'Mantenimiento', 'Nómina & Serv', 'Gasolina'];
    const dataValues = [
        {{ $cursoB1 }},
        {{ $cursoA2 }},
        {{ $cursoC2 }},
        {{ $examenes }},
        {{ $mantenimiento }},
        {{ $nomina }},
        {{ $gasolina }}
    ];
    
    const colors = [
        '#006837', // Verde esmeralda
        '#10b981', // Verde claro
        '#f59e0b', // Amarillo oro
        '#6366f1', // Indigo
        '#ef4444', // Rojo
        '#3b82f6', // Azul
        '#6b7280'  // Gris
    ];

    function buildChart(type) {
        const ctx = document.getElementById('dashboardChart').getContext('2d');
        
        if (currentChart) {
            currentChart.destroy();
        }
        
        let config = {
            type: type,
            data: {
                labels: categories,
                datasets: [{
                    label: 'Flujo Contable ($ COP)',
                    data: dataValues,
                    backgroundColor: type === 'pie' ? colors : colors.map(c => c + '22'),
                    borderColor: colors,
                    borderWidth: 2,
                    fill: type === 'line',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: type === 'pie',
                        position: 'right',
                        labels: {
                            font: {
                                family: 'Inter',
                                weight: 'bold',
                                size: 10
                            }
                        }
                    }
                }
            }
        };
        
        if (type !== 'pie') {
            config.options.scales = {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9'
                    },
                    ticks: {
                        callback: function(value) {
                            return '$' + value.toLocaleString();
                        },
                        font: {
                            family: 'Inter',
                            size: 10
                        }
                    }
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            family: 'Inter',
                            size: 10,
                            weight: 'bold'
                        }
                    }
                }
            };
        }
        
        currentChart = new Chart(ctx, config);
    }
    
    function changeChartType(type) {
        ['bar', 'line', 'pie'].forEach(t => {
            const btn = document.getElementById('btn-chart-' + t);
            if (t === type) {
                btn.classList.add('bg-white', 'text-primary', 'shadow-sm');
                btn.classList.remove('text-on-surface-variant', 'hover:text-secondary');
            } else {
                btn.classList.remove('bg-white', 'text-primary', 'shadow-sm');
                btn.classList.add('text-on-surface-variant', 'hover:text-secondary');
            }
        });
        
        buildChart(type);
    }
    
    document.addEventListener('DOMContentLoaded', () => {
        buildChart('bar');
    });
</script>
@endpush
@endsection
