<?php

namespace App\Models;
use App\Models\Kategori;
use App\Models\Menu;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    protected $fillable = [
        'kategori_id',
        'kategori_nama',
        'nama_item',
    ];

    // Relasi ke Kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    // Relasi ke Menu melalui tabel pivot menu_detail
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_detail');
    }
}
