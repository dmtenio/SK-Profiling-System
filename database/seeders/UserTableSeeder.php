<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User data
        $userData = [
            [
                'name' => 'Dalimark M. Tenio',
                'position_id' => 1,
                'barangay_id' => 166802005,
                'account_type' => 'super_admin',
                'status' => 'active',
                'avatar' => null,
                'email' => 'dalimarktenio@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Thalia Joyce B. Sapong',
                'position_id' => 11,
                'barangay_id' => 166802005,
                'account_type' => 'municipal_admin',
                'status' => 'active',
                'avatar' => null,
                'email' => 'sthaliajoyce@gmail.com',
                'password' => bcrypt('password'),
            ],
            [
                'name' => 'Brylle Entegro',
                'position_id' => 2,
                'barangay_id' => 166802005,
                'account_type' => 'barangay_admin',
                'status' => 'active',
                'avatar' => null,
                'email' => 'brylleentegroangel@gmail.com',
                'password' => bcrypt('password'),
            ],
                
        ];

        // Insert data into the users table
        DB::table('users')->insert($userData);

        $this->command->info('User seeded successfully.');
    }
}
