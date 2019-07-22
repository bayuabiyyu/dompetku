<?php

namespace App;

use App\Kategori;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    public $incrementing = false;
    protected $table = 'jenis';
    protected $primaryKey = 'kode_jenis';
    protected $fillable = [
        'kode_jenis', 'nama_jenis',
    ];

}
