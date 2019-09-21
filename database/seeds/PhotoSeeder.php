<?php

use Illuminate\Database\Seeder;

class PhotoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('photos')->insert([
            'photo1' => '1.jpg',
            'photo2' => '2.jpg',
            'photo3' => '3.jpg',
            'photo4' => '',
            'photo5' => '',
            'photo6' => ''
        ]);

        DB::table('photos')->insert([
            'photo1' => '115264fefb915d91c263457640efe521.png',
            'photo2' => '',
            'photo3' => '',
            'photo4' => '',
            'photo5' => '',
            'photo6' => ''
        ]);

        DB::table('photos')->insert([
            'photo1' => '259b26483c038f66161b7aeb0ac6d5b9.jpg',
            'photo2' => 'c4b2dc6cc00bc79ebd06b30571f758ad.png',
            'photo3' => '5929079b3e37ffc99efe4a0b5e3332d1.png',
            'photo4' => '',
            'photo5' => '',
            'photo6' => ''
        ]);

        DB::table('photos')->insert([
            'photo1' => '4c6accbea9c48789be9cddef7870cc4c.jpg',
            'photo2' => 'c6dc9e323d3363832d781f2683adf71e.jpg',
            'photo3' => 'a84e128fc564aee239a38a36bf702859.jpg',
            'photo4' => 'cb97e9bc663dac9836dc7cf4466939e4.png',
            'photo5' => '148095519ef67a48037958e18eb9a58d.png',
            'photo6' => ''
        ]);

        DB::table('photos')->insert([
            'photo1' => '4f939bc880f638087dc43aca6262b983.jpg',
            'photo2' => '',
            'photo3' => 'bca964f224c9c584b5c263642dc6b98c.jpg',
            'photo4' => '',
            'photo5' => '',
            'photo6' => 'f9085f248f2fd1eeccab855cd4e20b39.jpg'
        ]);

        DB::table('photos')->insert([
            'photo1' => '62c5ef536a85638b75deefe61d99eb7f.jpg',
            'photo2' => '',
            'photo3' => '',
            'photo4' => '',
            'photo5' => '',
            'photo6' => ''
        ]);

        DB::table('photos')->insert([
            'photo1' => '939664b4216042f434f49362f2f86254.jpg',
            'photo2' => '5e4f1cff6229a7659ea8041357cca275.png',
            'photo3' => '41677ea4029422bb8f5f38c658fed007.jpg',
            'photo4' => '',
            'photo5' => '',
            'photo6' => ''
        ]);

        DB::table('photos')->insert([
            'photo1' => 'a31f9c3c80ba014742ab7caa3f435397.jpg',
            'photo2' => 'e557f0bd33b7bd013f4cb6601c76007d.jpg',
            'photo3' => '',
            'photo4' => '',
            'photo5' => '',
            'photo6' => ''
        ]);
    }
}
