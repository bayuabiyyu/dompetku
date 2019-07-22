<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    private static $tabel = 'kategori';
    public $incrementing = false;
    protected $table = 'kategori';
    protected $primaryKey = 'kode_kategori';
    protected $fillable = [
        'kode_kategori', 'nama_kategori', 'kode_jenis', 'user_id',
    ];

    public static function getKategoriDataTable(){
        $data = DB::table(self::$tabel)
                ->join('jenis', 'kategori.kode_jenis', '=', 'jenis.kode_jenis')
                ->get();
        return $data;
    }

}
