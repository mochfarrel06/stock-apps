<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OutgoingExport implements FromCollection, WithHeadings
{
    protected $outgoingItems;

    public function __construct($outgoingItems)
    {
        $this->outgoingItems = $outgoingItems;
    }

    public function collection()
    {
        return $this->outgoingItems->map(function ($outgoingItem, $index) {
            return [
                'No' => $index + 1,
                'kode_barang' => $outgoingItem->item->item_code,
                'nama_barang' => $outgoingItem->item->name,
                'tgl_keluar' => \Carbon\Carbon::parse($outgoingItem->created_at)->locale('id')->isoFormat('D MMMM YYYY'), // Mengambil nama barang dari relasi item_type
                'jumlah' => $outgoingItem->quantity,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Tanggal Barang Keluar',
            'Jumlah Barang Keluar',
        ];
    }
}
