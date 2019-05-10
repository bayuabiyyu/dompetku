<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'role' => 'root_admin',
        ]);
        $batas = 20;
        for ($i=0; $i < $batas ; $i++) {
            Admin::create([
                'name' => 'admin'.$i,
                'email' => 'admin'.$i.'@mail.com',
                'password' => bcrypt('password'),
                'role' => 'admin',
            ]);
        }
    }
}
