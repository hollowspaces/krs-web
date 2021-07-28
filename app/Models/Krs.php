<?php

namespace App\Models;

use App\Models\KrsDetail;
use App\Models\Mahasiswa;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Krs extends Model
{
    use HasFactory;

    protected $table = 'krs';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kode',
        'mahasiswa_nim',
        'mahasiswa_kelas'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'mahasiswa_nim');
    }

    public function krsDetail()
    {
        return $this->hasMany(KrsDetail::class);
    }
}
