@extends('layouts.app')

@section('title', 'Reportes Financieros')

@section('content')
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center bg-white p-10 rounded-[2.5rem] border border-outline shadow-premium relative overflow-hidden">
        <div class="relative z-10 flex flex-col gap-2">
            <h1 class="text-4xl font-black text-secondary tracking-tight">Reportes Financieros</h1>
            <p class="text-on-surface-variant font-medium">Análisis detallado de ingresos, egresos y balance del sistema.</p>
        </div>
        <div class="relative z-10 flex gap-4">
            <button class="h-12 px-6 bg-white border border-outline text-secondary rounded-2xl font-bold hover:bg-surface-variant transition-all flex items-center gap-2">
                <span class="material-symbols-outlined text-[20px]">print</span>
                Imprimir
            </button>
            <button class="h-12 px-6 bg-primary text-white rounded-2xl font-bold flex items-center gap-2 hover:shadow-lg transition-all active:scale-[0.98]">
                <span class="material-symbols-outlined text-[20px]">download</span>
                Descargar PDF
            </button>
        </div>
        <!-- Decorative bg -->
        <div class="absolute right-0 top-0 h-full w-1/3 bg-primary/5 -skew-x-12 translate-x-1/2"></div>
    </div>

    <!-- Analytics Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Summary Card -->
        <div class="lg:col-span-1 bg-white border border-outline rounded-[2.5rem] p-10 shadow-premium flex flex-col gap-8">
            <h3 class="text-xl font-black text-secondary uppercase tracking-tight border-b border-outline pb-6">Resumen Global</h3>
            
            <div class="flex flex-col gap-6">
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-on-surface-variant">Ingresos Totales</span>
                    <span class="text-lg font-black text-primary">+${{ number_format($ingresos, 2) }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span class="text-sm font-bold text-on-surface-variant">Egresos Totales</span>
                    <span class="text-lg font-black text-red-600">-${{ number_format($egresos, 2) }}</span>
                </div>
                <div class="flex justify-between items-center pt-6 border-t border-outline">
                    <span class="text-base font-black text-secondary">Balance Neto</span>
                    <span class="text-2xl font-black {{ $balance >= 0 ? 'text-primary' : 'text-red-600' }}">${{ number_format($balance, 2) }}</span>
                </div>
            </div>

            <!-- Simple Chart Placeholder (Visual Only) -->
            <div class="mt-4 h-40 bg-surface-variant/30 rounded-3xl relative overflow-hidden flex items-end gap-2 p-6">
                <div class="flex-1 bg-primary/20 h-[60%] rounded-t-xl"></div>
                <div class="flex-1 bg-primary/40 h-[80%] rounded-t-xl"></div>
                <div class="flex-1 bg-primary h-[40%] rounded-t-xl"></div>
                <div class="flex-1 bg-primary/60 h-[90%] rounded-t-xl"></div>
                <div class="flex-1 bg-primary/30 h-[50%] rounded-t-xl"></div>
            </div>
        </div>

        <!-- Recent Table Column -->
        <div class="lg:col-span-2 bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
            <div class="p-8 border-b border-outline bg-gray-50/30">
                <h3 class="text-xl font-bold text-secondary">Historial de Auditoría</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-[#f1f5f9]/50">
                            <th class="px-8 py-5 text-[11px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Fecha</th>
                            <th class="px-8 py-5 text-[11px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline">Concepto</th>
                            <th class="px-8 py-5 text-[11px] font-black text-on-surface-variant uppercase tracking-widest border-b border-outline text-right">Monto</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-outline">
                        @foreach($recentMovements as $m)
                        <tr class="hover:bg-surface transition-all group">
                            <td class="px-8 py-5 text-sm font-bold text-on-surface-variant">
                                {{ $m->date->format('d M, Y') }}
                            </td>
                            <td class="px-8 py-5 text-sm font-black text-secondary">
                                {{ $m->description }}
                            </td>
                            <td class="px-8 py-5 text-sm font-black text-right {{ $m->type === 'ingreso' ? 'text-primary' : 'text-red-600' }}">
                                {{ $m->type === 'ingreso' ? '+' : '-' }}${{ number_format($m->amount, 2) }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
