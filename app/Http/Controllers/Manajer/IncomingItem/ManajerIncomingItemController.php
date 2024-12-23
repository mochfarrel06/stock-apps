<?php

namespace App\Http\Controllers\Manajer\IncomingItem;

use App\Http\Controllers\Controller;
use App\Models\IncomingItem;
use Illuminate\Http\Request;

class ManajerIncomingItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $incomingItems = IncomingItem::all();

        return view('manajer.incoming-item.index', compact('incomingItems'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $incomingItem = IncomingItem::findOrFail($id);
        $item = $incomingItem->item;

        return view('manajer.incoming-item.show', compact('incomingItem', 'item'));
    }
}
