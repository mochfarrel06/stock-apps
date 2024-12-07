<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return response()->json([
            'message' => "Data berhasil di tampilkan",
            'data' => $items
        ], 200);
    }
}
