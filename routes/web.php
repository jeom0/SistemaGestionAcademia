<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MovementController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuditController;
use App\Http\Controllers\PayrollController;

// Public routes
Route::get('/', function () {
    return redirect('/login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/password/reset', function() {
        return view('auth.passwords.email');
    })->name('password.request');
    Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Root routes
    Route::middleware(['role:root'])->prefix('root')->name('root.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'root'])->name('dashboard');
        
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        Route::patch('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle-status');
    });
    
    // Administrator routes
    Route::middleware(['role:administrador'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
    });
    
    // Collaborator routes
    Route::middleware(['role:colaborador'])->prefix('collaborator')->name('collaborator.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'collaborator'])->name('dashboard');
    });
    
    // Movement routes (accessible by administrator and collaborator)
    Route::middleware(['role:administrador,colaborador'])->group(function () {
        Route::get('/movements', [MovementController::class, 'index'])->name('movements.index');
        Route::get('/movements/create', [MovementController::class, 'create'])->name('movements.create');
        Route::post('/movements', [MovementController::class, 'store'])->name('movements.store');
        Route::get('/movements/{movement}/edit', [MovementController::class, 'edit'])->name('movements.edit');
        Route::put('/movements/{movement}', [MovementController::class, 'update'])->name('movements.update');
        Route::patch('/movements/{movement}/complete', [MovementController::class, 'markAsCompleted'])->name('movements.complete');
        Route::delete('/movements/{movement}', [MovementController::class, 'destroy'])->name('movements.destroy');
    });

    // Accounts & Reports
    Route::get('/accounts', [AccountController::class, 'index'])->name('accounts.index');
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');

    // Profile & Settings
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // Audit System
    Route::get('/audit', [AuditController::class, 'index'])->name('audit.index');

    // Payroll System
    Route::get('/comisiones', [PayrollController::class, 'comisiones'])->name('payroll.comisiones');
    Route::get('/descuentos', [PayrollController::class, 'descuentos'])->name('payroll.descuentos');

});
