<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MovementController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of movements.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Base query
        $query = Movement::with('user');
        
        // Collaborators can only see their own movements
        if ($user->isCollaborator()) {
            $query->where('user_id', $user->id);
        }
        
        // Apply filters
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        if ($request->filled('date_from')) {
            $query->whereDate('date', '>=', $request->date_from);
        }
        
        if ($request->filled('date_to')) {
            $query->whereDate('date', '<=', $request->date_to);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        $movements = $query->orderBy('date', 'desc')->get();
        
        return view('movements.index', compact('movements'));
    }

    /**
     * Show the form for creating a new movement.
     */
    public function create()
    {
        $user = Auth::user();
        
        // Collaborators can only create expenses
        $canCreateIncome = $user->isAdministrator();
        
        return view('movements.create', compact('canCreateIncome'));
    }

    /**
     * Store a newly created movement in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        
        // Validation rules
        $rules = [
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'associated_to' => 'nullable|string|max:255',
            'description' => 'required|string|min:3|max:1000',
            'type' => 'required|in:ingreso,egreso',
        ];
        
        // Collaborators can only create expenses
        if ($user->isCollaborator()) {
            $rules['type'] = 'required|in:egreso';
        }
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $movement = Movement::create([
            'amount' => $request->amount,
            'type' => $request->type,
            'status' => $request->status ?? 'completado',
            'date' => $request->date,
            'associated_to' => $request->associated_to,
            'description' => $request->description,
            'user_id' => $user->id,
        ]);

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'created',
            'model_type' => 'Movement',
            'model_id' => $movement->id,
            'details' => "Registró un {$request->type} (" . ($request->status ?? 'completado') . ") de $" . number_format($request->amount, 2),
        ]);

        $message = $request->type === 'ingreso' ? 'Ingreso' : 'Egreso';
        
        return redirect()
            ->route('movements.index')
            ->with('success', "{$message} registrado correctamente.");
    }

    /**
     * Show the form for editing the specified movement.
     */
    public function edit(Movement $movement)
    {
        $user = Auth::user();
        
        // Collaborators can only edit their own movements
        if ($user->isCollaborator() && $movement->user_id !== $user->id) {
            abort(403, 'No tienes permisos para editar este movimiento.');
        }
        
        // Collaborators can only edit expenses
        $canEditType = $user->isAdministrator();
        
        return view('movements.edit', compact('movement', 'canEditType'));
    }

    /**
     * Update the specified movement in storage.
     */
    public function update(Request $request, Movement $movement)
    {
        $user = Auth::user();
        
        // Collaborators can only edit their own movements
        if ($user->isCollaborator() && $movement->user_id !== $user->id) {
            abort(403, 'No tienes permisos para actualizar este movimiento.');
        }
        
        // Validation rules
        $rules = [
            'amount' => 'required|numeric|min:0.01',
            'date' => 'required|date',
            'associated_to' => 'nullable|string|max:255',
            'description' => 'required|string|min:3|max:1000',
        ];
        
        // Only administrators can change the type
        if ($user->isAdministrator()) {
            $rules['type'] = 'required|in:ingreso,egreso';
        } else {
            // Collaborators can only have expenses
            $request->merge(['type' => 'egreso']);
        }
        
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = [
            'amount' => $request->amount,
            'date' => $request->date,
            'associated_to' => $request->associated_to,
            'description' => $request->description,
        ];
        
        // Only update type if user is administrator
        if ($user->isAdministrator()) {
            $updateData['type'] = $request->type;
        }

        $movement->update($updateData);

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'updated',
            'model_type' => 'Movement',
            'model_id' => $movement->id,
            'details' => "Actualizó el movimiento #{$movement->id} (Nuevos datos: $" . number_format($movement->amount, 2) . ")",
        ]);

        return redirect()
            ->route('movements.index')
            ->with('success', 'Movimiento actualizado correctamente.');
    }

    /**
     * Remove the specified movement from storage.
     */
    public function destroy(Movement $movement)
    {
        $user = Auth::user();
        
        // Collaborators can only delete their own movements
        if ($user->isCollaborator() && $movement->user_id !== $user->id) {
            abort(403, 'No tienes permisos para eliminar este movimiento.');
        }

        AuditLog::create([
            'user_id' => $user->id,
            'action' => 'deleted',
            'model_type' => 'Movement',
            'model_id' => $movement->id,
            'details' => "Eliminó un {$movement->type} de $" . number_format($movement->amount, 2),
        ]);

        $movement->delete();

        return redirect()
            ->route('movements.index')
            ->with('success', 'Movimiento eliminado correctamente.');
    }

    /**
     * Mark movement as completed.
     */
    public function markAsCompleted(Movement $movement)
    {
        $movement->update(['status' => 'completado']);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model_type' => 'Movement',
            'model_id' => $movement->id,
            'details' => "Marcó el movimiento #{$movement->id} como completado.",
        ]);

        return back()->with('success', 'Movimiento marcado como completado.');
    }
}
