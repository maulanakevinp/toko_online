<?php

use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('images')->insert([
            'image'         => '1.jpg',
            'company_id'    => '1',
        ]);
        DB::table('images')->insert([
            'image'         => '2.jpg',
            'company_id'    => '1',
        ]);
        DB::table('images')->insert([
            'image'         => '3.jpg',
            'company_id'    => '1',
        ]);
    }
}
