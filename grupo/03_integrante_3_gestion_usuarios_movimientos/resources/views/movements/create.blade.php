@extends('layouts.app')

@section('page-title', 'Registrar Movimiento')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        <i class="fas fa-plus-circle"></i> 
        {{ auth()->user()->isCollaborator() ? 'Registrar Egreso' : 'Registrar Movimiento' }}
    </h2>
    <a href="{{ route('movements.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">
                    <i class="fas fa-plus-circle"></i> Información del Movimiento
                </h5>
            </div>
            <div class="card-body">
                <form action="{{ route('movements.store') }}" method="POST">
                    @csrf
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="type" class="form-label">
                                    <i class="fas fa-tag"></i> Tipo de Movimiento
                                </label>
                                @if(auth()->user()->isCollaborator())
                                    <input type="hidden" name="type" value="egreso">
                                    <div class="form-control bg-light">
                                        <i class="fas fa-arrow-down text-danger"></i> Egreso
                                        <small class="text-muted">(Solo puedes registrar egresos)</small>
                                    </div>
                                @else
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" 
                                            name="type" 
                                            required>
                                        <option value="">Selecciona tipo...</option>
                                        <option value="ingreso" {{ old('type') == 'ingreso' ? 'selected' : '' }}>
                                            <i class="fas fa-arrow-up"></i> Ingreso
                                        </option>
                                        <option value="egreso" {{ old('type') == 'egreso' ? 'selected' : '' }}>
                                            <i class="fas fa-arrow-down"></i> Egreso
                                        </option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="amount" class="form-label">
                                    <i class="fas fa-dollar-sign"></i> Monto ($)
                                </label>
                                <input type="number" 
                                       step="0.01" 
                                       min="0.01" 
                                       class="form-control @error('amount') is-invalid @enderror" 
                                       id="amount" 
                                       name="amount" 
                                       placeholder="0.00" 
                                       required>
                                @error('amount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Ingresa el monto con dos decimales.</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date" class="form-label">
                                    <i class="fas fa-calendar"></i> Fecha del Movimiento
                                </label>
                                <input type="date" 
                                       class="form-control @error('date') is-invalid @enderror" 
                                       id="date" 
                                       name="date" 
                                       value="{{ old('date', date('Y-m-d')) }}" 
                                       required>
                                @error('date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Fecha en que se realizó el movimiento.</small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="associated_to" class="form-label">
                                    <i class="fas fa-link"></i> Asociado a (Opcional)
                                </label>
                                <input type="text" 
                                       class="form-control @error('associated_to') is-invalid @enderror" 
                                       id="associated_to" 
                                       name="associated_to" 
                                       value="{{ old('associated_to') }}" 
                                       placeholder="Cliente, proveedor, servicio, etc.">
                                @error('associated_to')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Persona o entidad relacionada con el movimiento.</small>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label for="description" class="form-label">
                            <i class="fas fa-align-left"></i> Descripción
                        </label>
                        <textarea class="form-control @error('description') is-invalid @enderror" 
                                  id="description" 
                                  name="description" 
                                  rows="4" 
                                  placeholder="Describe detalladamente el movimiento..." 
                                  required>{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Describe el motivo o detalle del movimiento (mínimo 3 caracteres).</small>
                    </div>
                    
                    @if(!auth()->user()->isCollaborator())
                        <div class="alert alert-info">
                            <h6><i class="fas fa-info-circle"></i> Información del Registro</h6>
                            <p class="mb-0">
                                Este movimiento será registrado a nombre de <strong>{{ auth()->user()->name }}</strong> 
                                ({{ ucfirst(auth()->user()->role) }}) el {{ date('d/m/Y H:i') }}.
                            </p>
                        </div>
                    @endif
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('movements.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> 
                            {{ auth()->user()->isCollaborator() ? 'Registrar Egreso' : 'Registrar Movimiento' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-lightbulb"></i> Tips y Recomendaciones
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <h6 class="text-primary">
                        <i class="fas fa-arrow-up"></i> Ingresos
                    </h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Pagos de clientes</li>
                        <li><i class="fas fa-check text-success"></i> Ventas de productos</li>
                        <li><i class="fas fa-check text-success"></i> Servicios prestados</li>
                        <li><i class="fas fa-check text-success"></i> Inversiones recibidas</li>
                    </ul>
                </div>
                
                <div class="mb-0">
                    <h6 class="text-danger">
                        <i class="fas fa-arrow-down"></i> Egresos
                    </h6>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-check text-success"></i> Compras de suministros</li>
                        <li><i class="fas fa-check text-success"></i> Pago de servicios</li>
                        <li><i class="fas fa-check text-success"></i> Gastos operativos</li>
                        <li><i class="fas fa-check text-success"></i> Salarios y honorarios</li>
                    </ul>
                </div>
            </div>
        </div>
        
        @if(auth()->user()->isCollaborator())
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle"></i> Tu Permisos
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes registrar egresos propios</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes ver tus movimientos</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes editar tus movimientos</small>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-times text-danger"></i>
                            <small>No puedes registrar ingresos</small>
                        </li>
                    </ul>
                </div>
            </div>
        @else
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-shield-alt"></i> Tus Permisos
                    </h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes registrar ingresos y egresos</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes ver todos los movimientos</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes editar cualquier movimiento</small>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes eliminar movimientos</small>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        
        <div class="alert alert-warning mt-3">
            <h6><i class="fas fa-exclamation-triangle"></i> Importante</h6>
            <p class="mb-0">
                <strong>Todos los movimientos quedan registrados con tu nombre y fecha de registro.</strong><br>
                Mantén la información precisa y actualizada.
            </p>
        </div>
    </div>
</div>
@endsection
