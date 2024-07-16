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
     * Boot the model
     *
     * Untuk membuat data tidak duplikat
     *
     */
    public static function boot()
    {
        parent::boot();

        // Menambahkan logika sebelum data di buat
        self::creating(function ($model) {
            if (self::where('name', $model->name)->exists()) {
                throw new \Exception('Nama jenis barang sudah di tambahkan');
            }
        });

        // Menambahkan logika sebelum data diperbarui
        self::updating(function ($model) {
            if (self::where('name', $model->name)->where('id', '!=', $model->id)->exists()) {
                throw new \Exception('Nama jenis barang sudah di tambahkan');
            }
        });
    }

    /**
     * Mendefinisikan relasi "hasMany" antara model saat ini dan model Item.
     *
     * Relasi ini menunjukkan bahwa satu instance dari model ini dapat memiliki banyak
     * instance dari model Item. Dengan kata lain, model ini adalah parent dari
     * banyak instance model Item.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */

    public function item()
    {
        return $this->hasMany(Item::class);
    }
}
