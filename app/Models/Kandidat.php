<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kandidat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nomor_pasangan','nama_kepala','nama_wakil_kepala','foto','visi','misi','id_voting'
    ];

    public function voting() {
        return $this->hasMany(Voting::class, 'id_kandidats','id');
    }
}
