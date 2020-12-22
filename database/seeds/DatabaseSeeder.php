<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            \Database\Seeders\ChannelSeeder::class,
            \Database\Seeders\DeveloperSeeder::class,
            \Database\Seeders\PostSeeder::class,
        ]);
    }
}
