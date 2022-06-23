<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'first_name' => '井上',
            'first_name_kana' => 'いのうえ',
            'last_name' => '瑠威',
            'last_name_kana' => 'るい',
            'birth' => '1998-11-12',
            'sex' => '男',
            'login_id' => '10004929',
            'password' => 'a10004929',
        ]);
    }
}
