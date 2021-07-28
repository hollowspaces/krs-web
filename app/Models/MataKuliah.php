<?php

namespace App\Models;

use App\Models\Kelas;
use App\Models\KrsDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MataKuliah extends Model
{
    use HasFactory;

    protected $table = 'mata_kuliah';
    protected $primaryKey = 'kode';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'kode',
        'kelas_id',
        'mata_kuliah',
        'waktu',
        'hari'
    ];
    protected $dates = [
        'waktu'
    ];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }

    public function krsDetail()
    {
        return $this->hasMany(KrsDetail::class);
    }
}
