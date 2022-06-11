<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                "name" => "Admin",
                "email" => "admin@email.com",
                "password" => Hash::make('admin1234'),
                "superadmin" => 1
            ]
        );
    }
}
