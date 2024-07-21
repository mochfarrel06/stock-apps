<?php

namespace App\Http\Controllers\Manajer\IncomingItem;

use App\Exports\IncomingExport;
use App\Http\Controllers\Controller;
use App\Models\IncomingItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class ManajerIncomingItemReportController extends Controller
{
    public function getFilteredData($startDate, $endDate)
    {
        if ($startDate && $endDate) {
            $endDate = Carbon::parse($endDate)->addDay()->format('Y-m-d');
            return IncomingItem::whereBetween('created_at', [$startDate, $endDate])->get();
        }

        return collect();
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $incomingItems = $this->getFilteredData($startDate, $endDate);

        return view('manajer.incoming-item.incoming-report.index', compact('incomingItems', 'startDate', 'endDate'));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $incomingItems = $this->getFilteredData($startDate, $endDate);

        $pdf = Pdf::loadView('manajer.incoming-item.incoming-report.exportPdf', compact('startDate', 'endDate', 'incomingItems'));
        return $pdf->download('laporan_data_barang.pdf');
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $incomingItems = $this->getFilteredData($startDate, $endDate);

        return Excel::download(new IncomingExport($incomingItems), 'laporan.xlsx');
    }
}
