<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'Administrator',
            'photo' => 'admin.png',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123')
        ]);
    }
}
