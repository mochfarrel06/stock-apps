<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomingItem extends Model
{
    use HasFactory;

    // Deklarasi nama tabel yang akan digunakan model ini di database
    protected $table = 'incoming_items';

    // Deklarasi primary key dari tabel 'items'
    protected $primaryKey = 'id';

    // Daftar atribut yang dapat diisi secara massal (mass asigment)
    protected $fillable = [
        'user_id',
        'item_id',
        'quantity',
        'created_at'
    ];

    /**
     * Mendefinisikan relasi "belongsTo" antara model saat ini dan model User.
     *
     * Relasi ini menunjukkan bahwa satu instance dari model ini adalah "milik"
     * dari satu instance dari model User. Dengan kata lain, model ini memiliki
     * foreign key yang mengacu pada primary key di model User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendefinisikan relasi "belongsTo" antara model saat ini dan model Item.
     *
     * Relasi ini menunjukkan bahwa satu instance dari model ini adalah "milik"
     * dari satu instance dari model Item. Dengan kata lain, model ini memiliki
     * foreign key yang mengacu pada primary key di model Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
