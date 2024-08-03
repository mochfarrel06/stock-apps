<?php

namespace App\Http\Controllers\Admin\ItemType;

use App\Http\Controllers\Controller;
use App\Http\Requests\ItemType\ItemTypeCreateRequest;
use App\Http\Requests\ItemType\ItemTypeUpdateRequest;
use App\Models\ItemType;
use Illuminate\Support\Facades\Auth;

class ItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemTypes = ItemType::all();
        return view('administrator.item-type.index', compact('itemTypes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrator.item-type.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemTypeCreateRequest $request)
    {
        try {
            $userId = Auth::id();

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
        return view('administrator.item-type.show', compact('itemType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $itemType = ItemType::findOrFail($id);
        return view('administrator.item-type.edit', compact('itemType'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ItemTypeUpdateRequest $request, string $id)
    {
        try {
            $itemType = ItemType::findOrFail($id);

            $itemType->fill($request->all());

            if ($itemType->isDirty()) {
                $itemType->update([
                    'name' => $request->name,
                ]);

                session()->flash('success', "Berhasil melakukan perubahan data pada jenis barang");
                return response()->json(['success' => true], 200);
            } else {
                session()->flash('info', "Tidak melakukan perubahan data pada jenis barang");
                return response()->json(['info' => true], 200);
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan data jenis barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $itemType = ItemType::findOrFail($id);

            $itemType->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus data pada jenis barang']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
