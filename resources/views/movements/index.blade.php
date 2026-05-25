@extends('layouts.app')

@section('title', 'Movimientos')

@section('content')
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto" x-data="{ showModal: false }">
    <!-- Header Area -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div class="flex flex-col gap-1">
            <h1 class="text-3xl md:text-4xl font-black text-secondary tracking-tight">
                {{ request()->query('status') === 'pendiente' ? 'Movimientos Pendientes' : 'Historial de Movimientos' }}
            </h1>
            <p class="text-xs md:text-sm text-on-surface-variant font-medium">
                {{ request()->query('status') === 'pendiente' ? 'Gestione los registros que aún requieren atención.' : 'Listado completo de todas las transacciones del sistema.' }}
            </p>
        </div>
        <button @click="showModal = true" class="h-12 px-6 bg-primary text-white rounded-2xl font-bold flex items-center justify-center gap-2 hover:shadow-lg hover:shadow-primary/20 transition-all active:scale-[0.98] shrink-0">
            <span class="material-symbols-outlined text-[20px] fill-1">add</span>
            Nuevo Movimiento
        </button>
    </div>

    @if(!request()->filled('status'))
    @php
        $totalIngresos = $movements->where('type', 'ingreso')->where('status', 'completado')->sum('amount');
        $totalEgresos = $movements->where('type', 'egreso')->where('status', 'completado')->sum('amount');
        $balance = $totalIngresos - $totalEgresos;
    @endphp
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Ingresos -->
        <div class="bg-white rounded-[2rem] border border-outline p-6 flex items-center gap-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-2xl bg-emerald-50 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[28px] text-primary">trending_up</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Total Ingresos</span>
                <span class="text-2xl font-black text-secondary">${{ number_format($totalIngresos, 0) }}</span>
            </div>
        </div>

        <!-- Egresos -->
        <div class="bg-white rounded-[2rem] border border-outline p-6 flex items-center gap-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-2xl bg-red-50 flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[28px] text-red-600">trending_down</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Total Egresos</span>
                <span class="text-2xl font-black text-secondary">${{ number_format($totalEgresos, 0) }}</span>
            </div>
        </div>

        <!-- Balance -->
        <div class="bg-white rounded-[2rem] border border-outline p-6 flex items-center gap-6 shadow-sm hover:shadow-md transition-shadow">
            <div class="w-14 h-14 rounded-2xl {{ $balance >= 0 ? 'bg-blue-50' : 'bg-amber-50' }} flex items-center justify-center shrink-0">
                <span class="material-symbols-outlined text-[28px] {{ $balance >= 0 ? 'text-blue-600' : 'text-amber-600' }}">account_balance</span>
            </div>
            <div class="flex flex-col">
                <span class="text-xs font-bold text-on-surface-variant uppercase tracking-widest">Balance Neto</span>
                <span class="text-2xl font-black text-secondary">${{ number_format($balance, 0) }}</span>
            </div>
        </div>
    </div>
    @endif

    <!-- Recent Movements Table -->
    <div class="bg-white border border-outline rounded-[2rem] shadow-sm overflow-hidden">
        <div class="p-6 md:p-8 border-b border-outline flex justify-between items-center bg-gray-50/30">
            <h3 class="text-lg md:text-xl font-bold text-secondary">Movimientos Recientes</h3>
            <button class="w-10 h-10 rounded-xl hover:bg-surface-variant flex items-center justify-center text-on-surface-variant transition-all cursor-pointer">
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
                    @forelse($movements as $m)
                        <tr class="hover:bg-primary/[0.02] transition-all group/row">
                            <td class="px-8 py-6">
                                <div class="flex flex-col">
                                    <span class="text-sm font-bold text-secondary">{{ $m->date->format('d M') }}</span>
                                    <span class="text-[10px] text-on-surface-variant font-medium">{{ $m->date->format('Y') }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-xl {{ $m->type === 'ingreso' ? 'bg-emerald-50 text-primary' : 'bg-red-50 text-red-600' }} flex items-center justify-center shrink-0 group-hover/row:scale-110 transition-transform shadow-sm">
                                        <span class="material-symbols-outlined text-[20px]">{{ $m->type === 'ingreso' ? 'trending_up' : 'trending_down' }}</span>
                                    </div>
                                    <span class="text-sm font-bold text-secondary truncate max-w-[200px]">{{ $m->description }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-3 py-1 bg-surface-variant/50 text-secondary text-[10px] font-black uppercase tracking-widest rounded-lg">
                                    {{ $m->associated_to ?? 'General' }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <span class="text-sm font-black {{ $m->type === 'ingreso' ? 'text-primary' : 'text-red-600' }}">
                                    {{ $m->type === 'ingreso' ? '+' : '-' }}${{ number_format($m->amount, 0) }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="badge {{ $m->status === 'completado' ? 'bg-success' : 'bg-amber' }}">
                                    {{ $m->status }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center justify-center gap-3">
                                    @if($m->status === 'pendiente')
                                        <form action="{{ route('movements.complete', $m) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="w-9 h-9 rounded-xl bg-emerald-50 text-primary hover:bg-primary hover:text-white transition-all flex items-center justify-center shadow-sm" title="Completar">
                                                <span class="material-symbols-outlined text-[18px]">check_circle</span>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="{{ route('movements.edit', $m) }}" class="w-9 h-9 rounded-xl bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all flex items-center justify-center shadow-sm" title="Editar">
                                        <span class="material-symbols-outlined text-[18px]">edit</span>
                                    </a>
                                    <form action="{{ route('movements.destroy', $m) }}" method="POST" onsubmit="return confirm('¿Estás seguro?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-9 h-9 rounded-xl bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all flex items-center justify-center shadow-sm" title="Eliminar">
                                            <span class="material-symbols-outlined text-[18px]">delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center gap-4">
                                    <span class="material-symbols-outlined text-5xl text-on-surface-variant/20">search_off</span>
                                    <p class="text-on-surface-variant font-medium">No se encontraron movimientos.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if($movements instanceof \Illuminate\Pagination\LengthAwarePaginator)
        <div class="p-8 border-t border-outline flex items-center justify-between bg-gray-50/30">
            <span class="text-xs font-bold text-on-surface-variant">Mostrando {{ $movements->firstItem() }}-{{ $movements->lastItem() }} de {{ $movements->total() }} movimientos</span>
            <div class="flex gap-2">
                {{ $movements->links() }}
            </div>
        </div>
        @endif
    </div>

    <!-- Modal for New Movement -->
    <div x-show="showModal" x-cloak class="fixed inset-0 z-[60] flex items-center justify-center p-4">
        <!-- Overlay -->
        <div x-show="showModal" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             @click="showModal = false"
             class="absolute inset-0 bg-secondary/60 backdrop-blur-sm"></div>

        <!-- Modal Content -->
        <div x-show="showModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8 scale-95"
             x-transition:enter-end="opacity-100 translate-y-0 scale-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 translate-y-0 scale-100"
             x-transition:leave-end="opacity-0 translate-y-8 scale-95"
             class="relative w-full max-w-2xl bg-white rounded-[2rem] shadow-2xl overflow-hidden flex flex-col max-h-[90vh]">
            
            <div class="p-6 md:p-8 border-b border-outline flex justify-between items-center sticky top-0 bg-white z-10">
                <h2 class="text-2xl font-black text-secondary">Registrar Movimiento</h2>
                <button @click="showModal = false" class="w-10 h-10 rounded-full hover:bg-surface-variant flex items-center justify-center text-on-surface-variant transition-all cursor-pointer">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <div class="p-6 md:p-8 overflow-y-auto custom-scrollbar">
                <form action="{{ route('movements.store') }}" method="POST" class="flex flex-col gap-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
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
                            <input type="date" name="date" value="{{ date('Y-m-d') }}" class="w-full h-14 px-4 rounded-2xl bg-surface-variant/50 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" required>
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
                        <div class="flex flex-col gap-2 md:col-span-2">
                            <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Asocia (Cuenta/Entidad)</label>
                            <select name="associated_to" class="w-full h-14 px-4 rounded-2xl bg-surface-variant/50 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none">
                                <option value="">General</option>
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

                    <div class="flex justify-end pt-4 gap-4 sticky bottom-0 bg-white">
                        <button type="button" @click="showModal = false" class="px-6 py-4 bg-surface-variant text-on-surface-variant rounded-2xl font-bold text-sm hover:bg-outline transition-all">
                            Cancelar
                        </button>
                        <button type="submit" class="px-8 py-4 bg-primary text-white rounded-2xl font-black text-sm hover:shadow-xl hover:shadow-primary/20 transition-all active:scale-[0.98]">
                            Guardar Movimiento
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
