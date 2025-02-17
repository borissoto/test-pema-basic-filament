<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Organization;
use App\Models\User;
use App\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $organizations = Organization::all();

        for ($i = 0; $i < 30; $i++) {
            $user_id = User::where('type', UserType::CLIENT)
                ->whereNotIn('id', Company::pluck('user_id')->toArray()) 
                ->inRandomOrder()
                ->first()
                ->id;

            $organization_id = $organizations->random()->id;

            Company::create([
                'name' => 'Company ' . ($i + 1),  
                'organization_id' => $organization_id,  
                'user_id' => $user_id,  
            ]);
        }
       
    }
}
