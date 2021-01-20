<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DeveloperSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Developer::factory()->count(1)->create();
    }
}
