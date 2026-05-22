<?php

namespace App\Http\Controllers;

use App\Models\Movement;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function comisiones()
    {
        $comisiones = Movement::where('description', 'like', '%comisión%')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('payroll.comisiones', compact('comisiones'));
    }

    public function descuentos()
    {
        $descuentos = Movement::where('description', 'like', '%descuento%')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        
        return view('payroll.descuentos', compact('descuentos'));
    }
}
