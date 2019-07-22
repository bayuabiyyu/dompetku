<?php

namespace App;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'tanggal';
    protected $table = 'expense';
    protected $fillable = [
        'tanggal', 'user_id',
    ];

    public static function expenseDataTable($date){

        $data = DB::table('expense AS a')
                ->select('b.id', 'a.tanggal', 'c.nama_kategori', 'b.keterangan', 'b.nominal')
                ->join('expense_d AS b', 'a.tanggal', '=', 'b.tanggal')
                ->leftJoin('kategori AS c', 'b.kode_kategori', '=', 'c.kode_kategori')
                ->leftJoin('jenis AS d', 'c.kode_jenis', '=', 'd.kode_jenis')
                ->where('a.user_id', '=', Auth::user()->username)
                ->where('a.tanggal', '=', $date)
                ->where('c.kode_jenis', '=', 0)
                ->orderBy('a.tanggal', 'asc')
                ->get();
        return $data;

    }

}
