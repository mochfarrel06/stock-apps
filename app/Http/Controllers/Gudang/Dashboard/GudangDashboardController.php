<?php

namespace App\Http\Controllers\Gudang\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\IncomingItem;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\OutgoingItem;
use App\Models\UnitType;

class GudangDashboardController extends Controller
{
    /**
     * Metode untuk menampilkan jumlah data barang, barang masuk, barang keluar,
     * jenis barang, dan satuan barang. Lalu terdapat tabel untuk menampilkan stok
     * minimum barang
     */
    public function index()
    {
        // Variabel untuk menghitung semua data barang
        $itemCount = Item::all()->count();

        // Variabel untuk menghitung semua data barang masuk
        $incomingCount = IncomingItem::all()->count();

        // Variabel untuk menghitung semua data barang keluar
        $outgoingCount = OutgoingItem::all()->count();

        // Variael untuk menghitung semua jenis data barang
        $itemType = ItemType::all()->count();

        // Variabel untuk menghitung semua satuan barang
        $unitType = UnitType::all()->count();

        /**
         * Menampilkan stok barang minimum
         *
         * Jadi pada variabel items ini akan mengambil kolom
         * stok dari tabel barang lalu membuat query stock
         * kurang dari stok minimum
         *
         */
        $items = Item::whereColumn('stock', '<=', 'reorder_level')->get();

        // Menampilkan data pada card
        $cards =
            [
                [
                    'title' => 'Data Barang',
                    'bg_color' => 'primary',
                    'value' => $itemCount,
                    'icon' => 'fas fa-box'
                ],
                [
                    'title' => 'Barang Masuk',
                    'bg_color' => 'success',
                    'value' => $incomingCount,
                    'icon' => 'fas fa-download'
                ],
                [
                    'title' => 'Barang Keluar',
                    'bg_color' => 'danger',
                    'value' => $outgoingCount,
                    'icon' => 'fas fa-upload'
                ],
                [
                    'title' => 'Jenis Barang',
                    'bg_color' => 'info',
                    'value' => $itemType,
                    'icon' => 'fas fa-cube'
                ],
                [
                    'title' => 'Satuan Barang',
                    'bg_color' => 'warning',
                    'value' => $unitType,
                    'icon' => 'fas fa-folder'
                ]
            ];

        // Menampilkan pada view
        return view('gudang.dashboard.index', compact('cards', 'items'));
    }
}
