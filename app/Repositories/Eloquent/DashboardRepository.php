<?php

namespace App\Repositories\Eloquent;

use App\Models\Item;
use App\Models\IncomingItem;
use App\Models\OutgoingItem;
use App\Models\ItemType;
use App\Models\UnitType;
use App\Models\User;
use App\Repositories\Contracts\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
    public function getDashboard()
    {
        return [
            'itemCount' => Item::count(),
            'incomingCount' => IncomingItem::count(),
            'outgoingCount' => OutgoingItem::count(),
            'itemType' => ItemType::count(),
            'unitType' => UnitType::count(),
            'lowStockItems' => Item::whereColumn('stock', '<=', 'reorder_level')->get(),
            'userGudangCount' => User::where('role', '=', 'Gudang')->count(),
            'userManajerCount' => User::where('role', '=', 'Manajer')->count(),
            'userAdminCount' => User::where('role', '=', 'Administrator')->count(),
        ];
    }
}
