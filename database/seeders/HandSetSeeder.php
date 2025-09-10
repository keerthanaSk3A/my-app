<?php

namespace Database\Seeders;

use App\Models\HandSet;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HandSetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HandSet::factory(20)->create();
    }
}
