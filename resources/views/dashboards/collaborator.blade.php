@extends('layouts.app')

@section('title', 'Mis Gastos')

@section('content')
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 bg-white p-6 md:p-10 rounded-[2rem] md:rounded-[2.5rem] border border-outline shadow-sm relative overflow-hidden">
        <div class="relative z-10 flex flex-col gap-2">
            <h1 class="text-2xl md:text-4xl font-black text-secondary tracking-tight">Mis Gastos</h1>
            <p class="text-xs md:text-sm text-on-surface-variant font-medium">Registro y control personal de egresos en la plataforma.</p>
        </div>
        <div class="flex flex-wrap gap-3 relative z-10 w-full md:w-auto">
            <a href="{{ route('movements.index') }}" class="h-12 px-6 bg-white border border-outline text-secondary rounded-2xl font-bold hover:bg-surface-variant transition-all flex items-center justify-center gap-2 flex-1 sm:flex-none">
                <span class="material-symbols-outlined text-[20px]">history</span>
                Historial
            </a>
            <button onclick="document.getElementById('amount').focus()" class="h-12 px-6 bg-primary text-white rounded-2xl font-bold flex items-center justify-center gap-2 hover:shadow-lg transition-all active:scale-[0.98] flex-1 sm:flex-none">
                <span class="material-symbols-outlined text-[20px] fill-1">add</span>
                Nuevo Egreso
            </button>
        </div>
        <!-- Decorative bg -->
        <div class="absolute right-0 top-0 h-full w-1/3 bg-blue-50/50 -skew-x-12 translate-x-1/2"></div>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-amber-600 group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">pending_actions</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Mis Pendientes</span>
                    <span class="text-4xl font-black text-secondary mt-2 tracking-tighter">{{ auth()->user()->movements()->where('status', 'pendiente')->count() }}</span>
                </div>
            </div>
        </div>

        <div class="p-8 bg-white border border-outline rounded-[2.5rem] shadow-premium hover-lift group">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 group-hover:bg-blue-600 group-hover:text-white transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">trending_down</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Total Gastado</span>
                    <span class="text-4xl font-black text-blue-600 mt-2 tracking-tighter">${{ number_format(auth()->user()->movements()->where('type', 'egreso')->sum('amount'), 0) }}</span>
                </div>
            </div>
        </div>

        <div class="p-8 bg-gradient-to-br from-amber-500 to-amber-600 border border-amber-400/20 rounded-[2.5rem] shadow-2xl shadow-amber-500/20 hover-lift group text-white">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-white/20 text-white flex items-center justify-center group-hover:scale-110 transition-all backdrop-blur-md">
                    <span class="material-symbols-outlined text-[28px]">calendar_today</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black uppercase tracking-[0.2em] opacity-80">Gastos Hoy</span>
                    <span class="text-4xl font-black mt-2 tracking-tighter">${{ number_format(auth()->user()->movements()->whereDate('date', today())->sum('amount'), 0) }}</span>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Register Form Column -->
        <div class="lg:col-span-2 flex flex-col gap-8">
            <div class="bg-white border border-outline rounded-[2.5rem] shadow-sm overflow-hidden">
                <div class="p-8 border-b border-outline bg-gray-50/30">
                    <h3 class="text-xl font-bold text-secondary">Registrar Nuevo Egreso</h3>
                </div>
                <div class="p-10">
                    <form action="{{ route('movements.store') }}" method="POST" class="flex flex-col gap-8">
                        @csrf
                        <input type="hidden" name="type" value="egreso">
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Monto del Gasto ($)</label>
                                <input type="number" step="0.01" name="amount" id="amount" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-bold" placeholder="0.00" required/>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Fecha del Gasto</label>
                                <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" required/>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Asociado a</label>
                                <input type="text" name="associated_to" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="Proveedor o Concepto"/>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Categoría</label>
                                <select name="category" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none">
                                    <option value="">Selecciona categoría...</option>
                                    <option value="suministros">Suministros</option>
                                    <option value="servicios">Servicios</option>
                                    <option value="transporte">Transporte</option>
                                    <option value="comida">Comida</option>
                                    <option value="otros">Otros</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex flex-col gap-2">
                            <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Descripción Detallada</label>
                            <textarea name="description" rows="3" class="w-full p-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium resize-none" placeholder="¿En qué se gastó este dinero?" required></textarea>
                        </div>

                        <button type="submit" class="w-full h-14 bg-secondary text-white rounded-2xl font-bold shadow-xl shadow-secondary/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-3">
                            <span class="material-symbols-outlined">save</span>
                            Guardar Egreso
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Right Column: Recent Activity & Tips -->
        <div class="flex flex-col gap-8">
            <div class="bg-white border border-outline rounded-[2.5rem] shadow-sm overflow-hidden flex flex-col">
                <div class="p-8 border-b border-outline bg-gray-50/30">
                    <h3 class="text-xl font-bold text-secondary">Mis Últimos Gastos</h3>
                </div>
                <div class="p-8">
                    <div class="flex flex-col gap-8">
                        @php
                            $recent = auth()->user()->movements()->orderBy('created_at', 'desc')->take(5)->get();
                        @endphp
                        @foreach($recent as $m)
                            <div class="flex items-center justify-between group">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center shrink-0">
                                        <span class="material-symbols-outlined text-[20px]">remove</span>
                                    </div>
                                    <div class="flex flex-col overflow-hidden">
                                        <span class="text-sm font-bold text-secondary truncate w-40">{{ $m->description }}</span>
                                        <span class="text-[10px] text-on-surface-variant font-black uppercase tracking-widest">{{ $m->date->format('d M, Y') }}</span>
                                    </div>
                                </div>
                                <span class="text-sm font-black text-blue-600">
                                    -${{ number_format($m->amount, 0) }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="p-8 bg-surface-variant border border-outline rounded-[2.5rem] flex flex-col gap-6">
                <div class="flex items-center gap-3 text-primary">
                    <span class="material-symbols-outlined text-2xl">info</span>
                    <h4 class="text-sm font-black uppercase tracking-widest">Recordatorio</h4>
                </div>
                <p class="text-sm text-on-surface-variant font-medium leading-relaxed">
                    "Como colaborador, solo puede registrar egresos. Si requiere corregir un ingreso o eliminar un registro antiguo, comuníquese con su administrador."
                </p>
                <div class="mt-2 flex justify-center">
                    <span class="text-[10px] font-black text-on-surface-variant/40 uppercase tracking-[0.3em]">Conduser Security Core</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
