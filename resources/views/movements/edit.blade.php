@extends('layouts.app')

@section('title', 'Editar Movimiento')

@section('content')
<div class="flex flex-col gap-10 max-w-[1200px] mx-auto">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-4">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-black text-secondary tracking-tight">Editar Movimiento</h1>
            <p class="text-on-surface-variant font-medium">Actualice la información de la transacción #{{ $movement->id }}.</p>
        </div>
        <a href="{{ route('movements.index') }}" class="h-12 px-6 border border-outline text-secondary rounded-2xl font-bold flex items-center justify-center gap-2 hover:bg-surface-variant transition-all cursor-pointer shrink-0">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Volver
        </a>
    </div>

    <!-- Core Layout -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
        <!-- Main Form Column (2/3 Width) -->
        <div class="lg:col-span-2 flex flex-col gap-8">
            <div class="bg-white border border-outline rounded-[2.5rem] shadow-premium overflow-hidden">
                <div class="p-8 md:p-10 border-b border-outline bg-gray-50/20 flex justify-between items-center flex-wrap gap-4">
                    <h3 class="text-xl font-bold text-secondary flex items-center gap-2">
                        <span class="material-symbols-outlined text-primary fill-1">edit_calendar</span>
                        Modificar Transacción
                    </h3>
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider {{ $movement->type === 'ingreso' ? 'bg-emerald-50 text-primary border border-emerald-100' : 'bg-red-50 text-red-600 border border-red-100' }}">
                            {{ $movement->type }}
                        </span>
                        <span class="text-xs font-black text-secondary">
                            ${{ number_format($movement->amount, 0) }}
                        </span>
                    </div>
                </div>
                
                <div class="p-8 md:p-12">
                    <form action="{{ route('movements.update', $movement) }}" method="POST" class="flex flex-col gap-8">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Type of Movement -->
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Tipo de Movimiento</label>
                                @if(auth()->user()->isCollaborator())
                                    <input type="hidden" name="type" value="egreso">
                                    <div class="w-full h-14 px-5 rounded-2xl bg-surface-variant/40 border border-outline flex items-center gap-3 text-red-600 font-bold select-none">
                                        <span class="material-symbols-outlined">trending_down</span>
                                        Egreso <span class="text-[10px] text-on-surface-variant/60 font-semibold uppercase tracking-wider ml-1">(Rol Colaborador)</span>
                                    </div>
                                @else
                                    <div class="relative">
                                        <select class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none" 
                                                id="type" 
                                                name="type" 
                                                required>
                                            <option value="ingreso" {{ old('type', $movement->type) == 'ingreso' ? 'selected' : '' }}>Ingreso (+)</option>
                                            <option value="egreso" {{ old('type', $movement->type) == 'egreso' ? 'selected' : '' }}>Egreso (-)</option>
                                        </select>
                                        <span class="material-symbols-outlined absolute right-4 top-1/2 -translate-y-1/2 text-on-surface-variant pointer-events-none">expand_more</span>
                                    </div>
                                    @error('type')
                                        <span class="text-xs text-red-500 font-bold ml-1">{{ $message }}</span>
                                    @enderror
                                @endif
                            </div>

                            <!-- Amount -->
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Monto ($ COP)</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-on-surface-variant font-bold">$</span>
                                    <input type="number" 
                                           step="0.01" 
                                           min="0.01" 
                                           class="w-full h-14 pl-10 pr-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-bold" 
                                           id="amount" 
                                           name="amount" 
                                           value="{{ old('amount', $movement->amount) }}" 
                                           placeholder="0.00" 
                                           required>
                                </div>
                                @error('amount')
                                    <span class="text-xs text-red-500 font-bold ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Date -->
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Fecha del Movimiento</label>
                                <input type="date" 
                                       class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" 
                                       id="date" 
                                       name="date" 
                                       value="{{ old('date', $movement->date->format('Y-m-d')) }}" 
                                       required>
                                @error('date')
                                    <span class="text-xs text-red-500 font-bold ml-1">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Associated to -->
                            <div class="flex flex-col gap-2">
                                <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Asociado a (Cuenta / Entidad)</label>
                                <input type="text" 
                                       class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" 
                                       id="associated_to" 
                                       name="associated_to" 
                                       value="{{ old('associated_to', $movement->associated_to) }}" 
                                       placeholder="Banco Principal, Caja Chica, etc.">
                                @error('associated_to')
                                    <span class="text-xs text-red-500 font-bold ml-1">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="flex flex-col gap-2">
                            <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Descripción</label>
                            <textarea class="w-full p-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium resize-none" 
                                      id="description" 
                                      name="description" 
                                      rows="4" 
                                      placeholder="Describe detalladamente el movimiento..." 
                                      required>{{ old('description', $movement->description) }}</textarea>
                            @error('description')
                                <span class="text-xs text-red-500 font-bold ml-1">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Audit metadata box -->
                        <div class="p-6 bg-surface-variant/30 border border-outline rounded-3xl flex flex-col gap-4 text-xs font-semibold text-on-surface-variant">
                            <div class="flex items-center gap-2 text-secondary font-black text-xs uppercase tracking-widest border-b border-outline pb-2">
                                <span class="material-symbols-outlined text-[16px] text-primary">feed</span>
                                Bitácora de Registro
                            </div>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div class="flex flex-col gap-1">
                                    <span><strong>ID Interno:</strong> #{{ $movement->id }}</span>
                                    <span><strong>Registrador por:</strong> {{ $movement->user->name ?? 'Sistema' }}</span>
                                    <span><strong>Fecha Registro:</strong> {{ $movement->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div class="flex flex-col gap-1">
                                    <span><strong>Última Modificación:</strong> {{ $movement->updated_at->format('d/m/Y H:i') }}</span>
                                    <span><strong>Estado de Transacción:</strong> <span class="text-primary font-bold uppercase tracking-wider">{{ $movement->status }}</span></span>
                                </div>
                            </div>
                        </div>

                        <!-- Actions row (Responsive) -->
                        <div class="flex flex-col sm:flex-row justify-between items-center gap-4 border-t border-outline pt-8">
                            <div class="w-full sm:w-auto flex flex-col sm:flex-row gap-4">
                                <a href="{{ route('movements.index') }}" class="h-14 px-8 rounded-2xl border border-outline text-on-surface-variant font-bold text-sm hover:bg-surface-variant flex items-center justify-center transition-all">
                                    Cancelar
                                </a>
                                <button type="submit" class="h-14 px-8 bg-primary text-white rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-primary/20 transition-all active:scale-[0.98]">
                                    Guardar Cambios
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar Permissions and Deletion (1/3 Width) -->
        <div class="flex flex-col gap-8">
            <!-- Dangerous Actions Card (Delete) -->
            <div class="bg-white border border-outline rounded-[2.5rem] p-8 shadow-premium flex flex-col gap-6">
                <h4 class="text-xs font-black text-red-600 uppercase tracking-widest border-b border-outline pb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-red-500 fill-1">warning</span>
                    Acciones de Riesgo
                </h4>
                
                <p class="text-xs text-on-surface-variant font-medium leading-relaxed">
                    Al eliminar este movimiento se restará o sumará la cantidad respectiva del saldo de las cuentas y el flujo contable global. Esta acción no se puede deshacer.
                </p>
                
                <form action="{{ route('movements.destroy', $movement) }}" 
                      method="POST" 
                      onsubmit="return confirm('¿Estás seguro de eliminar este movimiento? Esta acción no se puede deshacer.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full h-14 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-2xl font-bold text-sm transition-all flex items-center justify-center gap-2 shadow-sm cursor-pointer">
                        <span class="material-symbols-outlined">delete</span>
                        Eliminar Transacción
                    </button>
                </form>
            </div>

            <!-- Role Permissions Card -->
            <div class="bg-white border border-outline rounded-[2.5rem] p-8 shadow-premium flex flex-col gap-4">
                <h4 class="text-xs font-black text-secondary uppercase tracking-widest border-b border-outline pb-4 flex items-center gap-2">
                    <span class="material-symbols-outlined text-indigo-600 fill-1">shield</span>
                    Permisos de Edición
                </h4>
                
                <ul class="flex flex-col gap-3">
                    @if(auth()->user()->isCollaborator())
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-emerald-500 text-[18px] shrink-0">check_circle</span>
                            <span>Puede modificar este registro porque le pertenece.</span>
                        </li>
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-red-500 text-[18px] shrink-0">cancel</span>
                            <span>No está autorizado a modificar transacciones de terceros.</span>
                        </li>
                    @else
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-emerald-500 text-[18px] shrink-0">check_circle</span>
                            <span>Control completo de edición sobre cualquier campo.</span>
                        </li>
                        <li class="flex items-start gap-2.5 text-xs text-on-surface-variant font-medium leading-relaxed">
                            <span class="material-symbols-outlined text-emerald-500 text-[18px] shrink-0">check_circle</span>
                            <span>Registro automático de auditoría con su autoría.</span>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection
