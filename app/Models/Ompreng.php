<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Menu;

class Ompreng extends Model
{
    use HasFactory;

    protected $table = 'ompreng';

    protected $fillable = [
        'user_id',
        'Kategori_penerima'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_ompreng')
            ->withPivot('jumlah')
            ->withTimestamps();
    }
}