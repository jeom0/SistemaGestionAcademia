@extends('layouts.app')

@section('page-title', 'Editar Movimiento')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>
        <i class="fas fa-edit"></i> Editar Movimiento
    </h2>
    <a href="{{ route('movements.index') }}" class="btn btn-outline-secondary">
        <i class="fas fa-arrow-left"></i> Volver
    </a>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">
                    <i class="fas fa-edit"></i> Editar Información del Movimiento
                </h5>
                <div>
                    <span class="badge bg-{{ $movement->type === 'ingreso' ? 'success' : 'danger' }}">
                        {{ ucfirst($movement->type) }}
                    </span>
                    <span class="badge bg-primary">
                        ${{ number_format($movement->amount, 2) }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <form action="{{ route('movements.update', $movement) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
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
                                        <option value="ingreso" {{ old('type', $movement->type) == 'ingreso' ? 'selected' : '' }}>
                                            <i class="fas fa-arrow-up"></i> Ingreso
                                        </option>
                                        <option value="egreso" {{ old('type', $movement->type) == 'egreso' ? 'selected' : '' }}>
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
                                       value="{{ old('amount', $movement->amount) }}" 
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
                                       value="{{ old('date', $movement->date->format('Y-m-d')) }}" 
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
                                       value="{{ old('associated_to', $movement->associated_to) }}" 
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
                                  required>{{ old('description', $movement->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Describe el motivo o detalle del movimiento (mínimo 3 caracteres).</small>
                    </div>
                    
                    <div class="alert alert-info">
                        <h6><i class="fas fa-info-circle"></i> Información del Movimiento</h6>
                        <div class="row">
                            <div class="col-md-6">
                                <p class="mb-1"><strong>ID:</strong> #{{ $movement->id }}</p>
                                <p class="mb-1"><strong>Registrado por:</strong> {{ $movement->user->name }}</p>
                                <p class="mb-0"><strong>Fecha de registro:</strong> {{ $movement->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="col-md-6">
                                <p class="mb-1"><strong>Última actualización:</strong> {{ $movement->updated_at->format('d/m/Y H:i') }}</p>
                                <p class="mb-0"><strong>Estado:</strong> <span class="badge bg-success">Activo</span></p>
                            </div>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('movements.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Cancelar
                        </a>
                        <div>
                            <form action="{{ route('movements.destroy', $movement) }}" 
                                  method="POST" 
                                  class="d-inline"
                                  onsubmit="return confirm('¿Estás seguro de eliminar este movimiento? Esta acción no se puede deshacer.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger me-2">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                            <button type="submit" class="btn btn-success">
                                <i class="fas fa-save"></i> Actualizar Movimiento
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-history"></i> Historial de Cambios
                </h6>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Creado:</strong><br>
                    <small class="text-muted">
                        {{ $movement->created_at->format('d/m/Y H:i') }}<br>
                        Por: {{ $movement->user->name }}
                    </small>
                </div>
                @if($movement->created_at != $movement->updated_at)
                    <div class="mb-0">
                        <strong>Última modificación:</strong><br>
                        <small class="text-muted">
                            {{ $movement->updated_at->format('d/m/Y H:i') }}<br>
                            Por: {{ auth()->user()->name }} (edición actual)
                        </small>
                    </div>
                @endif
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="mb-0">
                    <i class="fas fa-shield-alt"></i> Permisos de Edición
                </h6>
            </div>
            <div class="card-body">
                @if(auth()->user()->isCollaborator())
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes editar este movimiento (es tuyo)</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes eliminar este movimiento</small>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-times text-danger"></i>
                            <small>No puedes cambiar el tipo a ingreso</small>
                        </li>
                    </ul>
                @else
                    <ul class="list-unstyled mb-0">
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes editar cualquier campo</small>
                        </li>
                        <li class="mb-2">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes cambiar el tipo</small>
                        </li>
                        <li class="mb-0">
                            <i class="fas fa-check text-success"></i>
                            <small>Puedes eliminar este movimiento</small>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
        
        <div class="alert alert-warning mt-3">
            <h6><i class="fas fa-exclamation-triangle"></i> Advertencia</h6>
            <p class="mb-2">
                <strong>Al modificar este movimiento, se actualizará la fecha de última edición.</strong>
            </p>
            <p class="mb-0">
                <strong>Todos los cambios quedan registrados en el sistema.</strong>
            </p>
        </div>
        
        @if(!auth()->user()->isCollaborator())
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-chart-line"></i> Impacto en Estadísticas
                    </h6>
                </div>
                <div class="card-body">
                    <div class="mb-2">
                        <small class="text-muted">Tipo actual:</small><br>
                        <span class="badge bg-{{ $movement->type === 'ingreso' ? 'success' : 'danger' }}">
                            {{ ucfirst($movement->type) }}
                        </span>
                    </div>
                    <div class="mb-0">
                        <small class="text-muted">Monto actual:</small><br>
                        <strong class="text-{{ $movement->type === 'ingreso' ? 'success' : 'danger' }}">
                            ${{ number_format($movement->amount, 2) }}
                        </strong>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
