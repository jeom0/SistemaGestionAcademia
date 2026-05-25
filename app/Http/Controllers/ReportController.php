<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use App\Models\AuditLog;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Movement::query();
        
        // 1. Rango de Fechas
        if ($request->filled('from_date')) {
            $query->where('date', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->where('date', '<=', $request->to_date);
        }
        
        // 2. Cuenta / Entidad Asociada
        if ($request->filled('account')) {
            $query->where('associated_to', $request->account);
        }
        
        // Calcular los totales de ingresos, egresos y balance neto de la consulta filtrada
        $ingresos = (clone $query)->where('type', 'ingreso')->sum('amount');
        $egresos = (clone $query)->where('type', 'egreso')->sum('amount');
        $balance = $ingresos - $egresos;
        
        // Obtener movimientos ordenados por fecha
        $movements = $query->orderBy('date', 'desc')->get();
        
        // Obtener la lista única de cuentas asociadas para el selector de filtros
        $accounts = Movement::select('associated_to')
            ->whereNotNull('associated_to')
            ->distinct()
            ->pluck('associated_to');
            
        // Obtener bitácora de trazabilidad
        $auditLogs = AuditLog::with('user')->orderBy('created_at', 'desc')->get();
        
        return view('reports.index', compact('ingresos', 'egresos', 'balance', 'movements', 'accounts', 'auditLogs'));
    }
}
