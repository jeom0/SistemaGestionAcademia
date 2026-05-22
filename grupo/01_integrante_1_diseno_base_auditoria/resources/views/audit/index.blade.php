@extends('layouts.app')

@section('title', 'Auditoría del Sistema')

@section('content')
<div class="flex flex-col gap-10">
    <div class="flex flex-col gap-1">
        <h1 class="text-4xl font-black text-secondary tracking-tight">Auditoría del Sistema</h1>
        <p class="text-on-surface-variant font-medium">Trazabilidad completa de todas las acciones realizadas en la plataforma.</p>
    </div>

    <div class="bg-white border border-outline rounded-[3rem] shadow-premium overflow-hidden hover-lift group">
        <div class="p-10 border-b border-outline bg-gray-50/30">
            <h3 class="text-2xl font-black text-secondary">Registros de Actividad</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50">
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Fecha y Hora</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Usuario</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Acción</th>
                        <th class="px-8 py-6 text-[11px] font-black text-on-surface-variant uppercase tracking-[0.2em] border-b border-outline">Detalles</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-outline">
                    @forelse($logs as $log)
                        <tr class="hover:bg-primary/[0.02] transition-all">
                            <td class="px-8 py-6">
                                <span class="text-sm font-bold text-secondary">{{ $log->created_at->format('d/m/Y H:i:s') }}</span>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-8 h-8 rounded-lg bg-surface-variant flex items-center justify-center text-xs font-black text-primary">
                                        {{ strtoupper(substr($log->user->name ?? 'S', 0, 1)) }}
                                    </div>
                                    <span class="text-sm font-bold text-secondary">{{ $log->user->name ?? 'Sistema' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <span class="px-4 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $log->action === 'created' ? 'bg-emerald-100 text-primary' : ($log->action === 'updated' ? 'bg-blue-100 text-blue-700' : 'bg-red-100 text-red-700') }}">
                                    {{ $log->action }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-sm text-on-surface-variant font-medium">{{ $log->details }}</span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-8 py-20 text-center text-on-surface-variant">No hay registros de auditoría.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="p-8 border-t border-outline">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
