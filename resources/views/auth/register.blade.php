@extends('layouts.app')

@section('title', 'Crear Cuenta')

@section('content')
<div class="min-h-screen flex antialiased" x-data="{ helpModalOpen: false }">
    <!-- Left Column: Branding with Beautiful Cover Image (Split screen) -->
    <div class="hidden lg:flex w-[55%] relative flex-col items-center justify-center overflow-hidden border-r border-outline bg-cover bg-center" style="background-image: url('{{ asset('images/login_bg.png') }}');">
        <div class="absolute inset-0 bg-emerald-950/5"></div>
        <!-- Smooth white gradient transition at the right edge to integrate with form -->
        <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-r from-transparent to-surface"></div>
    </div>

    <!-- Right Column: Register Form -->
    <div class="w-full lg:w-[45%] bg-surface flex flex-col items-center justify-center p-8 md:p-16 relative overflow-y-auto">
        <div class="w-full max-w-md my-8">
            <!-- Header Branding -->
            <div class="flex flex-col items-center mb-10 text-center">
                <div class="w-16 h-16 bg-primary-light text-primary rounded-3xl flex items-center justify-center border border-emerald-100 shadow-sm mb-4">
                    <span class="material-symbols-outlined text-[32px] fill-1">person_add</span>
                </div>
                <h2 class="text-3xl font-black text-secondary tracking-tight">Crear Cuenta</h2>
                <p class="text-xs text-on-surface-variant font-semibold uppercase tracking-widest mt-2">Conduser Registro</p>
            </div>

            <!-- Validation Errors -->
            @if ($errors->any())
                <div class="mb-6 p-5 bg-red-50 border border-red-100 text-red-800 rounded-2xl flex items-start gap-3 text-xs font-bold leading-relaxed">
                    <span class="material-symbols-outlined text-red-600 shrink-0">warning</span>
                    <div>
                        <p class="font-black mb-1">Por favor corrige los siguientes errores:</p>
                        <ul class="list-disc list-inside">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif

            <!-- Register Form -->
            <form action="{{ route('register') }}" method="POST" class="flex flex-col gap-6">
                @csrf
                
                <!-- Full Name -->
                <div class="flex flex-col gap-2">
                    <label class="text-[13px] font-bold text-on-surface-variant ml-1" for="name">Nombre Completo</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-[20px] group-focus-within:text-primary transition-colors">person</span>
                        <input class="w-full h-14 pl-12 pr-4 rounded-2xl bg-white border border-outline text-secondary focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all @error('name') border-red-500 @enderror" 
                               id="name" name="name" value="{{ old('name') }}" placeholder="Ingresa tu nombre completo" type="text" required autofocus/>
                    </div>
                    @error('name')
                        <span class="text-xs text-red-600 mt-1 ml-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Email -->
                <div class="flex flex-col gap-2">
                    <label class="text-[13px] font-bold text-on-surface-variant ml-1" for="email">Correo Electrónico</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-[20px] group-focus-within:text-primary transition-colors">mail</span>
                        <input class="w-full h-14 pl-12 pr-4 rounded-2xl bg-white border border-outline text-secondary focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all @error('email') border-red-500 @enderror" 
                               id="email" name="email" value="{{ old('email') }}" placeholder="correo@ejemplo.com" type="email" required/>
                    </div>
                    @error('email')
                        <span class="text-xs text-red-600 mt-1 ml-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password -->
                <div class="flex flex-col gap-2" x-data="{ showPassword: false }">
                    <label class="text-[13px] font-bold text-on-surface-variant ml-1" for="password">Contraseña</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-[20px] group-focus-within:text-primary transition-colors">lock</span>
                        <input class="w-full h-14 pl-12 pr-14 rounded-2xl bg-white border border-outline text-secondary focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all @error('password') border-red-500 @enderror" 
                               id="password" name="password" placeholder="Mínimo 8 caracteres" :type="showPassword ? 'text' : 'password'" required/>
                        <button type="button" @click="showPassword = !showPassword" class="absolute right-0 top-0 h-full px-5 flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
                            <span class="material-symbols-outlined" x-text="showPassword ? 'visibility_off' : 'visibility'">visibility</span>
                        </button>
                    </div>
                    @error('password')
                        <span class="text-xs text-red-600 mt-1 ml-1 font-medium">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Password Confirmation -->
                <div class="flex flex-col gap-2" x-data="{ showConfirmPassword: false }">
                    <label class="text-[13px] font-bold text-on-surface-variant ml-1" for="password_confirmation">Confirmar Contraseña</label>
                    <div class="relative group">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-on-surface-variant text-[20px] group-focus-within:text-primary transition-colors">lock</span>
                        <input class="w-full h-14 pl-12 pr-14 rounded-2xl bg-white border border-outline text-secondary focus:outline-none focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all" 
                               id="password_confirmation" name="password_confirmation" placeholder="Repite tu contraseña" :type="showConfirmPassword ? 'text' : 'password'" required/>
                        <button type="button" @click="showConfirmPassword = !showConfirmPassword" class="absolute right-0 top-0 h-full px-5 flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors cursor-pointer">
                            <span class="material-symbols-outlined" x-text="showConfirmPassword ? 'visibility_off' : 'visibility'">visibility</span>
                        </button>
                    </div>
                </div>

                <!-- Info Alert about Activation -->
                <div class="p-4 bg-indigo-50 border border-indigo-100 text-indigo-950 rounded-2xl flex items-start gap-3">
                    <span class="material-symbols-outlined text-indigo-600 shrink-0">info</span>
                    <p class="text-[11px] font-medium leading-relaxed">
                        Al registrarte, tu cuenta será creada como <strong>Colaborador</strong> y requerirá que un administrador root active su acceso antes de poder ingresar.
                    </p>
                </div>

                <!-- Submit Button -->
                <div class="flex flex-col gap-6 mt-2">
                    <button class="w-full h-14 bg-primary text-white rounded-2xl font-bold shadow-xl shadow-primary/10 hover:shadow-primary/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center text-sm" type="submit">
                        Registrarme
                    </button>
                    
                    <div class="text-center">
                        <p class="text-[13px] text-on-surface-variant font-medium">
                            ¿Ya tienes una cuenta? 
                            <a href="{{ route('login') }}" class="font-bold text-primary hover:underline ml-1">
                                Inicia sesión aquí
                            </a>
                        </p>
                    </div>
                </div>
            </form>

            <!-- Bottom Floating Support Button -->
            <div class="absolute bottom-10 right-10">
                <button @click="helpModalOpen = true" class="w-12 h-12 bg-white border border-outline rounded-full flex items-center justify-center text-on-surface-variant hover:text-primary hover:border-primary transition-all shadow-md group cursor-pointer">
                    <span class="material-symbols-outlined text-[24px]">help</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Help Modal (WhatsApp support) -->
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
            <div class="w-16 h-16 bg-emerald-50 rounded-full flex items-center justify-center text-primary shadow-sm border border-emerald-100">
                <span class="material-symbols-outlined text-[32px] fill-1">chat</span>
            </div>
            
            <div class="text-center flex flex-col gap-2">
                <h3 class="text-xl font-black text-secondary">Soporte Técnico Inmediato</h3>
                <p class="text-sm text-on-surface-variant leading-relaxed font-medium">
                    ¿Tienes dudas o necesitas asistencia con el sistema de la <strong>Academia Conduser</strong>? Ponte en contacto con nuestro equipo por WhatsApp para recibir ayuda de inmediato.
                </p>
            </div>
            
            <div class="flex flex-col gap-3 w-full">
                <a href="https://wa.me/573000000000?text=Hola,%20necesito%20soporte%20con%20el%20sistema%20Academia%20Conduser" 
                   target="_blank" 
                   class="w-full h-14 bg-[#006837] hover:bg-[#005a30] text-white rounded-2xl font-bold shadow-xl shadow-primary/10 hover:shadow-primary/20 hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center gap-2 text-sm cursor-pointer">
                    <span class="material-symbols-outlined">chat</span>
                    Iniciar Chat de WhatsApp
                </a>
                
                <button @click="helpModalOpen = false" 
                        class="w-full h-14 bg-surface-variant text-on-surface-variant hover:text-secondary rounded-2xl font-bold transition-all text-sm cursor-pointer">
                    Cancelar
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
