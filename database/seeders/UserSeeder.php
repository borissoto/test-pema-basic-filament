<?php

namespace Database\Seeders;

use App\Models\User;
use App\UserType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'admin@ex.io')->first();

        if($user){
            $user->update(['type' => UserType::ADMIN->value]);
        }else{    
            User::factory()->create([
                'name' => 'Test User',
                'email' => 'admin@ex.io',
                'password' => bcrypt('asdf'),
                'type' => UserType::ADMIN->value
            ]);            
        }
        
        User::factory(20)->staff()->create();
        User::factory(200)->client()->create();
    }
}
