<?php

namespace App\Models;

use App\Models\Krs;
use App\Models\KrsDetail;
use App\Models\MataKuliah;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KrsDetail extends Model
{
    use HasFactory;

    protected $table = 'krs_detail';
    public $timestamps = false;
    protected $fillable = [
        'krs_kode',
        'mata_kuliah_kode'
    ];

    public function krs()
    {
        return $this->belongsTo(Krs::class, 'krs_kode');
    }

    public function mataKuliah()
    {
        return $this->belongsTo(MataKuliah::class, 'mata_kuliah_kode');
    }

    public function krsDetail()
    {
        return $this->hasMany(KrsDetail::class);
    }
}
