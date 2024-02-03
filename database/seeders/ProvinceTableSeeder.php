<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProvinceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = storage_path('app/province.csv');

        // Check if the CSV file exists
        if (!File::exists($csvFile)) {
            $this->command->error('The CSV file does not exist.');
            return;
        }

        // Read CSV file
        $provinces = array_map('str_getcsv', file($csvFile));

        // Skip the header row
        array_shift($provinces);

        // Insert data into the provinces table
        foreach ($provinces as $province) {
            DB::table('provinces')->insert([
                'id' => $province[0],
                'region_id' => $province[1],
                'name' => $province[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Provinces seeded successfully.');
    }
}
