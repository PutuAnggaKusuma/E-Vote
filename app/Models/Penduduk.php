<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penduduk extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama','tanggal_lahir','KTP','KK','jenis_kelamin','agama', 'no_telp','id_banjars'
    ];

    public function banjar() {
        return $this->belongsTo(Banjar::class, 'id_banjars','id');
    }

    public function voting() {
        return $this->hasMany(Voting::class, 'id_penduduks','id');
    }

    public function token() {
        return $this->hasMany(Token::class, 'id_penduduks','id');
    }
}
