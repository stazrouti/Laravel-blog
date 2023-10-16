<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
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
        // Truncate the post_likes table to start fresh
        DB::table('post_likes')->truncate();
    
        // Get all posts with their like counts
        $posts = Post::select('id', 'likes', 'created_at')->get();
    
        $userIds = User::pluck('id')->toArray();
        $postLikes = [];
        $faker = \Faker\Factory::create();
        $batchSize = 1000; // Adjust the batch size as needed
    
        foreach ($posts as $post) {
            $totalLikes = $post->likes;
            $createdAt = $post->created_at;
    
            for ($i = 0; $i < $totalLikes; $i++) {
                $postLikes[] = [
                    'user_id' => $faker->randomElement($userIds),
                    'post_id' => $post->id,
                    'created_at' => $faker->dateTimeBetween($createdAt, now()), // Random timestamp within post's creation date and now
                    'updated_at' => now(),
                ];
    
                // Insert rows in batches
                if (count($postLikes) === $batchSize) {
                    DB::table('post_likes')->insert($postLikes);
                    $postLikes = [];
                }
            }
        }
    
        // Insert any remaining rows
        if (!empty($postLikes)) {
            DB::table('post_likes')->insert($postLikes);
        }
    }
    
    
    
    
    
    
    
}
