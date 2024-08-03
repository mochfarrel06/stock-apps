<?php

namespace App\Http\Controllers\Manajer\UnitType;

use App\Http\Controllers\Controller;
use App\Models\UnitType;
use Illuminate\Http\Request;

class ManajerUnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitTypes = UnitType::all();
        return view('manajer.unit-type.index', compact('unitTypes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unitType = UnitType::findOrFail($id);
        return view('manajer.unit-type.show', compact('unitType'));
    }
}
