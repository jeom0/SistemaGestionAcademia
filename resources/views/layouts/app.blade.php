<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Conduser')</title>
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: "#006837",
                        "primary-light": "#dcfce7",
                        secondary: "#141b2b",
                        surface: "#f8fafc",
                        "on-surface": "#1e293b",
                        "surface-variant": "#f1f5f9",
                        "on-surface-variant": "#64748b",
                        outline: "#e2e8f0",
                        "outline-variant": "#cbd5e1",
                    },
                    borderRadius: {
                        '3xl': '1.5rem',
                        '4xl': '2rem',
                    }
                }
            }
        }
    </script>

    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            font-family: 'Inter', sans-serif;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-surface text-on-surface antialiased min-h-screen">
    @if(auth()->check())
        <div class="flex" x-data="{ sidebarOpen: false }">
            <!-- Overlay dark screen on mobile -->
            <div x-show="sidebarOpen" @click="sidebarOpen = false" x-cloak class="fixed inset-0 z-40 bg-black/40 md:hidden transition-opacity"></div>

            @include('layouts.sidebar')
            
            <div class="flex-1 flex flex-col min-h-screen min-w-0">
                <!-- Header (Responsive Style) -->
                <header class="h-20 bg-white border-b border-outline flex items-center justify-between px-4 md:px-10 sticky top-0 z-30 shadow-sm" x-data="{ notificationsOpen: false, profileOpen: false }">
                    <div class="flex items-center gap-4 md:gap-10">
                        <!-- Botón Hamburguesa Móvil -->
                        <button @click="sidebarOpen = !sidebarOpen" class="w-12 h-12 flex items-center justify-center rounded-2xl hover:bg-surface-variant transition-all text-on-surface-variant md:hidden cursor-pointer">
                            <span class="material-symbols-outlined text-[26px]">menu</span>
                        </button>

                        <!-- Logo Móvil -->
                        <div class="flex md:hidden items-center shrink-0">
                            <img src="{{ asset('images/logo.png') }}" alt="Conduser" class="h-8 w-auto">
                        </div>

                        <!-- Enlaces de navegación en escritorio -->
                        <nav class="hidden md:flex items-center gap-4">
                            <a href="{{ route('audit.index') }}" class="px-6 py-2 text-[11px] font-black uppercase tracking-[0.2em] rounded-xl transition-all {{ request()->routeIs('audit.index') ? 'bg-primary-light text-primary shadow-sm' : 'text-on-surface-variant/60 hover:bg-surface-variant hover:text-secondary' }}">Auditoría</a>
                            <a href="{{ route('payroll.comisiones') }}" class="px-6 py-2 text-[11px] font-black uppercase tracking-[0.2em] rounded-xl transition-all {{ request()->routeIs('payroll.comisiones') ? 'bg-primary-light text-primary shadow-sm' : 'text-on-surface-variant/60 hover:bg-surface-variant hover:text-secondary' }}">Comisión</a>
                            <a href="{{ route('payroll.descuentos') }}" class="px-6 py-2 text-[11px] font-black uppercase tracking-[0.2em] rounded-xl transition-all {{ request()->routeIs('payroll.descuentos') ? 'bg-primary-light text-primary shadow-sm' : 'text-on-surface-variant/60 hover:bg-surface-variant hover:text-secondary' }}">Descuentos</a>
                        </nav>
                    </div>


                    <div class="flex items-center gap-8">
                        <div class="flex items-center gap-4">
                            <!-- Traceability Dropdown (Bell) -->
                            <div class="relative" @click.away="notificationsOpen = false">
                                <button @click="notificationsOpen = !notificationsOpen; profileOpen = false" class="relative w-12 h-12 flex items-center justify-center rounded-2xl hover:bg-surface-variant transition-all text-on-surface-variant hover:text-primary group cursor-pointer">
                                    <span class="material-symbols-outlined text-[26px] group-hover:rotate-12 transition-transform">notifications</span>
                                    @if($globalAuditLogs->count() > 0)
                                        <span class="absolute top-3 right-3 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white"></span>
                                    @endif
                                </button>
                                
                                <div x-show="notificationsOpen" x-cloak x-transition class="absolute right-0 mt-3 w-96 bg-white border border-outline rounded-[2rem] shadow-2xl p-6 z-50">
                                    <div class="flex items-center justify-between mb-4">
                                        <h4 class="text-sm font-black text-secondary uppercase tracking-widest flex items-center gap-2">
                                            Trazabilidad
                                            <span class="text-[10px] bg-primary/10 text-primary px-2 py-0.5 rounded-full">Reciente</span>
                                        </h4>
                                        <button @click="notificationsOpen = false" class="w-8 h-8 rounded-full hover:bg-surface-variant flex items-center justify-center text-on-surface-variant transition-all cursor-pointer">
                                            <span class="material-symbols-outlined text-[18px]">close</span>
                                        </button>
                                    </div>
                                    <div class="flex flex-col gap-3 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                                        @forelse($globalAuditLogs as $log)
                                            <div class="flex items-start gap-3 p-3 rounded-xl bg-surface-variant/30 border border-outline hover:border-primary transition-colors">
                                                <div class="w-8 h-8 rounded-lg bg-white flex items-center justify-center shrink-0 shadow-sm">
                                                    <span class="material-symbols-outlined text-sm {{ $log->action === 'created' ? 'text-emerald-500' : ($log->action === 'deleted' ? 'text-red-500' : 'text-blue-500') }}">
                                                        {{ $log->action === 'created' ? 'add' : ($log->action === 'deleted' ? 'delete' : 'edit') }}
                                                    </span>
                                                </div>
                                                <div class="flex flex-col gap-0.5">
                                                    <p class="text-[11px] text-secondary font-bold">{{ $log->details }}</p>
                                                    <span class="text-[9px] text-on-surface-variant font-medium">{{ $log->user->name }} • {{ $log->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        @empty
                                            <p class="text-xs text-on-surface-variant text-center py-4">No hay registros recientes.</p>
                                        @endforelse
                                    </div>
                                </div>
                            </div>

                            <!-- User Profile -->
                            <div class="relative" @click.away="profileOpen = false">
                                <button @click="profileOpen = !profileOpen; notificationsOpen = false" class="w-12 h-12 flex items-center justify-center rounded-2xl overflow-hidden border-2 border-outline hover:border-primary transition-all shadow-sm cursor-pointer">
                                    @if(auth()->user()->avatar)
                                        <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="User" class="w-full h-full object-cover">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&background=006837&color=fff" alt="User" class="w-full h-full">
                                    @endif
                                </button>

                                <div x-show="profileOpen" x-cloak x-transition class="absolute right-0 mt-3 w-64 bg-white border border-outline rounded-[2rem] shadow-2xl overflow-hidden z-50">
                                    <div class="p-6 bg-surface-variant/30 border-b border-outline flex justify-between items-start">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-black text-secondary truncate block">{{ auth()->user()->name }}</span>
                                            <span class="text-[10px] text-on-surface-variant font-bold uppercase tracking-widest">{{ auth()->user()->role }}</span>
                                        </div>
                                        <button @click="profileOpen = false" class="w-8 h-8 rounded-full hover:bg-white flex items-center justify-center text-on-surface-variant transition-all shrink-0 cursor-pointer">
                                            <span class="material-symbols-outlined text-[18px]">close</span>
                                        </button>
                                    </div>
                                    <div class="p-2">
                                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-on-surface-variant hover:bg-surface-variant hover:text-secondary transition-all">
                                            <span class="material-symbols-outlined text-[20px]">person</span> Configurar Perfil
                                        </a>
                                        <form action="{{ route('logout') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-bold text-red-500 hover:bg-red-50 transition-all">
                                                <span class="material-symbols-outlined text-[20px]">logout</span> Salir
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <main class="flex-1 p-4 md:p-10 bg-surface/50">
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" x-transition:leave="transition ease-in duration-500" x-transition:leave-start="opacity-100 transform scale-100" x-transition:leave-end="opacity-0 transform scale-95" class="mb-8 p-5 bg-emerald-50 border border-emerald-100 text-emerald-800 rounded-3xl shadow-xl shadow-emerald-900/5 flex items-center gap-4">
                            <span class="material-symbols-outlined text-primary fill-1">check_circle</span>
                            <span class="text-sm font-bold">{{ session('success') }}</span>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg flex items-center gap-3">
                            <span class="material-symbols-outlined">error</span>
                            {{ session('error') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="mb-6 p-4 bg-amber-50 border border-amber-200 text-amber-700 rounded-lg">
                            <div class="flex items-center gap-3 mb-2 font-semibold">
                                <span class="material-symbols-outlined">warning</span>
                                Por favor corrige los siguientes errores:
                            </div>
                            <ul class="list-disc list-inside ml-6 text-sm">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @yield('content')
                </main>

                <footer class="p-8 border-t border-outline-variant text-center text-xs text-on-surface-variant">
                    &copy; {{ date('Y') }} Academia Conduser - Sistema Integral de Control Financiero
                </footer>
            </div>
        </div>
    @else
        @yield('content')
    @endif
    @stack('scripts')
</body>
</html>

