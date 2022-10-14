<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $categories = \App\Models\Category::factory(25)->create();
        $users = \App\Models\User::factory(10)->create();
        $posts = \App\Models\Post::factory(100)->make()->each(function ($post) use ($users, $categories) {
            $post->user_id = $users->random()->id;
            $post->category_id = $categories->random()->id;
            $post->save();
        });

        $tags = \App\Models\Tag::factory(100)->create();
        $posts->each(function ($post) use ($tags) {
            $post->tags()->attach($tags->random(rand(5, 10))->pluck('id'));
        });

    }
}
