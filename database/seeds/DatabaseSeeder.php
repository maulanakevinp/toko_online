<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            TestimonialSeeder::class,
            PhotoSeeder::class,
            CompanySeeder::class,
            CategorySeeder::class,
            TypeSeeder::class,
            ProductSeeder::class,
        ]);
    }
}
