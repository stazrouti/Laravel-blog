<?php 
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Post;

class CommentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Initialize Faker
        $faker = Faker::create();

        // Get all users and posts
        $userIds = User::pluck('id')->toArray();
        $postIds = Post::pluck('id')->toArray();

        // Number of comments to create
        $numComments = 200; // Adjust the number as needed

        $comments = [];

        foreach (range(1, $numComments) as $index) {
            $comments[] = [
                'user_id' => $faker->randomElement($userIds),
                'post_id' => $faker->randomElement($postIds),
                'body' => $faker->text(200), // Adjust text length as needed
                'created_at' => $faker->dateTimeBetween('-1 year', 'now'), // Random date within the past year
                'updated_at' => now(),
            ];

            // Insert rows in batches
            if (count($comments) === 100) { // Adjust batch size if needed
                DB::table('comments')->insert($comments);
                $comments = [];
            }
        }

        // Insert any remaining rows
        if (!empty($comments)) {
            DB::table('comments')->insert($comments);
        }
    }
}
