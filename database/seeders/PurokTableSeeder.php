<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PurokTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barangayId = 166802005;//LA PAZ ID

        // Purok names
        $purokNames = ['Purok 1', 'Purok 2', 'Purok 3', 'Purok 4', 'Purok 5', 'Purok 6', 'Purok 7', 'Purok 8'];

        // Insert data into the puroks table
        foreach ($purokNames as $index => $purokName) {
            DB::table('puroks')->insert([
                'id' => $index + 1,
                'barangay_id' => $barangayId,
                'name' => $purokName,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Puroks seeded successfully.');
    }
}
