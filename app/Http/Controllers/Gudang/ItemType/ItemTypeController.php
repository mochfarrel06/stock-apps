<?php

namespace App\Http\Controllers\Gudang\ItemType;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang\ItemType\ItemTypeCreateRequest;
use App\Models\ItemType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $itemTypes = ItemType::where('user_id', $userId)->get();

        return view('gudang.item-type.index', compact('itemTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('gudang.item-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemTypeCreateRequest $request)
    {
        try {
            $userId = Auth::id();

            // $itemTypes = $request->all();
            // $itemTypes['user_id'] = $userId;
            // ItemType::create($itemTypes);

            $itemTypes = new ItemType([
                'user_id' => $userId,
                'name' => $request->name,
            ]);

            $itemTypes->save();

            session()->flash('success', 'Berhasil menambahkan jenis barang');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses jenis barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $itemType = ItemType::findOrFail($id);
        return view('gudang.item-type.show', compact('itemType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
