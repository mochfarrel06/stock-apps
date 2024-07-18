<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class IncomingExport implements FromCollection, WithHeadings
{
    protected $incomingItems;

    public function __construct($incomingItems)
    {
        $this->incomingItems = $incomingItems;
    }

    public function collection()
    {
        return $this->incomingItems->map(function ($incomingItem, $index) {
            return [
                'No' => $index + 1,
                'kode_barang' => $incomingItem->item->item_code,
                'nama_barang' => $incomingItem->item->name,
                'tgl_masuk' => \Carbon\Carbon::parse($incomingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY'), // Mengambil nama barang dari relasi item_type
                'jumlah' => $incomingItem->quantity,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Tanggal Barang Masuk',
            'Jumlah Barang Masuk',
        ];
    }
}
