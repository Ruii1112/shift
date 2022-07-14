<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

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
            'first_name' => '管理者',
            'first_name_kana' => 'かんりしゃ',
            'last_name' => '管理者',
            'last_name_kana' => 'かんりしゃ',
            'birth' => '2022-1-1',
            'sex' => '男',
            'login_id' => '10000000',
            'password' => Hash::make('a10000000'),
            'admin_flg' => 1,
        ]);
    }
}
