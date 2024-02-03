<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class RegionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = storage_path('app/region.csv');

        // Check if the CSV file exists
        if (!File::exists($csvFile)) {
            $this->command->error('The CSV file does not exist.');
            return;
        }

        // Read CSV file
        $regions = array_map('str_getcsv', file($csvFile));

        // Skip the header row
        array_shift($regions);

        // Insert data into the regions table
        foreach ($regions as $region) {
            DB::table('regions')->insert([
                'id' => $region[0],
                'name' => $region[1],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Regions seeded successfully.');

    }
}
