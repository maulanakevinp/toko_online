<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([
            'name' => 'Sofa',
            'type_id' => '1',
            'photo1' => '259b26483c038f66161b7aeb0ac6d5b9.jpg',
            'price' => '2000000',
            'bukalapak' => 'htttps://www.bukalapak.com',
            'description' => 'Sofa paling empuk didunia'
        ]);
        DB::table('products')->insert([
            'name' => 'Meja Meeting Khusus',
            'type_id' => '4',
            'photo1' => 'a31f9c3c80ba014742ab7caa3f435397.jpg',
            'price' => '3500000',
            'bukalapak' => 'https://www.bukalapak.com',
            'tokopedia' => 'https://www.tokopedia.com',
            'olx' => 'https://www.olx.co.id',
            'description' => 'Meja ini merupakan meja panjang yang dapat menampung banyak orang dalam kondisi meeting atau rapat'
        ]);
        DB::table('products')->insert([
            'name' => 'Dekorasi Rumah Cantik',
            'type_id' => '22',
            'photo1' => '4f939bc880f638087dc43aca6262b983.jpg',
            'price' => '200000',
            'bukalapak' => 'https://www.bukalapak.com',
            'description' => 'rumah cantik adalah rumah yang banyak diminati orang jika anda ingin membuat rumah anda terlihat lebih cantik

silahkan hubungi kami.

Kami akan membuat rumah anda terlihat cantik dan senyaman mungkin'
        ]);
        DB::table('products')->insert([
            'name' => 'Spring Bed Empuk',
            'type_id' => '12',
            'photo1' => '115264fefb915d91c263457640efe521.png',
            'price' => '3000000',
            'olx' => 'https://www.olx.co.id',
            'description' => 'Spring bed ini merupakan spring bed terempuk yang pernah dibuat'
        ]);
        DB::table('products')->insert([
            'name' => 'Kasur',
            'type_id' => '12',
            'photo1' => '62c5ef536a85638b75deefe61d99eb7f.jpg',
            'price' => '2000000',
            'bukalapak' => 'https://www.bukalapak.com',
            'description' => 'Kasur nya gak atos tapi empuk'
        ]);
    }
}
