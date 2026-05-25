@extends('layouts.app')

@section('title', 'Iniciar Sesión')

@section('content')
<div class="min-h-screen flex antialiased" x-data="{ helpModalOpen: false }">
    <!-- Left Column: Branding with Beautiful Vector Illustration -->
    <div class="hidden lg:flex w-[55%] relative overflow-hidden">
        <!-- Base Background (Green waves + original cards) -->
        <div class="absolute inset-0 bg-cover bg-center" style="background-image: url('{{ asset('images/login_bg.png') }}');"></div>
        
        <!-- Overlay Background (High quality transparent cards, perfectly aligned, no hover movement) -->
        <div class="absolute inset-0 bg-cover bg-center z-10" style="background-image: url('{{ asset('images/login_bg1.png') }}');"></div>

        <!-- Abstract shadow mask to integrate UI premium texture -->
        <div class="absolute inset-0 bg-emerald-950/20 z-20 pointer-events-none"></div>

        <!-- Smooth white gradient transition at the right edge to integrate with form -->
        <div class="absolute inset-y-0 right-0 w-64 bg-gradient-to-r from-transparent via-surface/60 to-surface z-30 pointer-events-none"></div>
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
                <div class="flex flex-col gap-2" x-data="{ showPassword: false }">
                    <label class="text-[13px] font-bold text-on-surface-variant ml-1" for="password">Contraseña</label>
                    <div class="relative group">
                        <input class="w-full h-14 px-5 pr-14 rounded-2xl bg-white border border-outline text-secondary focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all @error('password') border-red-500 @enderror" 
                               id="password" name="password" placeholder="••••••••" :type="showPassword ? 'text' : 'password'" required/>
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-0 top-0 h-full px-5 flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
                            <span class="material-symbols-outlined x-text" x-text="showPassword ? 'visibility_off' : 'visibility'">visibility</span>
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
                <button @click="helpModalOpen = true" class="w-12 h-12 bg-white border border-outline rounded-full flex items-center justify-center text-on-surface-variant hover:text-primary hover:border-primary transition-all shadow-md group cursor-pointer">
                    <span class="material-symbols-outlined text-[24px]">help</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Modal de Soporte WhatsApp -->
    <div x-show="helpModalOpen" 
         x-cloak 
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/60 backdrop-blur-sm"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">
         
        <div class="bg-white rounded-[2rem] shadow-2xl border border-outline p-8 max-w-md w-full relative flex flex-col items-center gap-6" @click.away="helpModalOpen = false">
            <!-- Icono verde de Whatsapp -->
            <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center text-primary shadow-sm border border-emerald-100">
                <span class="material-symbols-outlined text-[32px] fill-1">chat</span>
            </div>
            
            <div class="text-center flex flex-col gap-2">
                <h3 class="text-xl font-black text-secondary">Soporte Técnico Inmediato</h3>
                <p class="text-sm text-on-surface-variant leading-relaxed font-medium">
                    ¿Tienes dudas o necesitas asistencia con el sistema de la <strong>Academia Conduser</strong>? Ponte en contacto con nuestro equipo por WhatsApp para recibir ayuda personalizada de inmediato.
                </p>
            </div>
            
            <div class="flex flex-col gap-3 w-full">
                <!-- Botón de chat WhatsApp -->
                <a href="https://wa.me/573000000000?text=Hola,%20necesito%20soporte%20con%20el%20sistema%20Academia%20Conduser" 
                   target="_blank" 
                   class="w-full h-14 bg-[#006837] hover:bg-[#005a30] text-white rounded-2xl font-bold shadow-xl shadow-primary/10 hover:shadow-primary/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2 text-sm cursor-pointer">
                    <span class="material-symbols-outlined">chat</span>
                    Iniciar Chat de WhatsApp
                </a>
                
                <!-- Botón de cerrar -->
                <button @click="helpModalOpen = false" 
                        class="w-full h-14 bg-surface-variant text-on-surface-variant hover:text-secondary rounded-2xl font-bold transition-all text-sm cursor-pointer">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
