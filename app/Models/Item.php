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
     * Mendefinisikan relasi "belongsTo" antara model saat ini dan model ItemType.
     *
     * Relasi ini menunjukkan bahwa satu instance dari model ini adalah "milik"
     * dari satu instance dari model ItemType. Dengan kata lain, model ini memiliki
     * foreign key yang mengacu pada primary key di model ItemType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function itemType()
    {
        return $this->belongsTo(ItemType::class);
    }

    /**
     * Mendefinisikan relasi "belongsTo" antara model saat ini dan model UnitType.
     *
     * Relasi ini menunjukkan bahwa satu instance dari model ini adalah "milik"
     * dari satu instance dari model UnitType. Dengan kata lain, model ini memiliki
     * foreign key yang mengacu pada primary key di model UnitType.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function unitType()
    {
        return $this->belongsTo(UnitType::class);
    }

    /**
     * Mendefinisikan relasi "hasMany" antara model saat ini dan model IncomingItem.
     *
     * Relasi ini menunjukkan bahwa satu instance dari model ini dapat memiliki banyak
     * instance dari model IncomingItem. Dengan kata lain, model ini adalah parent dari
     * banyak instance model IncomingItem.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function incomingItem()
    {
        return $this->hasMany(IncomingItem::class);
    }
}
