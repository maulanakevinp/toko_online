<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'category' => 'Ruang Tamu',
            'photo' => 'interior-3530343_640.jpg'
        ]);

        DB::table('categories')->insert([
            'category' => 'Ruang Kerja',
            'photo' => 'interior-4154353_640.jpg'
        ]);

        DB::table('categories')->insert([
            'category' => 'Ruang Makan',
            'photo' => 'kitchen-4139216_640.jpg'
        ]);

        DB::table('categories')->insert([
            'category' => 'Kamar Tidur',
            'photo' => 'interior-3538020_640.jpg'
        ]);

        DB::table('categories')->insert([
            'category' => 'Dekorasi Rumah',
            'photo' => 'decoration-4130933_640.jpg'
        ]);

        DB::table('categories')->insert([
            'category' => 'Dekorasi Hotel & Restoran',
            'photo' => 'bath-4132300_640.png'
        ]);
    }
}
