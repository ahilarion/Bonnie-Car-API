<?php

namespace Database\Seeders;

use App\Models\API\Post;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            $user->posts()->createMany(
                Post::factory()
                    ->count(5)
                    ->make()
                    ->toArray()
            );
        }
    }
}
