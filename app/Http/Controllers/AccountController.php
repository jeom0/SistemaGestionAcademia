<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;

class AccountController extends Controller
{
    public function index()
    {
        // For now, "Accounts" are just grouped associations from movements
        $accounts = Movement::select('associated_to', \DB::raw('SUM(CASE WHEN type = "ingreso" THEN amount ELSE -amount END) as balance'))
            ->whereNotNull('associated_to')
            ->groupBy('associated_to')
            ->get();
            
        return view('accounts.index', compact('accounts'));
    }
}
