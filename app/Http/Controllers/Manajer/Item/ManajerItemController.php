<?php

namespace App\Http\Controllers\Manajer\Item;

use App\Http\Controllers\Controller;
use App\Models\Item;

class ManajerItemController extends Controller
{
    public function index()
    {
        $items = Item::all();
        return view('manajer.item.index', compact('items'));
    }

    public function show(string $id)
    {
        $item = Item::findOrFail($id);
        $itemType = $item->itemType;
        $unitType = $item->unitType;

        return view('manajer.item.show', compact('item', 'itemType', 'unitType'));
    }
}
