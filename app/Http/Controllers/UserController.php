<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\AuditLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role:root');
    }

    /**
     * Display a listing of users.
     */
    public function index(Request $request)
    {
        $users = User::where('id', '!=', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:administrador,colaborador',
            'status' => 'required|in:activo,inactivo',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $newUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'created',
            'model_type' => 'User',
            'model_id' => $newUser->id,
            'details' => "Creó un nuevo usuario: {$newUser->name} ({$newUser->role})",
        ]);

        return redirect()
            ->route('root.users.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    /**
     * Show the form for editing the specified user.
     */
    public function edit(User $user)
    {
        // Prevent root from editing themselves
        if ($user->id === Auth::id()) {
            return redirect()
                ->route('root.users.index')
                ->with('error', 'No puedes editar tu propio usuario.');
        }

        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // Prevent root from updating themselves
        if ($user->id === Auth::id()) {
            return redirect()
                ->route('root.users.index')
                ->with('error', 'No puedes actualizar tu propio usuario.');
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:8|confirmed',
            'role' => 'required|in:administrador,colaborador',
            'status' => 'required|in:activo,inactivo',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'status' => $request->status,
        ];

        // Only update password if provided
        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $user->update($updateData);

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model_type' => 'User',
            'model_id' => $user->id,
            'details' => "Actualizó al usuario: {$user->name}",
        ]);

        return redirect()
            ->route('root.users.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Prevent root from deleting themselves
        if ($user->id === Auth::id()) {
            return redirect()
                ->route('root.users.index')
                ->with('error', 'No puedes eliminar tu propio usuario.');
        }

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'deleted',
            'model_type' => 'User',
            'model_id' => $user->id,
            'details' => "Eliminó al usuario: {$user->name}",
        ]);

        $user->delete();

        return redirect()
            ->route('root.users.index')
            ->with('success', 'Usuario eliminado correctamente.');
    }

    /**
     * Toggle user status (active/inactive).
     */
    public function toggleStatus(User $user)
    {
        // Prevent root from toggling their own status
        if ($user->id === Auth::id()) {
            return redirect()
                ->route('root.users.index')
                ->with('error', 'No puedes cambiar tu propio estado.');
        }

        $user->status = $user->status === 'activo' ? 'inactivo' : 'activo';
        $user->save();

        $statusText = $user->status === 'activo' ? 'activado' : 'inactivado';

        AuditLog::create([
            'user_id' => Auth::id(),
            'action' => 'updated',
            'model_type' => 'User',
            'model_id' => $user->id,
            'details' => "Cambió el estado del usuario {$user->name} a {$user->status}",
        ]);

        return redirect()
            ->route('root.users.index')
            ->with('success', "Usuario {$statusText} correctamente.");
    }
}
