@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<div class="flex flex-col gap-10 max-w-[1200px] mx-auto">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div class="flex flex-col gap-1">
            <h1 class="text-4xl font-black text-secondary tracking-tight">Editar Usuario</h1>
            <p class="text-on-surface-variant font-medium">Actualice la información de acceso de <span class="font-bold text-secondary">{{ $user->name }}</span>.</p>
        </div>
        <a href="{{ route('root.users.index') }}" class="h-12 px-6 border border-outline text-secondary rounded-2xl font-bold flex items-center gap-2 hover:bg-surface-variant transition-all active:scale-[0.98]">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
            Volver
        </a>
    </div>

    <!-- Edit Form Card -->
    <div class="bg-white border border-outline rounded-[2.5rem] shadow-sm overflow-hidden">
        <div class="p-12">
            <h3 class="text-xl font-bold text-secondary mb-10 ml-1">Modificar Información</h3>
            
            <form action="{{ route('root.users.update', $user) }}" method="POST" class="flex flex-col gap-10">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-8">
                    <!-- Nombre Completo -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Nombre Completo</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" required>
                    </div>

                    <!-- Rol del Sistema -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Rol del Sistema</label>
                        <select name="role" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none" required>
                            <option value="administrador" {{ old('role', $user->role) == 'administrador' ? 'selected' : '' }}>Administrador</option>
                            <option value="colaborador" {{ old('role', $user->role) == 'colaborador' ? 'selected' : '' }}>Colaborador</option>
                        </select>
                    </div>

                    <!-- Correo Electrónico -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Correo Electrónico</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" required>
                    </div>

                    <!-- Estado -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Estado de Acceso</label>
                        <select name="status" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium appearance-none" required>
                            <option value="activo" {{ old('status', $user->status) == 'activo' ? 'selected' : '' }}>Activo</option>
                            <option value="inactivo" {{ old('status', $user->status) == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
                        </select>
                    </div>

                    <!-- Nueva Contraseña -->
                    <div class="flex flex-col gap-2">
                        <div class="flex justify-between items-center ml-1">
                            <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest">Nueva Contraseña</label>
                            <span class="text-[9px] font-black text-primary uppercase tracking-widest bg-primary-light px-2 py-0.5 rounded-full">Opcional</span>
                        </div>
                        <div class="relative">
                            <input type="password" name="password" class="w-full h-14 px-5 pr-14 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="••••••••">
                            <button type="button" class="absolute right-0 top-0 h-full px-5 flex items-center justify-center text-on-surface-variant hover:text-primary transition-colors">
                                <span class="material-symbols-outlined text-[20px]">visibility</span>
                            </button>
                        </div>
                    </div>

                    <!-- Confirmar Contraseña -->
                    <div class="flex flex-col gap-2">
                        <label class="text-[11px] font-bold text-on-surface-variant uppercase tracking-widest ml-1">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" class="w-full h-14 px-5 rounded-2xl bg-surface-variant/30 border border-outline focus:bg-white focus:border-primary focus:ring-4 focus:ring-primary/5 transition-all text-secondary font-medium" placeholder="••••••••">
                    </div>
                </div>

                <!-- Actions -->
                <div class="flex justify-end gap-6 mt-6">
                    <a href="{{ route('root.users.index') }}" class="px-10 py-4 rounded-2xl border border-outline text-on-surface-variant font-bold text-sm hover:bg-surface-variant transition-all">
                        Descartar
                    </a>
                    <button type="submit" class="px-10 py-4 bg-primary text-white rounded-2xl font-bold text-sm hover:shadow-xl hover:shadow-primary/20 transition-all active:scale-[0.98]">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
