<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Item;

class Kategori extends Model
{
    protected $table = 'kategori';

    protected $fillable = [
        'nama_kategori',
    ];

    // // Relasi benar: kategori -> item
    public function items()
    {
        return $this->hasMany(Item::class);
    }
}