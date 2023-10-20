<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Admin::create([
            'name' => 'salah',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin'), // Replace 'admin' with the desired default password
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
