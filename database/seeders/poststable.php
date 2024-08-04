<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;

class poststable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Empty the database
        // Uncomment this line if you want to truncate the table before seeding
        // DB::table('posts')->truncate();
        
        $faker = Faker::create();
        $postLikes = [];
        
        // Set the date range to be within the current year
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now()->endOfYear();

        foreach (range(1, 100) as $index) {
            // Generate a random category_id
            $category_id = rand(1, 10); // Adjust the range as needed
            
            // Generate a random creation date within the year
            $create_date = $faker->dateTimeBetween($startDate, $endDate);

            DB::table('posts')->insert([
                'title' => $faker->sentence,
                'picture' => $faker->imageUrl($width = 640, $height = 480),
                'content' => $faker->text(1000),
                'category_id' => $category_id, // Add the category_id column
                'likes' => $faker->numberBetween(0, 500), // Random likes between 0 and 500
                'created_at' => $create_date, // Pass the DateTime object directly
                'updated_at' => Carbon::now(),
            ]);
        }
/*   
to fill the db with data until the current date
public function run()
    {
        // Empty the database
        // Uncomment this line if you want to truncate the table before seeding
        // DB::table('posts')->truncate();
        
        $faker = Faker::create();
        $postLikes = [];
        
        // Set the date range to be within the current year
        $startDate = Carbon::now()->startOfYear();
        $endDate = Carbon::now();

        foreach (range(1, 100) as $index) {
            // Generate a random category_id
            $category_id = rand(1, 10); // Adjust the range as needed
            
            // Generate a random creation date within the year
            $create_date = $faker->dateTimeBetween($startDate, $endDate);

            DB::table('posts')->insert([
                'title' => $faker->sentence,
                'picture' => $faker->imageUrl($width = 640, $height = 480),
                'content' => $faker->text(1000),
                'category_id' => $category_id, // Add the category_id column
                'likes' => $faker->numberBetween(0, 500), // Random likes between 0 and 500
                'created_at' => $create_date, // Pass the DateTime object directly
                'updated_at' => Carbon::now(),
            ]);
        } */
    }
}

