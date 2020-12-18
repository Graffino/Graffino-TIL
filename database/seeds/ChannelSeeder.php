<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ChannelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Channel::class, 2)->create();
    }
}
