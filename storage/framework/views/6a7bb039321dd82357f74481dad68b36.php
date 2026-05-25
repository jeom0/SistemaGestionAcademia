<aside 
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-outline flex flex-col h-screen transition-transform duration-300 ease-in-out md:sticky md:top-0 md:translate-x-0"
>
    <!-- Botón de cerrar barra lateral en móvil -->
    <div class="md:hidden flex justify-end px-6 pt-4 -mb-4">
        <button @click="sidebarOpen = false" class="w-8 h-8 rounded-full hover:bg-surface-variant flex items-center justify-center text-on-surface-variant transition-all cursor-pointer">
            <span class="material-symbols-outlined text-[18px]">close</span>
        </button>
    </div>

    <!-- User Profile Section -->
    <div class="px-8 py-6 flex items-center gap-4">
        <div class="w-12 h-12 rounded-full bg-slate-200 overflow-hidden flex-shrink-0 border border-outline shadow-sm">
            <?php if(auth()->user()->avatar): ?>
                <img src="<?php echo e(asset('storage/' . auth()->user()->avatar)); ?>" alt="Avatar" class="w-full h-full object-cover">
            <?php else: ?>
                <img src="https://ui-avatars.com/api/?name=<?php echo e(urlencode(auth()->user()->name)); ?>&background=006837&color=fff" alt="Avatar" class="w-full h-full object-cover">
            <?php endif; ?>
        </div>
        <div class="flex flex-col">
            <span class="text-sm font-bold text-secondary leading-tight"><?php echo e(auth()->user()->name); ?></span>
            <span class="text-[10px] font-medium text-on-surface-variant uppercase tracking-wider">
                <?php echo e(auth()->user()->role === 'root' ? 'Administrador Root' : ucfirst(auth()->user()->role)); ?>

            </span>
        </div>
    </div>

    <!-- Navigation Menu -->
    <nav class="flex-1 px-4 py-4 overflow-y-auto">
        <ul class="flex flex-col gap-1">
            <li>
                <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e((request()->routeIs('dashboard') || request()->routeIs('*.dashboard')) ? 'bg-primary-light text-primary font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant hover:text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[22px] <?php echo e((request()->routeIs('dashboard') || request()->routeIs('*.dashboard')) ? 'fill-1' : ''); ?>">grid_view</span>
                    <span class="text-sm">Dashboard</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('movements.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('movements.*') ? 'bg-primary-light text-primary font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant hover:text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[22px] <?php echo e(request()->routeIs('movements.*') ? 'fill-1' : ''); ?>">payments</span>
                    <span class="text-sm">Movimientos</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('accounts.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('accounts*') ? 'bg-primary-light text-primary font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant hover:text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[22px] <?php echo e(request()->routeIs('accounts*') ? 'fill-1' : ''); ?>">account_balance</span>
                    <span class="text-sm">Cuentas</span>
                </a>
            </li>

            <?php if(auth()->user()->isRoot()): ?>
            <li>
                <a href="<?php echo e(route('root.users.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('root.users.*') ? 'bg-primary-light text-primary font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant hover:text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[22px] <?php echo e(request()->routeIs('root.users.*') ? 'fill-1' : ''); ?>">group</span>
                    <span class="text-sm">Usuarios</span>
                </a>
            </li>
            <?php endif; ?>

            <li>
                <a href="<?php echo e(route('reports.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('reports*') ? 'bg-primary-light text-primary font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant hover:text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[22px] <?php echo e(request()->routeIs('reports*') ? 'fill-1' : ''); ?>">description</span>
                    <span class="text-sm">Reportes</span>
                </a>
            </li>

            <!-- Separador -->
            <li class="px-4 py-2 mt-4">
                <span class="text-[10px] font-black text-on-surface-variant uppercase tracking-[0.2em] opacity-60">Administración</span>
            </li>

            <li>
                <a href="<?php echo e(route('payroll.comisiones')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('payroll.comisiones') ? 'bg-primary-light text-primary font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant hover:text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[22px] <?php echo e(request()->routeIs('payroll.comisiones') ? 'fill-1' : ''); ?>">payments</span>
                    <span class="text-sm">Comisiones</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('payroll.descuentos')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('payroll.descuentos') ? 'bg-primary-light text-primary font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant hover:text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[22px] <?php echo e(request()->routeIs('payroll.descuentos') ? 'fill-1' : ''); ?>">money_off</span>
                    <span class="text-sm">Descuentos</span>
                </a>
            </li>

            <li>
                <a href="<?php echo e(route('audit.index')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('audit*') ? 'bg-primary-light text-primary font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant hover:text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[22px] <?php echo e(request()->routeIs('audit*') ? 'fill-1' : ''); ?>">admin_panel_settings</span>
                    <span class="text-sm">Auditoría</span>
                </a>
            </li>
            <li>
                <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all <?php echo e(request()->routeIs('profile*') ? 'bg-primary-light text-primary font-bold shadow-sm' : 'text-on-surface-variant hover:bg-surface-variant hover:text-secondary'); ?>">
                    <span class="material-symbols-outlined text-[22px] <?php echo e(request()->routeIs('profile*') ? 'fill-1' : ''); ?>">settings</span>
                    <span class="text-sm">Configuración</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Bottom Actions -->
    <div class="px-4 py-8 border-t border-outline">
        <a href="https://wa.me/573000000000" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl text-on-surface-variant hover:bg-emerald-50 hover:text-[#006837] transition-all mb-2 group">
            <span class="material-symbols-outlined text-[22px] group-hover:scale-110 transition-transform">help</span>
            <span class="text-sm font-bold">Ayuda WhatsApp</span>
        </a>
        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-on-surface-variant hover:bg-red-50 hover:text-red-600 transition-all">
                <span class="material-symbols-outlined text-[22px]">logout</span>
                <span class="text-sm font-medium">Cerrar sesión</span>
            </button>
        </form>
    </div>
</aside>
<?php /**PATH /Users/mariapazpelaezrestrepo/Documents/Proyectos Desarrollapp/conduser/resources/views/layouts/sidebar.blade.php ENDPATH**/ ?>