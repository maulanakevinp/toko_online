<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'CV. Karya Xylo Abadi',
            'description' => 'Kami adalah perusahaan yang bergerak di bidang furniture yang dapat membantu anda mewujudkan design furniture yang anda harapkan , Setiap produk kami buat sendiri dengan penuh ketelitian, demi menjamin kualitas , sesuai dengan moto kami “ Make You’re design come true”',
            'bukalapak' => 'https://www.bukalapak.com/u/cvkaryaxyloabadi',
            'tokopedia' => 'https://www.tokopedia.com/xylomebel',
            'olx' => '',
            'whatsapp' => 'https://api.whatsapp.com/send?phone=6281380030690',
            'line' => 'http://nav.cx/9OYtRl4',
            'address' => 'Jl. Panggulan, Pengasinan, Kec. Sawangan, Kota Depok, Jawa Barat 16518.',
            'phone_number' => '0251-8414-950',
            'whatsapp_number' => '0813-8003-0690',
            'email' => 'karyaxyloabadi@gmail.com',
            'maps' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.712917680788!2d106.7536841658858!3d-6.430913341374765!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69e9e78f116aaf:0x4be6e7c62c74e2bd!2sCv.Karya+Xylo+Abadi!5e0!3m2!1sid!2sid!4v1563703326306!5m2!1sid!2sid',
            'testimonial' => 'Pelanggan kami mencintai kita! Baca apa yang mereka katakan di bawah ini.',
        ]);
    }
}
