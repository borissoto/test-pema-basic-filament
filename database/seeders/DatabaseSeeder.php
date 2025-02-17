<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Organization;
use App\Models\User;
use App\UserType;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
               
        $this->call([
            UserSeeder::class,
            OrganizationSeeder::class,
            CompanySeeder::class,
            OrganizationUserSeeder::class,
        ]);
        
    }
}
