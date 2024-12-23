<?php

namespace App\Http\Controllers\Admin\IncomingItem;

use App\Http\Controllers\Controller;
use App\Http\Requests\IncomingItem\IncomingItemCreateRequest;
use App\Models\IncomingItem;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IncomingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomingItems = IncomingItem::all();

        return view('administrator.incoming-item.index', compact('incomingItems'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $items = Item::all();

        return view('administrator.incoming-item.create', compact('items'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(IncomingItemCreateRequest $request)
    {
        try {
            $userId = Auth::id();
            $item = Item::findOrFail($request->item_id);

            $quantity = $request->quantity;

            $incomingItem = new IncomingItem([
                'user_id' => $userId,
                'item_id' => $item->id,
                'quantity' => $quantity
            ]);

            $incomingItem->save();

            $item->stock += $quantity;
            $item->save();

            session()->flash('success', 'Berhasil menambahkan data barang masuk');
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            session()->flash('error', 'Terdapat kesalahan pada proses data barang masuk: ' . $e->getMessage());
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $incomingItem = IncomingItem::findOrFail($id);
        $item = $incomingItem->item;

        return view('administrator.incoming-item.show', compact('incomingItem', 'item'));
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
            $incomingItem = IncomingItem::findOrFail($id);
            $item = $incomingItem->item;

            $item->stock -= $incomingItem->quantity;
            $item->save();

            $incomingItem->delete();

            return response(['status' => 'success', 'message' => 'Berhasil menghapus data barang masuk']);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
