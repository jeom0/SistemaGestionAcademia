@extends('layouts.app')

@section('title', 'Cuentas')

@section('content')
<div class="flex flex-col gap-10 max-w-[1400px] mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center bg-white p-10 rounded-[2.5rem] border border-outline shadow-premium relative overflow-hidden">
        <div class="relative z-10 flex flex-col gap-2">
            <h1 class="text-4xl font-black text-secondary tracking-tight">Mis Cuentas</h1>
            <p class="text-on-surface-variant font-medium">Saldos y movimientos agrupados por entidad financiera o cliente.</p>
        </div>
        <div class="relative z-10">
            <div class="w-20 h-20 bg-indigo-50 rounded-3xl flex items-center justify-center text-indigo-600 shadow-inner">
                <span class="material-symbols-outlined text-[48px] fill-1">account_balance</span>
            </div>
        </div>
        <!-- Decorative bg -->
        <div class="absolute right-0 top-0 h-full w-1/3 bg-indigo-50/30 -skew-x-12 translate-x-1/2"></div>
    </div>

    <!-- Accounts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @forelse($accounts as $account)
        <div class="bg-white border border-outline rounded-[2.5rem] p-10 shadow-premium hover-lift group">
            <div class="flex flex-col gap-8">
                <div class="flex justify-between items-start">
                    <div class="w-14 h-14 bg-surface-variant rounded-2xl flex items-center justify-center group-hover:bg-primary/10 group-hover:text-primary transition-all">
                        <span class="material-symbols-outlined text-3xl">domain</span>
                    </div>
                    <span class="px-4 py-1 bg-emerald-50 text-primary rounded-full text-[10px] font-black uppercase tracking-widest">Activa</span>
                </div>
                
                <div class="flex flex-col">
                    <h3 class="text-xl font-black text-secondary uppercase tracking-tight">{{ $account->associated_to }}</h3>
                    <span class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest mt-1">Saldo Consolidado</span>
                </div>

                <div class="pt-6 border-t border-outline flex items-end justify-between">
                    <span class="text-4xl font-black {{ $account->balance >= 0 ? 'text-primary' : 'text-red-600' }}">
                        ${{ number_format($account->balance, 2) }}
                    </span>
                    <a href="{{ route('movements.index', ['associated_to' => $account->associated_to]) }}" class="w-10 h-10 rounded-xl bg-surface-variant flex items-center justify-center text-secondary hover:bg-primary hover:text-white transition-all">
                        <span class="material-symbols-outlined">arrow_forward</span>
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-3 py-20 flex flex-col items-center gap-6 opacity-30">
            <span class="material-symbols-outlined text-[100px]">account_balance_wallet</span>
            <h4 class="text-xl font-black uppercase tracking-widest">No hay cuentas registradas</h4>
            <p class="text-sm font-medium text-center max-w-xs">Los movimientos que asocies a una entidad aparecerán aquí automáticamente.</p>
        </div>
        @endforelse
    </div>

    <!-- Info Banner -->
    <div class="bg-secondary rounded-[2.5rem] p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8 shadow-2xl shadow-secondary/20">
        <div class="flex flex-col gap-3">
            <h2 class="text-2xl font-black">¿Necesitas añadir una nueva cuenta?</h2>
            <p class="text-white/60 font-medium">Solo tienes que registrar un movimiento y escribir el nombre de la nueva entidad en el campo "Asocia".</p>
        </div>
        <a href="{{ route('movements.index') }}" class="px-10 py-4 bg-primary text-white rounded-2xl font-black text-sm hover:scale-[1.05] transition-all shadow-xl shadow-primary/20">
            Ir a Movimientos
        </a>
    </div>
</div>
@endsection
