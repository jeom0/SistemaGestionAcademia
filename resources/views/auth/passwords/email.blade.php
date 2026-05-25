@extends('layouts.app')

@section('title', 'Recuperar Contraseña')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-[#f8fafc] p-6 antialiased">
    <div class="w-full max-w-[440px] bg-white rounded-[2rem] shadow-2xl shadow-blue-900/5 border border-outline overflow-hidden">
        <div class="p-10 flex flex-col items-center gap-8 text-center">
            <!-- Branding -->
            <div class="flex flex-col items-center gap-2">
                <h1 class="text-3xl font-black text-primary tracking-tighter uppercase">Conduser</h1>
            </div>

            <!-- Title & Instructions -->
            <div class="flex flex-col gap-3 px-4">
                <h2 class="text-2xl font-bold text-secondary">Recuperar contraseña</h2>
                <p class="text-sm text-on-surface-variant font-medium leading-relaxed mb-2">
                    Ingresa tu usuario o correo electrónico para recibir instrucciones de recuperación.
                </p>
            </div>

            <!-- Success Status Alert -->
            @if (session('status'))
                <div class="w-full p-4 bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs font-bold rounded-2xl flex items-center gap-3">
                    <span class="material-symbols-outlined text-primary fill-1 text-[20px]">check_circle</span>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            <!-- Form -->
            <form action="{{ route('password.email') }}" method="POST" class="w-full flex flex-col gap-6">
                @csrf
                <div class="flex flex-col gap-2 text-left">
                    <label class="text-[11px] font-bold text-on-surface-variant ml-1 uppercase tracking-widest" for="email">Usuario o correo electrónico</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-[20px] group-focus-within:text-primary transition-colors">person</span>
                        <input type="email" name="email" id="email" class="w-full h-14 pl-12 pr-4 rounded-2xl bg-surface-variant/50 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="ejemplo@correo.com" required/>
                    </div>
                    @error('email')
                        <span class="text-xs text-red-600 mt-1 ml-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="w-full h-14 bg-[#006837] text-white rounded-2xl font-bold shadow-xl shadow-emerald-900/20 hover:scale-[1.01] active:scale-[0.99] transition-all">
                    Enviar instrucciones
                </button>
            </form>

            <!-- Back Link -->
            <div class="pt-2 border-t border-outline w-full flex justify-center mt-2">
                <a href="{{ route('login') }}" class="flex items-center gap-2 text-[13px] font-bold text-on-surface-variant hover:text-primary transition-colors group">
                    <span class="material-symbols-outlined text-[18px] group-hover:-translate-x-1 transition-transform">arrow_back</span>
                    Volver al inicio de sesión
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
