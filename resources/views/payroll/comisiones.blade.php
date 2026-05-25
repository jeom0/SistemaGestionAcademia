@extends('layouts.app')

@section('title', 'Comisiones de Empleados')

@section('content')
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto">
    <!-- Header -->
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6 bg-white p-6 md:p-10 rounded-[2.5rem] border border-outline shadow-sm relative overflow-hidden">
        <div class="relative z-10 flex flex-col gap-2">
            <h1 class="text-2xl md:text-4xl font-black text-secondary tracking-tight">Comisiones</h1>
            <p class="text-xs md:text-sm text-on-surface-variant font-medium">Gestión y visualización de comisiones y bonos de empleados.</p>
        </div>
        <div class="flex flex-wrap gap-3 relative z-10 w-full md:w-auto">
            <a href="{{ route('movements.create') }}" class="h-12 px-6 bg-primary text-white rounded-2xl font-bold flex items-center justify-center gap-2 hover:shadow-lg transition-all active:scale-[0.98] flex-1 sm:flex-none">
                <span class="material-symbols-outlined text-[20px] fill-1">add</span>
                Registrar Comisión
            </a>
        </div>
        <div class="absolute right-0 top-0 h-full w-1/3 bg-primary/5 -skew-x-12 translate-x-1/2"></div>
    </div>

    <!-- Summary Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <div class="p-8 bg-gradient-to-br from-emerald-50 to-emerald-100/50 border border-emerald-100 rounded-[2.5rem] shadow-sm hover-lift group">
            <div class="flex flex-col gap-6">
                <div class="w-14 h-14 rounded-2xl bg-emerald-600 text-white flex items-center justify-center group-hover:scale-110 transition-all shadow-sm">
                    <span class="material-symbols-outlined text-[28px]">payments</span>
                </div>
                <div class="flex flex-col">
                    <span class="text-[11px] font-black text-emerald-800 uppercase tracking-[0.2em] opacity-80">Total Comisiones (Mes)</span>
                    <span class="text-4xl font-black text-emerald-900 mt-2 tracking-tighter">${{ number_format($comisiones->sum('amount'), 0) }}</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
        <div class="p-8 border-b border-outline flex justify-between items-center bg-gray-50/50">
            <h3 class="text-xl font-bold text-secondary">Historial de Comisiones</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-surface-variant/30 text-secondary text-xs uppercase tracking-widest">
                        <th class="px-8 py-5 font-black rounded-tl-2xl">Fecha</th>
                        <th class="px-8 py-5 font-black">Descripción</th>
                        <th class="px-8 py-5 font-black">Usuario</th>
                        <th class="px-8 py-5 font-black text-right rounded-tr-2xl">Monto</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    @forelse($comisiones as $comision)
                    <tr class="hover:bg-surface transition-all">
                        <td class="px-8 py-5 text-xs font-bold text-on-surface-variant">
                            {{ $comision->date->format('d M, Y') }}
                        </td>
                        <td class="px-8 py-5">
                            <span class="text-sm font-black text-secondary">{{ $comision->description }}</span>
                        </td>
                        <td class="px-8 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-primary/10 text-primary flex items-center justify-center font-bold text-xs">
                                    {{ substr($comision->user->name, 0, 1) }}
                                </div>
                                <span class="text-xs font-bold text-secondary">{{ $comision->user->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-5 text-right font-black text-primary">
                            ${{ number_format($comision->amount, 0) }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-16 text-center">
                            <div class="flex flex-col items-center justify-center gap-4 text-on-surface-variant opacity-60">
                                <span class="material-symbols-outlined text-6xl">payments</span>
                                <p class="text-sm font-bold">No hay registros de comisiones aún.</p>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="p-6 border-t border-outline">
            {{ $comisiones->links() }}
        </div>
    </div>
</div>
@endsection
