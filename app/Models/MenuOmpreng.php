<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuOmpreng extends Model
{
    use HasFactory;

    protected $table = 'menu_ompreng';

    // Sesuaikan fillable dengan tabel menu_ompreng
    protected $fillable = [
        'menu_id',
        // 'kategori_penerima', // Hapus jika tidak ada di tabel
        'ompreng_id',
        'jumlah',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function ompreng()
    {
        return $this->belongsTo(Ompreng::class, 'ompreng_id');
    }
}