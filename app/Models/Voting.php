<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voting extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_penduduks','id_kandidats', 'created_at'
    ];

    public function penduduk() {
        return $this->belongsTo(Penduduk::class, 'id_penduduks','id');
    }

    public function kandidat() {
        return $this->belongsTo(Kandidat::class, 'id_kandidats','id');
    }
}
