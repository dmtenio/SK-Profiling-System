<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OfficialTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Official data
         $officialData = [
            [
                'barangay_id' => 166802005,
                'name' => 'Thalia Joyce B. Sapong',
                'position_id' => 1, // Assuming 1 is SK Chairperson
                'avatar' => null,
            ],
            [
                'barangay_id' => 166802005,
                'name' => 'Brylle Entegro',
                'position_id' => 2, // Assuming 2 is 1st Councilor
                'avatar' => null,
            ],
            [
                'barangay_id' => 166802005,
                'name' => 'Matthew Bohol',
                'position_id' => 3, // Assuming 3 is 2nd Councilor
                'avatar' => null,
            ],
            [
                'barangay_id' => 166802005,
                'name' => 'Simplest Marie Sapong',
                'position_id' => 4, // Assuming 4 is 3rd Councilor
                'avatar' => null,
            ],
            [
                'barangay_id' => 166802005,
                'name' => 'Rosbert Laurente',
                'position_id' => 5, // Assuming 5 is 4th Councilor
                'avatar' => null,
            ],
            [
                'barangay_id' => 166802005,
                'name' => 'Frances Karla Trishia Pacheco',
                'position_id' => 6, // Assuming 6 is 5th Councilor
                'avatar' => null,
            ],
            [
                'barangay_id' => 166802005,
                'name' => 'Judy Lacre',
                'position_id' => 7, // Assuming 7 is 6th Councilor
                'avatar' => null,
            ],
            [
                'barangay_id' => 166802005,
                'name' => 'John Glenn Sanggayan',
                'position_id' => 8, // Assuming 8 is 7th Councilor
                'avatar' => null,
            ],
            [
                'barangay_id' => 166802005,
                'name' => 'Seara Pacheco',
                'position_id' => 9, // Assuming 9 is Sk-Secretary
                'avatar' => null,
            ],
            [
                'barangay_id' => 166802005,
                'name' => 'Jean Lyka Orcullo',
                'position_id' => 10, // Assuming 10 is Sk-Treasurer
                'avatar' => null,
            ],
            // Add other officials here...
        ];

        // Insert data into the officials table
        foreach ($officialData as $official) {
            DB::table('officials')->insert($official);
        }

        $this->command->info('Officials seeded successfully.');

    }
}
