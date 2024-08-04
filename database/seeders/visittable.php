<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class visittable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Create an instance of the Faker class
        $Faker = Faker::create();
    
        $visit = [];
        // Set the date range to be within the current year
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now()->endOfYear();
        /*
        if you want data to be generated until the current date
         $endDate = Carbon::now(); */
    
        // Generate 20 random users
        for ($i = 1; $i <= 243; $i++) {
            $visitDate = $Faker->dateTimeBetween($startDate, $endDate);
            $visit[] = [
                'ip_address' => $Faker->ipv4,
                'visit_date' => $visitDate,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
    
        // Insert the random users into the users table
        DB::table('visits')->insert($visit);
    }
}
