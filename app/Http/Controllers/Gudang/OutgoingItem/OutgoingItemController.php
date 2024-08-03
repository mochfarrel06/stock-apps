<?php

namespace App\Http\Controllers\Gudang\OutgoingItem;

use App\Http\Controllers\Controller;
use App\Http\Requests\OutgoingItem\OutgoingItemCreateRequest;
use App\Models\Item;
use App\Models\OutgoingItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OutgoingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $outgoingItems = OutgoingItem::all();

        return view('gudang.outgoing-item.index', compact('outgoingItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();

        return view('gudang.outgoing-item.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OutgoingItemCreateRequest $request)
    {
        try {
            $userId = Auth::id();
            $item = Item::findOrFail($request->item_id);

            $quantity = $request->quantity;

            $outgoingItem = new OutgoingItem([
                'user_id' => $userId,
                'item_id' => $item->id,
                'quantity' => $quantity
            ]);

            $outgoingItem->save();

            $item->stock -= $quantity;
            $item->save();

            session()->flash('success', 'Berhasil menambahkan data barang keluar');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses data barang keluar: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $outgoingItem = OutgoingItem::findOrFail($id);
        $item = $outgoingItem->item;

        return view('gudang.outgoing-item.show', compact('outgoingItem', 'item'));
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
        try {
            $outgoingItem = OutgoingItem::findOrFail($id);
            $item = $outgoingItem->item;

            $item->stock += $outgoingItem->quantity;
            $item->save();

            $outgoingItem->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus barang keluar']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
