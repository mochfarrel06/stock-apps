<?php

namespace App\Http\Controllers\Manajer\ItemType;

use App\Http\Controllers\Controller;
use App\Models\ItemType;
use Illuminate\Http\Request;

class ManajerItemTypeController extends Controller
{
    public function index()
    {
        // Mengambil semua data jenis barang
        $itemTypes = ItemType::all();

        // Menampilkan view dengan data jenis barang
        return view('manajer.item-type.index', compact('itemTypes'));
    }

    public function show(string $id)
    {
        // Mengambil data jenis barang berdasarkan ID. Jika tidak ditemukan, akan melempar exception.
        $itemType = ItemType::findOrFail($id);

        // Menampilkan view 'gudang.item-type.show' dengan data $itemType
        return view('manajer.item-type.show', compact('itemType'));
    }
}
