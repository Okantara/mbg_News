<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Belanja extends Model
{
    protected $table = 'belanja';

    protected $fillable = [
        'user_id',
        'tanggal',
        'supplier',
        'pengeluaran_belanja',
        'total_belanja'
    ];
    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}