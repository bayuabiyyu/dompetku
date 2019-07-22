<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Income_D extends Model
{
    // public $incrementing = false;
    protected $table = 'income_d';
    protected $fillable = [
        'tanggal', 'kode_kategori', 'keterangan', 'nominal'
    ];

}
