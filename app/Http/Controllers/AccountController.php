<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;

class AccountController extends Controller
{
    public function index()
    {
        // Obtener cuentas agrupadas con saldo consolidado
        $accounts = Movement::select('associated_to', \DB::raw('SUM(CASE WHEN type = "ingreso" THEN amount ELSE -amount END) as balance'))
            ->whereNotNull('associated_to')
            ->groupBy('associated_to')
            ->get();
            
        // Obtener movimientos de cada cuenta ordenados por fecha, cargando el usuario que lo registró
        $movementsGrouped = Movement::with('user')
            ->whereNotNull('associated_to')
            ->orderBy('date', 'desc')
            ->get()
            ->groupBy('associated_to');
            
        return view('accounts.index', compact('accounts', 'movementsGrouped'));
    }
}
