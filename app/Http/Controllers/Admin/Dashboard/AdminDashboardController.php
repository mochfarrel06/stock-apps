<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\IncomingItem;
use App\Models\Item;
use App\Models\ItemType;
use App\Models\OutgoingItem;
use App\Models\UnitType;
use App\Models\User;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $itemCount = Item::all()->count();
        $incomingCount = IncomingItem::all()->count();
        $outgoingCount = OutgoingItem::all()->count();
        $itemType = ItemType::all()->count();
        $unitType = UnitType::all()->count();
        $userGudangCount = User::where('role', '=', 'Gudang')->count();
        $userManajerCount = User::where('role', '=', 'Manajer')->count();
        $userAdminCount = User::where('role', '=', 'Administrator')->count();

        $items = Item::whereColumn('stock', '<=', 'reorder_level')->get();

        $cards = [
            [
                'title' => 'Pengguna Gudang',
                'bg_color' => 'primary',
                'value' => $userGudangCount,
                'icon' => 'fas fa-solid fa-user'
            ],
            [
                'title' => 'Pengguna Manajer',
                'bg_color' => 'success',
                'value' => $userManajerCount,
                'icon' => 'fas fa-solid fa-user'
            ],
            [
                'title' => 'Pengguna Admin',
                'bg_color' => 'warning',
                'value' => $userAdminCount,
                'icon' => 'fas fa-solid fa-user'
            ],
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

        return view('administrator.dashboard.index', compact('cards', 'items'));
    }
}
