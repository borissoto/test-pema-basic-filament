<?php

namespace Database\Seeders;

use App\Models\Organization;
use App\Models\User;
use App\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrganizationUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $organizations = Organization::all();
        $staffUsers = User::where('type', UserType::STAFF)->get();

        foreach ($organizations as $org) {
            $org->users()->attach($staffUsers->random(5));
        }
    }
}
