<?php

namespace Database\Seeders;

use App\Models\Good;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Good::factory(50)->create();

        //factory(Good::class, 50)->create();

    }
}
