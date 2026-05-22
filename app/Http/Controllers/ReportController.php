<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;

class ReportController extends Controller
{
    public function index()
    {
        $ingresos = Movement::where('type', 'ingreso')->sum('amount');
        $egresos = Movement::where('type', 'egreso')->sum('amount');
        $balance = $ingresos - $egresos;
        
        $recentMovements = Movement::orderBy('date', 'desc')->take(10)->get();
        
        return view('reports.index', compact('ingresos', 'egresos', 'balance', 'recentMovements'));
    }
}
