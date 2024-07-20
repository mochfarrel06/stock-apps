<?php

namespace App\Http\Controllers\Manajer\OutgoingItem;

use App\Http\Controllers\Controller;
use App\Models\OutgoingItem;
use Illuminate\Http\Request;

class ManajerOutgoingItemController extends Controller
{
    public function index()
    {
        $outgoingItems = OutgoingItem::all();

        return view('manajer.outgoing-item.index', compact('outgoingItems'));
    }

    public function show(string $id)
    {
        $outgoingItem = OutgoingItem::findOrFail($id);
        $item = $outgoingItem->item;

        return view('manajer.outgoing-item.show', compact('outgoingItem', 'item'));
    }
}
