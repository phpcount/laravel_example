<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\{User, Article, Comment, State, Tag};
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
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $tags = Tag::factory(10)->create();

        $articles = Article::factory(20)->create();

        $tags_id = $tags->pluck('id');

        $articles->each(function ($article) use ($tags_id) {
            $article->tags()->attach($tags_id->random(3));

            Comment::factory(3)->create([
                'article_id' => $article->id
            ]);

            State::factory(1)->create([
                'article_id' => $article->id
            ]);
        });

    }
}
