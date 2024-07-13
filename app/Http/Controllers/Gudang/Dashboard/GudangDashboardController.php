<?php

namespace App\Http\Controllers\Gudang\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GudangDashboardController extends Controller
{
    public function index()
    {
        return view('gudang.dashboard.index');
    }
}
