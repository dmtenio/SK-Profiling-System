<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
                // Position names
                $positionNames = [
                    'SK Chairperson',
                    '1st Councilor',
                    '2nd Councilor',
                    '3rd Councilor',
                    '4th Councilor',
                    '5th Councilor',
                    '6th Councilor',
                    '7th Councilor',
                    'SK-Secretary',
                    'SK-Treasurer',
                    'SK Fed President',

                ];
        
                // Insert data into the positions table
                foreach ($positionNames as $index => $positionName) {
                    DB::table('positions')->insert([
                        'id' => $index + 1,
                        'name' => $positionName,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
        
                $this->command->info('Positions seeded successfully.');
    }
}
