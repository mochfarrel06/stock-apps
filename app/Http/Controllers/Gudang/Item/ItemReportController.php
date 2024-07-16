<?php

namespace App\Http\Controllers\Gudang\Item;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemReportController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('gudang.item-report.index', compact('items'));
    }
}
