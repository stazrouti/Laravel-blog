<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\categoriestable;
use Database\Seeders\poststable;
use Database\Seeders\Userseader;
use Database\Seeders\visittable;
use Database\Seeders\post_likes_table;
use Database\Seeders\AdminSeeder;
use Database\Seeders\CommentsSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call(categoriestable::class); 
        $this->call(poststable::class);
        $this->call(Userseader::class);
        $this->call(visittable::class);
        $this->call(post_likes_table::class);
        $this->call(AdminSeeder::class);
        $this->call(CommentsSeeder::class);

    }
}
