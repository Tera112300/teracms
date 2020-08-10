<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'UserName',
            'email' => 'User@mailaddress.com',
            'password' => bcrypt('password'),
            'user_status' => '管理者',
        ]);
    }
}
