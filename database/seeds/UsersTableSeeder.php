<?php

use Carbon\Traits\Timestamp;
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
            'name' => 'Administrator',
            'photo' => 'admin.png',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin123')
        ]);
    }
}
