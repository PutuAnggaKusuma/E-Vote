<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'token','penggunaan','id_penduduks', 'use_date'
    ];

    public function penduduk() {
        return $this->belongsTo(Penduduk::class, 'id_penduduks','id');
    }
}
