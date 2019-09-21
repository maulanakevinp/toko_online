<?php

use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types')->insert([
            'category_id' => 1,
            'type' => 'Sofa'
        ]);
        DB::table('types')->insert([
            'category_id' => 1,
            'type' => 'Tempat Duduk'
        ]);
        DB::table('types')->insert([
            'category_id' => 1,
            'type' => 'Tempat Penyimpanan'
        ]);
        DB::table('types')->insert([
            'category_id' => 2,
            'type' => 'Meja Kerja'
        ]);
        DB::table('types')->insert([
            'category_id' => 2,
            'type' => 'Kursi Kerja'
        ]);
        DB::table('types')->insert([
            'category_id' => 2,
            'type' => 'Tempat Penyimpanan'
        ]);
        DB::table('types')->insert([
            'category_id' => 3,
            'type' => 'Kursi'
        ]);
        DB::table('types')->insert([
            'category_id' => 3,
            'type' => 'Meja Makan'
        ]);
        DB::table('types')->insert([
            'category_id' => 3,
            'type' => 'Tempat Penyimpanan'
        ]);
        DB::table('types')->insert([
            'category_id' => 3,
            'type' => 'Dekorasi Rumah'
        ]);
        DB::table('types')->insert([
            'category_id' => 4,
            'type' => 'Tempat Tidur'
        ]);
        DB::table('types')->insert([
            'category_id' => 4,
            'type' => 'Kasur'
        ]);
        DB::table('types')->insert([
            'category_id' => 4,
            'type' => 'Tempat Penyimpanan'
        ]);
        DB::table('types')->insert([
            'category_id' => 4,
            'type' => 'Dekorasi Rumah'
        ]);
        DB::table('types')->insert([
            'category_id' => 5,
            'type' => 'Lampu'
        ]);
        DB::table('types')->insert([
            'category_id' => 5,
            'type' => 'Karpet'
        ]);
        DB::table('types')->insert([
            'category_id' => 5,
            'type' => 'Linen Rumah'
        ]);
        DB::table('types')->insert([
            'category_id' => 5,
            'type' => 'Hiasan'
        ]);
        DB::table('types')->insert([
            'category_id' => 5,
            'type' => 'Peralatan Rumah Tangga'
        ]);
        DB::table('types')->insert([
            'category_id' => 6,
            'type' => 'Lampu'
        ]);
        DB::table('types')->insert([
            'category_id' => 6,
            'type' => 'Karpet'
        ]);
        DB::table('types')->insert([
            'category_id' => 6,
            'type' => 'Hiasan'
        ]);
    }
}
