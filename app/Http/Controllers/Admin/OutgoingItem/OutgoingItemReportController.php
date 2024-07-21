<?php

namespace App\Http\Controllers\Admin\OutgoingItem;

use App\Exports\OutgoingExport;
use App\Http\Controllers\Controller;
use App\Models\OutgoingItem;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class OutgoingItemReportController extends Controller
{
    public function getFilteredData($startDate, $endDate)
    {
        if ($startDate && $endDate) {
            $endDate = Carbon::parse($endDate)->addDay()->format('Y-m-d');
            return OutgoingItem::whereBetween('created_at', [$startDate, $endDate])->get();
        }

        return collect();
    }

    public function index(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $outgoingItems = $this->getFilteredData($startDate, $endDate);

        return view('administrator.outgoing-report.index', compact('outgoingItems', 'startDate', 'endDate'));
    }

    public function exportPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $outgoingItems = $this->getFilteredData($startDate, $endDate);

        $pdf = Pdf::loadView('administrator.outgoing-report.exportPdf', compact('startDate', 'endDate', 'outgoingItems'));
        return $pdf->download('laporan_data_barang.pdf');
    }

    public function exportExcel(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $outgoingItems = $this->getFilteredData($startDate, $endDate);

        return Excel::download(new OutgoingExport($outgoingItems), 'laporan.xlsx');
    }
}
