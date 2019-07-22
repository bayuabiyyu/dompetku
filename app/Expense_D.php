<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense_D extends Model
{
    // public $incrementing = false;
    protected $table = 'expense_d';
    protected $fillable = [
        'tanggal', 'kode_kategori', 'keterangan', 'nominal'
    ];
}
