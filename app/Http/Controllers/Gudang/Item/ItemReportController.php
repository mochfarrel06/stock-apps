<?php

namespace App\Http\Controllers\Gudang\Item;

use App\Exports\ItemExport;
use App\Http\Controllers\Controller;
use App\Models\Item;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ItemReportController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter');

        $items = collect();

        if ($filter === 'minimum') {
            $items = Item::whereColumn('stock', '<=', 'reorder_level')->get();
        } elseif ($filter === 'all') {
            $items = Item::all();
        }

        return view('gudang.item-report.index', compact('items', 'filter'));
    }

    public function exportPdf(Request $request)
    {
        $filter = $request->input('filter');

        $items = collect();
        $titlePdf = '';

        if ($filter === 'minimum') {
            $items = Item::whereColumn('stock', '<=', 'reorder_level')->get();
            $titlePdf = 'Laporan Stok Barang Minimum';
        } elseif ($filter === 'all') {
            $items = Item::all();
            $titlePdf = 'Laporan Stok Barang';
        }

        $pdf = Pdf::loadView('gudang.item-report.exportPdf', compact('items', 'filter', 'titlePdf'));

        return $pdf->download('laporan_data_barang.pdf');
    }

    public function exportExcel(Request $request)
    {
        $filter = $request->input('filter', ''); // Default to empty string if filter is not present

        $query = Item::query();

        if ($filter === 'minimum') {
            $items = Item::whereColumn('stock', '<=', 'reorder_level')->get();
        } elseif ($filter === '') {
            $items = Item::all();
        }

        $items = $query->get();

        return Excel::download(new ItemExport($items), 'laporan_data_barang.xlsx');
    }
}
