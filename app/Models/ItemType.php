<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemType extends Model
{
    use HasFactory;

    // Deklarasi nama tabel yang akan digunakan model ini di database
    protected $table = 'item_types';

    // Deklarasi primary key dari tabel 'item_types'
    protected $primaryKey = 'id';

    // Daftar atribut yang dapat diisi secara massal (mass asigment)
    protected $fillable = [
        'user_id',
        'name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
