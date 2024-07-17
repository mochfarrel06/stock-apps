<?php

namespace App\Exports;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ItemExport implements FromCollection, WithHeadings
{
    protected $items;

    public function __construct($items)
    {
        $this->items = $items;
    }

    public function collection()
    {
        return $this->items->map(function ($item, $index) {
            return [
                'No' => $index + 1,
                'kode_barang' => $item->item_code,
                'nama_barang' => $item->name,
                'jenis_barang' => $item->itemType->name, // Mengambil nama barang dari relasi item_type
                'stok' => $item->stock == 0 ? 0 : $item->stock,
                'satuan' => $item->unitType->name,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Jenis Barang',
            'Stok',
            'Satuan',
        ];
    }
}
