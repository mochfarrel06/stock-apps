<?php

namespace App\Http\Controllers\Gudang\Item;

use App\Http\Controllers\Controller;
use App\Http\Requests\Gudang\Item\ItemCreateRequest;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\UnitType;
use App\Traits\FileUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    use FileUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::all();
        return view('gudang.item.index', compact('items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $itemTypes = ItemType::all();
        $unitTypes = UnitType::all();

        return view('gudang.item.create', compact('itemTypes', 'unitTypes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ItemCreateRequest $request)
    {
        try {
            $itemType = ItemType::findOrFail($request->item_type_id);
            $unitType = UnitType::findOrFail($request->unit_type_id);
            $imagePath = $this->uploadImage($request, 'photo');

            $userId = Auth::id();

            $item = new Item([
                'user_id' => $userId,
                'item_type_id' => $itemType->id,
                'unit_type_id' => $unitType->id,
                'name' => $request->name,
                'item_code' => $request->item_code,
                'reorder_level' => $request->reorder_level,
                'price' => $request->price,
                'photo' => isset($imagePath) ? $imagePath : 'photo'
            ]);

            $item->save();

            session()->flash('success', 'Berhasil menambahkan data barang');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            // Log error dan tampilkan pesan error
            session()->flash('error', 'Terdapat kesalahan pada proses data barang: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $item = Item::findOrFail($id);
        $itemType = $item->itemType;
        $unitType = $item->unitType;

        return view('gudang.item.show', compact('item', 'itemType', 'unitType'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $item = Item::findOrFail($id);
        $itemTypes = ItemType::all();
        $unitTypes = UnitType::all();

        return view('gudang.item.edit', compact('item', 'itemTypes', 'unitTypes'));
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
