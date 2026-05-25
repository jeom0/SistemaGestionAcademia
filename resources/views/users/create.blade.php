@extends('layouts.app')

@section('title', 'Crear Usuario')

@section('content')
<div class="flex flex-col gap-10 max-w-[1200px] mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-black text-secondary tracking-tight">Crear Usuarios</h1>
            <p class="text-on-surface-variant font-medium">Añade nuevos administradores o colaboradores a la plataforma.</p>
        </div>
        <a href="{{ route('root.users.index') }}" class="h-12 px-6 bg-primary text-white rounded-2xl font-bold flex items-center gap-2 hover:shadow-lg transition-all active:scale-[0.98]">
            <span class="material-symbols-outlined text-[20px] fill-1">add</span>
            Crear Usuario
        </a>
    </div>

    <!-- Account Information Card (Image 5 Style) -->
    <div class="bg-white border border-outline rounded-[2.5rem] shadow-sm overflow-hidden">
        <div class="p-6 md:p-12">
            <h3 class="text-xl font-bold text-secondary mb-10 ml-1">Información de la Cuenta</h3>
            
            <form action="{{ route('root.users.store') }}" method="POST" class="flex flex-col gap-10">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <!-- Nombre Completo -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Nombre Completo</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="Ej. Juan Pérez" required>
                        @error('name') <span class="text-[10px] text-red-500 font-bold ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Rol del Sistema -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Rol del Sistema</label>
                        <select name="role" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none" required>
                            <option value="">Seleccione un rol</option>
                            <option value="administrador" {{ old('role') == 'administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="colaborador" {{ old('role') == 'colaborador' ? 'selected' : '' }}>Colaborador</option>
                        </select>
                        @error('role') <span class="text-[10px] text-red-500 font-bold ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email') }}" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="usuario@empresa.com" required>
                        @error('email') <span class="text-[10px] text-red-500 font-bold ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Estado -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Estado</label>
                        <select name="status" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none" required>
                            <option value="activo" {{ old('status') == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('status') == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <!-- Contraseña Temporal -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Contraseña Temporal</label>
                        <div class="relative" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" name="password" class="w-full h-14 px-5 pr-14 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="••••••••" required>
                            <button type="button" @click="show = !show" class="absolute right-0 top-0 h-full px-5 flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                            </button>
                        </div>
                        <p class="text-[10px] text-on-surface-variant mt-1 ml-1 font-medium">Mínimo 8 caracteres, incluir números y símbolos.</p>
                        @error('password') <span class="text-[10px] text-red-500 font-bold ml-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Confirmar Contraseña</label>
                        <div class="relative" x-data="{ show: false }">
                            <input :type="show ? 'text' : 'password'" name="password_confirmation" class="w-full h-14 px-5 pr-14 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="••••••••" required>
                            <button type="button" @click="show = !show" class="absolute right-0 top-0 h-full px-5 flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]" x-text="show ? 'visibility_off' : 'visibility'">visibility</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-6 mt-6">
                    <a href="{{ route('root.users.index') }}" class="px-10 py-4 rounded-2xl border border-outline text-on-surface-variant font-bold text-sm hover:bg-surface-variant transition-all">
                        Cancelar
                    </a>
                    <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-primary/20 transition-all active:scale-[0.98]">
                        Guardar Usuario
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
