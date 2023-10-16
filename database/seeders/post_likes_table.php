<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
/* use Faker\Factory as Faker; */
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\post;
use App\Models\User;
use App\Models\PostLikes;

class post_likes_table extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Get the total likes from the posts table
        $totalLikes = Post::sum('likes');
    
        // Create an instance of the Faker class
        $faker = \Faker\Factory::create();
    
        $userIds = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();
    
        $postLikes = [];
    
        for ($i = 0; $i < $totalLikes; $i++) {
            $postLikes[] = [
                'user_id' => $faker->randomElement($userIds),
                'post_id' => $faker->randomElement($postIds),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
    
        // Insert the generated post likes into the database
        DB::table('post_likes')->insert($postLikes);
    }
    
    
}
