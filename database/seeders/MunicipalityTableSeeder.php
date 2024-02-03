<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class MunicipalityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = storage_path('app/municipality.csv');

        // Check if the CSV file exists
        if (!File::exists($csvFile)) {
            $this->command->error('The CSV file does not exist.');
            return;
        }

        // Read CSV file
        $municipalities = array_map('str_getcsv', file($csvFile));

        // Skip the header row
        array_shift($municipalities);

        // Insert data into the municipalities table
        foreach ($municipalities as $municipality) {
            DB::table('municipalities')->insert([
                'id' => $municipality[0],
                'province_id' => $municipality[1],
                'name' => $municipality[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Municipalities seeded successfully.');
    }
}
