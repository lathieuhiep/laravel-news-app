<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'Create Post',
                'slug' => 'create_post',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Post',
                'slug' => 'edit_post',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Update Post',
                'slug' => 'update_post',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Post',
                'slug' => 'delete_post',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Restore Post',
                'slug' => 'restore_post',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Force Delete Post',
                'slug' => 'force_delete_post',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Review post',
                'slug' => 'review_post',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Create Users',
                'slug' => 'create_users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Edit Users',
                'slug' => 'edit_users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Update Users',
                'slug' => 'update_users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Delete Users',
                'slug' => 'delete_users',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
