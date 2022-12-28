<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->upsert([
            [
                'user_id' => 1,
                'title' => 'Hello world!',
                'slug' => 'hello-world',
                'content' => 'Welcome to Laravel. This is your first post. Edit or delete it, then start writing!',
                'status' => 'publish',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ], 'slug');
    }
}
