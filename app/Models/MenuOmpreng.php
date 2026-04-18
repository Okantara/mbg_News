<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MenuOmpreng extends Model
{
    use HasFactory;

    protected $table = 'menu_ompreng';

    protected $fillable = [
        'menu_id',
        'ompreng_id',
        'kategori_penerima',
        'jumlah',
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function ompreng()
    {
        return $this->belongsTo(Ompreng::class);
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}