@extends('layouts.app')

@section('title', 'Gestión de Comisiones')

@section('content')
<div class="flex flex-col gap-10">
    <div class="flex flex-col gap-1">
        <h1 class="text-4xl font-black text-secondary tracking-tight">Comisiones de Colaboradores</h1>
        <p class="text-on-surface-variant font-medium">Control de incentivos y compensaciones generadas por el equipo.</p>
    </div>

    <div class="bg-white border border-outline rounded-[3rem] shadow-premium overflow-hidden hover-lift">
        <div class="p-10 border-b border-outline bg-gray-50/30">
            <h3 class="text-2xl font-black text-secondary">Historial de Comisiones</h3>
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
                    @forelse($comisiones as $m)
                        <tr class="hover:bg-primary/[0.02] transition-all">
                            <td class="px-8 py-6 text-sm font-bold text-secondary">{{ $m->date->format('d/m/Y') }}</td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-emerald-100 text-primary flex items-center justify-center text-xs font-black">
                                        {{ strtoupper(substr($m->user->name ?? 'C', 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-bold text-secondary">{{ $m->user->name ?? 'Colaborador' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-right text-sm font-black text-primary">+${{ number_format($m->amount, 0) }}</td>
                            <td class="px-8 py-6 text-center">
                                <span class="badge {{ $m->status === 'completado' ? 'bg-success' : 'bg-amber' }}">
                                    {{ $m->status }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center text-on-surface-variant">No hay comisiones registradas.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($comisiones->hasPages())
            <div class="p-8 border-t border-outline">
                {{ $comisiones->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
