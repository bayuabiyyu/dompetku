<?php

use App\Expense;
use App\Expense_D;
use Illuminate\Database\Seeder;

class Kategori extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Expense::create([
            'tanggal' => '2019-07-04',
            'user_id' => 'username0',
        ]);
        Expense_D::create([
            'tanggal' => '2019-07-04',
            'kode_kategori' => '0',
            'keterangan' => 'testing1',
            'nominal' => 10000,
        ]);
        Expense_D::create([
            'tanggal' => '2019-07-04',
            'kode_kategori' => '0 ',
            'keterangan' => 'testing2',
            'nominal' => 10000,
        ]);
    }
}
