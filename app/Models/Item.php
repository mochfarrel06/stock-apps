<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    // Deklarasi nama tabel yang akan digunakan model ini di database
    protected $table = 'items';

    // Deklarasi primary key dari tabel 'items'
    protected $primaryKey = 'id';

    // Daftar atribut yang dapat diisi secara massal (mass asigment)
    protected $fillable = [
        'user_id',
        'item_type_id',
        'unit_type_id',
        'name',
        'item_code',
        'stock',
        'reorder_level',
        'price',
        'photo'
    ];
}
