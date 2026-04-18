<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Operasional extends Model
{
    protected $table = 'operasional';
    protected $fillable = [
        'user_id',
        'tanggal',
        'keterangan',
        'biaya_operasional',
        'total_biaya',
    ];
    // relasi dengan model User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
