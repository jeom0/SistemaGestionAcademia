<?php $__env->startSection('title', 'Acceso Denegado'); ?>

<?php $__env->startSection('content'); ?>
<div class="login-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card">
                    <div class="card-body text-center py-5">
                        <div class="mb-4">
                            <i class="fas fa-ban fa-5x text-danger"></i>
                        </div>
                        
                        <h1 class="display-4 text-danger mb-3">403</h1>
                        <h3 class="mb-3">Acceso Denegado</h3>
                        
                        <p class="text-muted mb-4">
                            No tienes los permisos necesarios para acceder a esta página.
                        </p>
                        
                        <div class="alert alert-warning text-start">
                            <h6><i class="fas fa-exclamation-triangle"></i> Posibles razones:</h6>
                            <ul class="mb-0">
                                <li>No has iniciado sesión en el sistema</li>
                                <li>Tu rol de usuario no tiene acceso a esta función</li>
                                <li>La página requiere permisos especiales que no posees</li>
                                <li>Tu cuenta de usuario está inactiva</li>
                            </ul>
                        </div>
                        
                        <div class="d-flex justify-content-center gap-2">
                            <?php if(auth()->check()): ?>
                                <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-primary">
                                    <i class="fas fa-home"></i> Ir al Dashboard
                                </a>
                                <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline">
                                    <?php echo csrf_field(); ?>
                                    <button type="submit" class="btn btn-outline-danger">
                                        <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                                    </button>
                                </form>
                            <?php else: ?>
                                <a href="<?php echo e(route('login')); ?>" class="btn btn-primary">
                                    <i class="fas fa-sign-in-alt"></i> Iniciar Sesión
                                </a>
                                <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-success">
                                    <i class="fas fa-user-plus"></i> Registrarse
                                </a>
                            <?php endif; ?>
                        </div>
                        
                        <div class="mt-4">
                            <small class="text-muted">
                                Si crees que esto es un error, contacta al administrador del sistema.
                            </small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/mariapazpelaezrestrepo/Documents/Proyectos Desarrollapp/conduser/resources/views/errors/403.blade.php ENDPATH**/ ?>