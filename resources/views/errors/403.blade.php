@extends('layouts.app')

@section('title', 'Acceso Denegado')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center p-6 antialiased">
    <div class="w-full max-w-[500px] bg-white rounded-[2.5rem] shadow-premium border border-outline overflow-hidden">
        <div class="p-10 md:p-12 flex flex-col items-center gap-8 text-center">
            
            <!-- Lock Icon -->
            <div class="w-20 h-20 bg-red-50 border border-red-100 text-red-600 rounded-3xl flex items-center justify-center shadow-sm">
                <span class="material-symbols-outlined text-[44px] fill-1">lock</span>
            </div>

            <!-- Header Title -->
            <div class="flex flex-col gap-2">
                <h1 class="text-5xl font-black text-red-600 tracking-tighter">403</h1>
                <h2 class="text-2xl font-bold text-secondary">Acceso Denegado</h2>
                <p class="text-sm text-on-surface-variant font-medium leading-relaxed px-4">
                    Lo sentimos, tu cuenta de usuario no dispone de los privilegios necesarios para ver esta sección.
                </p>
            </div>

            <!-- Diagnostics Box -->
            <div class="w-full p-6 bg-amber-50 border border-amber-100 text-amber-950 rounded-2xl text-left flex flex-col gap-3">
                <h4 class="text-xs font-black uppercase tracking-wider flex items-center gap-1.5 text-amber-800">
                    <span class="material-symbols-outlined text-[16px] fill-1">warning</span>
                    Posibles Motivos:
                </h4>
                <ul class="text-xs font-semibold flex flex-col gap-1.5 list-disc pl-5 leading-relaxed text-amber-900">
                    <li>Su rol de usuario no tiene acceso a esta función específica.</li>
                    <li>La página requiere credenciales de nivel administrador o root.</li>
                    <li>Su cuenta de usuario no está activa actualmente en la plataforma.</li>
                </ul>
            </div>

            <!-- Actions (Responsive) -->
            <div class="w-full flex flex-col sm:flex-row justify-center gap-4 border-t border-outline pt-8">
                @if(auth()->check())
                    <a href="{{ route('dashboard') }}" class="h-14 px-8 bg-primary text-white rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-primary/20 transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                        <span class="material-symbols-outlined">home</span>
                        Ir al Dashboard
                    </a>
                    <form action="{{ route('logout') }}" method="POST" class="w-full sm:w-auto">
                        @csrf
                        <button type="submit" class="w-full h-14 px-8 border border-outline text-red-600 hover:bg-red-50 rounded-2xl font-bold text-sm transition-all flex items-center justify-center gap-2 cursor-pointer">
                            <span class="material-symbols-outlined">logout</span>
                            Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="h-14 px-8 bg-primary text-white rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-primary/20 transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
                        <span class="material-symbols-outlined">login</span>
                        Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="h-14 px-8 border border-outline text-secondary hover:bg-surface-variant rounded-2xl font-bold text-sm transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">person_add</span>
                        Registrarse
                    </a>
                @endif
            </div>
            
            <p class="text-[10px] text-on-surface-variant/50 font-bold uppercase tracking-widest mt-2">
                Academia Conduser Core Security
            </p>
        </div>
    </div>
</div>
@endsection
