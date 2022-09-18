<?php

namespace Database\Factories;

use App\Models\Article;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{

    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->sentence(4);
        $slug = Str::slug($title);

        return [
            'title' => $title,
            'slug' => $slug,
            'body' => $this->faker->paragraph(100),
            'img' => 'https://via.placeholder.com/600/5F113B/FFFFFF/?text=LARAVEL:9:VITE',
            'title' => $title,
            'published_at' => Carbon::now(),
            'created_at' => $this->faker->dateTimeBetween('-2 years')
        ];
    }
}
