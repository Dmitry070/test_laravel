<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Выполнить сидер для постов.
     */
    public function run(): void
    {
        Post::factory()->count(5)->create();
    }
}
