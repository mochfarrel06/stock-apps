<?php

namespace App\Http\Controllers\Admin\UnitType;

use App\Http\Controllers\Controller;
use App\Http\Requests\UnitType\UnitTypeCreateRequest;
use App\Http\Requests\UnitType\UnitTypeUpdateRequest;
use App\Models\UnitType;
use Illuminate\Support\Facades\Auth;

class UnitTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $unitTypes = UnitType::all();
        return view('administrator.unit-type.index', compact('unitTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrator.unit-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitTypeCreateRequest $request)
    {
        try {
            $userId = Auth::id();

            $unitTypes = new UnitType([
                'user_id' => $userId,
                'name' => $request->name,
            ]);

            $unitTypes->save();

            session()->flash('success', 'Berhasil menambahkan satuan barang');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses satuan barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unitType = UnitType::findOrFail($id);
        return view('administrator.unit-type.show', compact('unitType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unitType = UnitType::findOrFail($id);
        return view('administrator.unit-type.edit', compact('unitType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitTypeUpdateRequest $request, string $id)
    {
        try {
            $unitType = UnitType::findOrFail($id);

            $unitTypes = $request->all();
            $unitType->fill($unitTypes);

            if ($unitType->isDirty()) {
                $unitType->update([
                    'name' => $request->name
                ]);

                session()->flash('success', "Berhasil melakukan perubahan data pada satuan barang");
                return response()->json(['success' => true], 200);
            } else {
                session()->flash('info', "Tidak melakukan perubahan data pada satuan barang");
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan data satuan barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $unitType = UnitType::findOrFail($id);

            $unitType->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus data pada satuan barang']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
