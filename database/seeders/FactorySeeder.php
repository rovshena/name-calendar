<?php

namespace Database\Seeders;

use App\Models\Message;
use Illuminate\Database\Seeder;

class FactorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Message::factory()->count(20)->create();
    }
}
