<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KegiatanTendik extends Model
{
    use HasFactory;
    protected $table = 'tbkegiatan';
    public $timestamps = false;
    protected $fillable = [
        'kegNip',
        'kegTgl',
        'kegTendik',
        'kegSaranKatu',
        'kegSaranKepsek',
        'terakhirInput'
    ];
}
