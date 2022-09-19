<?php

namespace App\Handlers;

use App\Models\Article;

class LikeCounterHandle
{

    public function __construct(Article $article, string $typeCounter)
    {
        $state = $article->state;

        match($typeCounter) {
            'increment' => $state->increment('likes'),
            'decrement' => $state->decrement('likes')
        };
    }
}
