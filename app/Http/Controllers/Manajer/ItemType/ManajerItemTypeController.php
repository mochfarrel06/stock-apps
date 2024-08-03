<?php

namespace App\Http\Controllers\Manajer\ItemType;

use App\Http\Controllers\Controller;
use App\Models\ItemType;

class ManajerItemTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemTypes = ItemType::all();
        return view('manajer.item-type.index', compact('itemTypes'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $itemType = ItemType::findOrFail($id);
        return view('manajer.item-type.show', compact('itemType'));
    }
}
