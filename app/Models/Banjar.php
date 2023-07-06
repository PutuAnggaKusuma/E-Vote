<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banjar extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama'
    ];

    public function user() {
        return $this->hasMany(User::class, 'id_banjars','id');
    }

    public function penduduk() {
        return $this->hasMany(Penduduk::class, 'id_banjars','id');
    }
}
