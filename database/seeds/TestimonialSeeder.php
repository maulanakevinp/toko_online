<?php

use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('testimonials')->insert([
            'name' => 'Ozzy - OZ',
            'description' => 'Harga terjangkau, pelayanan baik,  kalo deket free ongkir kalo pengiriman luar kota kt ownernya kena biaya.',
            'photo' => '30f99340ebff65ffe83d3d44dca476bc.png'
        ]);

        DB::table('testimonials')->insert([
            'name' => 'Imam Soeviyan',
            'description' => 'Furnitur yg dihasilkan sangat memuaskan, mantap gan',
            'photo' => '22e27e872303a2518e1ee8f758f287b5.png'
        ]);
    }
}
