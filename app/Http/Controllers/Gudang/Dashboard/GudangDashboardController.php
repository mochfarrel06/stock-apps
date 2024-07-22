<?php

namespace App\Http\Controllers\Gudang\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\DashboardRepositoryInterface;

class GudangDashboardController extends Controller
{
    protected $repository;

    // Dependency Injection
    public function __construct(DashboardRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $data = $this->repository->getDashboard();

        $cards = [
            ['title' => 'Data Barang', 'bg_color' => 'primary', 'value' => $data['itemCount'], 'icon' => 'fas fa-box'],
            ['title' => 'Barang Masuk', 'bg_color' => 'success', 'value' => $data['incomingCount'], 'icon' => 'fas fa-download'],
            ['title' => 'Barang Keluar', 'bg_color' => 'danger', 'value' => $data['outgoingCount'], 'icon' => 'fas fa-upload'],
            ['title' => 'Jenis Barang', 'bg_color' => 'info', 'value' => $data['itemType'], 'icon' => 'fas fa-cube'],
            ['title' => 'Satuan Barang', 'bg_color' => 'warning', 'value' => $data['unitType'], 'icon' => 'fas fa-folder']
        ];

        // Menampilkan pada view
        return view('gudang.dashboard.index', ['cards' => $cards, 'data' => $data['lowStockItems']]);
    }
}
