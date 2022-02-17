<?php

namespace Database\Seeders;

use DateTime;
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
        $begin = now()->subDays(30);
        $end   = now();

        for($i = $begin; $i <= $end; $i->addDay()){
            \App\Models\Quote::factory(4)->create([
                'created_at' => $i->format("Y-m-d"),
                'updated_at' => $i->format("Y-m-d")
            ]);
        }
    }
}
