<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the dashboard based on user role
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        if ($user->isRoot()) {
            return redirect()->route('root.dashboard');
        } elseif ($user->isAdministrator()) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->isCollaborator()) {
            return redirect()->route('collaborator.dashboard');
        }

        return redirect('/login');
    }

    /**
     * Show root dashboard
     */
    public function root()
    {
        $this->authorize('root');
        
        $users = \App\Models\User::where('id', '!=', auth()->id())
            ->orderBy('created_at', 'desc')
            ->get();

        return view('dashboards.root', compact('users'));
    }

    /**
     * Show administrator dashboard
     */
    public function admin()
    {
        $this->authorize('administrator');
        
        return view('dashboards.admin');
    }

    /**
     * Show collaborator dashboard
     */
    public function collaborator()
    {
        $this->authorize('collaborator');
        
        return view('dashboards.collaborator');
    }
}
