<?php

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->insert([
        //     'name' => Str::random(10),
        //     'email' => Str::random(10).'@gmail.com',
        //     'password' => bcrypt('secret'),
        // ]);
        $batas = 20;
        for ($i=0; $i < $batas ; $i++) {
            User::create([
                'username' => 'username'.$i,
                'name' => 'user'.$i,
                'email' => 'user'.$i.'@mail.com',
                'email_verified_at' => Carbon::now(),
                'password' => bcrypt('password')
            ]);
        }
    }
}
