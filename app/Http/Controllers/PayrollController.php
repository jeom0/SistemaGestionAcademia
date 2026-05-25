<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movement;
use Illuminate\Support\Facades\Auth;

class PayrollController extends Controller
{
    /**
     * Display a listing of comisiones.
     */
    public function comisiones()
    {
        $user = Auth::user();
        
        // Find movements related to commissions
        $query = Movement::where('description', 'like', '%Comisión%')
                         ->orWhere('description', 'like', '%Bono%')
                         ->orderBy('date', 'desc');
                         
        if (!$user->isRoot()) {
            $query->where('user_id', $user->id);
        }
        
        $comisiones = $query->paginate(15);
        
        return view('payroll.comisiones', compact('comisiones'));
    }

    /**
     * Display a listing of descuentos.
     */
    public function descuentos()
    {
        $user = Auth::user();
        
        // Find movements related to discounts
        $query = Movement::where('description', 'like', '%Descuento%')
                         ->orWhere('description', 'like', '%Deducción%')
                         ->orderBy('date', 'desc');
                         
        if (!$user->isRoot()) {
            $query->where('user_id', $user->id);
        }
        
        $descuentos = $query->paginate(15);
        
        return view('payroll.descuentos', compact('descuentos'));
    }
}
