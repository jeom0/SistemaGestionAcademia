@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="min-h-screen flex antialiased">
    <!-- Left Column: Branding (Image 4 Style) -->
    <div class="hidden lg:flex w-[55%] bg-[#e9edff] relative flex-col items-center justify-center overflow-hidden border-r border-outline">
        <!-- Abstract road/curve decorations -->
        <div class="absolute bottom-0 left-0 w-full h-[40%] bg-white/30 backdrop-blur-3xl rounded-t-[100%] scale-150 translate-y-1/2"></div>
        
        <div class="relative z-10 flex flex-col items-center gap-6">
            <!-- Icon Box -->
            <div class="w-20 h-20 bg-primary rounded-3xl flex items-center justify-center shadow-2xl shadow-primary/20">
                <span class="material-symbols-outlined text-white text-[40px] fill-1">directions_car</span>
            </div>
            
            <div class="text-center">
                <h1 class="text-5xl font-black text-secondary tracking-tight">Conduser</h1>
                <p class="text-on-surface-variant mt-4 max-w-xs mx-auto leading-relaxed font-medium">
                    Plataforma integral para la gestión profesional de flotas y conductores.
                </p>
            </div>
        </div>
        
        <!-- Decorative elements from mockup -->
        <div class="absolute top-1/4 left-10 w-32 h-32 bg-primary/5 rounded-full blur-3xl"></div>
        <div class="absolute bottom-1/4 right-10 w-48 h-48 bg-blue-500/5 rounded-full blur-3xl"></div>
    </div>

    <!-- Right Column: Login Form -->
    <div class="w-full lg:w-[45%] bg-surface flex flex-col items-center justify-center p-8 md:p-16 relative">
        <div class="w-full max-w-md">
            <!-- Avatar Section -->
            <div class="flex justify-center mb-12">
                <div class="w-20 h-20 bg-[#f1f5f9] rounded-full flex items-center justify-center border border-outline shadow-sm overflow-hidden">
                    <span class="material-symbols-outlined text-on-surface-variant text-[40px]">person</span>
                </div>
            </div>

            <!-- Login Form -->
            <form action="{{ route('login') }}" method="POST" class="flex flex-col gap-8">
                @csrf
                
                <!-- Email Field -->
                <div class="flex flex-col gap-2">
                    <label class="text-[13px] font-bold text-on-surface-variant ml-1" for="email">Usuario</label>
                    <div class="relative group">
                        <input class="w-full h-14 px-5 rounded-2xl bg-white border border-outline text-secondary focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all @error('email') border-red-500 @enderror" 
                               id="email" name="email" value="{{ old('email') }}" placeholder="Ingresa su usuario" type="email" required autofocus/>
                    </div>
                    @error('email')
                        <span class="text-xs text-red-600 mt-1 ml-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Field -->
                <div class="flex flex-col gap-2">
                    <label class="text-[13px] font-bold text-on-surface-variant ml-1" for="password">Contraseña</label>
                    <div class="relative group">
                        <input class="w-full h-14 px-5 pr-14 rounded-2xl bg-white border border-outline text-secondary focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all @error('password') border-red-500 @enderror" 
                               id="password" name="password" placeholder="••••••••" type="password" required/>
                        <button type="button" class="absolute right-0 top-0 h-full px-5 flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors">
                            <span class="material-symbols-outlined text-[20px]">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-xs text-red-600 mt-1 ml-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-6 mt-4">
                    <button class="w-full h-14 bg-primary text-white rounded-2xl font-bold shadow-xl shadow-primary/10 hover:shadow-primary/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center" type="submit">
                        Ingresar
                    </button>
                    
                    <div class="text-center">
                        <a href="{{ route('password.request') }}" class="text-[13px] font-bold text-on-surface-variant hover:text-primary transition-colors">
                            Olvidé mi contraseña
                        </a>
                    </div>
                </div>
            </form>

            <!-- Bottom Floating Action -->
            <div class="absolute bottom-10 right-10">
                <button class="w-12 h-12 bg-white border border-outline rounded-full flex items-center justify-center text-on-surface-variant hover:text-primary hover:border-primary transition-all shadow-md group">
                    <span class="material-symbols-outlined text-[24px]">help</span>
                </button>
            </div>
        </div>

        <!-- Root Credentials Info (For Testing Only) -->
        <div class="mt-12 p-6 bg-white rounded-3xl border border-outline w-full max-w-sm hidden md:block">
            <div class="flex items-center gap-2 text-primary font-bold text-[11px] uppercase tracking-widest mb-3">
                <span class="material-symbols-outlined text-sm">lock_open</span>
                Acceso Administrador Root
            </div>
            <div class="flex flex-col gap-1 text-[11px] text-on-surface-variant">
                <div class="flex justify-between border-b border-surface-variant pb-1">
                    <span class="font-bold">Usuario:</span>
                    <span>conduserroot@gmail.com</span>
                </div>
                <div class="flex justify-between pt-1">
                    <span class="font-bold">Password:</span>
                    <span>Conduser@2005</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
