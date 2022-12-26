<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 11; $i++) {
            DB::table('users_permissions')->insert([
                [
                    'user_id' => 1,
                    'permission_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }

        for ($i = 1; $i <= 8; $i++) {
            DB::table('users_permissions')->insert([
                [
                    'user_id' => 2,
                    'permission_id' => $i,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
        }

        DB::table('users_permissions')->insert([
            [
                'user_id' => 2,
                'permission_id' => 9,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'permission_id' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 3,
                'permission_id' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
