<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
//needed 
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;
use Carbon\Carbon;
use Illuminate\Support\Str; 


class categoriestable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        //empty the database
        DB::table('categories')->truncate();
        $faker = Faker::create();
        $n=10;
        foreach (range(1, 20) as $index) {
            //to generate custom sentence
            $name = Str::limit($faker->sentence, $n);
            DB::table('categories')->insert([
                'name' => $faker->word,
                'description' => $faker->paragraph,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
