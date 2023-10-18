<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;




class Userseader extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create an instance of the Faker class
        $Faker = Faker::create();
    
        $users = [];
    
        // Generate 20 random users
        for ($i = 1; $i <= 20; $i++) {
            $users[] = [
                'name' => $Faker->name,
                'email' => $Faker->unique()->safeEmail,
                'password' => Hash::make('password'), // Replace 'password' with the desired default password
                'last_visit' => Carbon::now(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    
        // Insert the random users into the users table
        DB::table('users')->insert($users);
    }
    
}
