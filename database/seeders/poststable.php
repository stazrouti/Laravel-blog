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
        DB::table('posts')->truncate();
        
        $faker = Faker::create();

        foreach (range(1, 100) as $index) {
            // Generate a random category_id
            $category_id = rand(1, 10); // Adjust the range as needed

            DB::table('posts')->insert([
                'title' => $faker->sentence,
                'picture' => $faker->imageUrl($width = 640, $height = 480),
                'content' => $faker->text(1000),
                'category_id' => $category_id, // Add the category_id column
                'likes' => $faker->numberBetween(0, 500), // Random likes between 0 and 100
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }

}
