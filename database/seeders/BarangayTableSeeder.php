<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class BarangayTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $csvFile = storage_path('app/barangay.csv');

        // Check if the CSV file exists
        if (!File::exists($csvFile)) {
            $this->command->error('The CSV file does not exist.');
            return;
        }

        // Read CSV file
        $barangays = array_map('str_getcsv', file($csvFile));

        // Skip the header row
        array_shift($barangays);

        // Insert data into the barangays table
        foreach ($barangays as $barangay) {
            DB::table('barangays')->insert([
                'id' => $barangay[0],
                'municipality_id' => $barangay[1],
                'name' => $barangay[2],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('Barangays seeded successfully.');
    }
}
