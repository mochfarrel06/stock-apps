<?php

namespace App\Http\Controllers\Manajer\UnitType;

use App\Http\Controllers\Controller;
use App\Models\UnitType;
use Illuminate\Http\Request;

class ManajerUnitTypeController extends Controller
{
    public function index()
    {
        $unitTypes = UnitType::all();

        return view('manajer.unit-type.index', compact('unitTypes'));
    }

    public function show(string $id)
    {
        // Mengambil data satuan barang berdasarkan ID. Jika tidak ditemukan, akan melempar exception.
        $unitType = UnitType::findOrFail($id);

        // Menampilkan view 'gudang.unit-type.show' dengan data $unitType
        return view('manajer.unit-type.show', compact('unitType'));
    }
}
