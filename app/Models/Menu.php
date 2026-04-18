<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menu';
    protected $fillable = ['user_id', 'tanggal', 'catatan', 'status'];

    // relasi dengan user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // relasi dengan menu_detail
    public function items()
    {
        return $this->belongsToMany(Item::class, 'menu_detail');
    }

    // relasi dengan ompreng melalui tabel pivot menu_ompreng
    public function omprengs()
    {
        return $this->hasMany(MenuOmpreng::class);
    }

    // relasi dengan menu_ompreng untuk mendapatkan detail ompreng
    public function detailOmpreng()
    {
        return $this->hasMany(MenuOmpreng::class);
    }
}
