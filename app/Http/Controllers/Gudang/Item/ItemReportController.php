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

    public function getFilteredData($filter)
    {
        if ($filter === 'minimum') {
            return Item::whereColumn('stock', '<=', 'reorder_level')->get();
        } else if ($filter === 'all') {
            return Item::all();
        }

        return collect();
    }

    public function index(Request $request)
    {
        $filter = $request->input('filter');

        $items = $this->getFilteredData($filter);

        return view('gudang.item-report.index', compact('items', 'filter'));
    }

    public function exportPdf(Request $request)
    {
        $filter = $request->input('filter', '');
        $items = $this->getFilteredData($filter);
        $titlePdf = $filter === 'minimum' ? 'Laporan Stok Barang Minimum' : 'Laporan Semua Stok Barang';

        $pdf = Pdf::loadView('gudang.item-report.exportPdf', compact('items', 'filter', 'titlePdf'));

        return $pdf->download('laporan_data_barang.pdf');
    }

    public function exportExcel(Request $request)
    {
        $filter = $request->input('filter', ''); // Default to empty string if filter is not present

        if ($filter === 'minimum') {
            $items = Item::whereColumn('stock', '<=', 'reorder_level')->get();
        } elseif ($filter === 'all') {
            $items = Item::all();
        } else {
            $items = Item::all(); // Default case if no filter is selected
        }

        return Excel::download(new ItemExport($items), 'laporan_data_barang.xlsx');
    }
}
