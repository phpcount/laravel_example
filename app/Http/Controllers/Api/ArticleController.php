<?php

namespace App\Http\Controllers\Api;

use App\Handlers\LikeCounterHandle;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleController extends Controller
{
    public function __construct(private ArticleService $articleService)
    {
    }

    public function show(Request $request): JsonResource
    {
        return new ArticleResource($this->articleService->getArticleBySlug($request));
    }

    public function viewsIncrement(Request $request)
    {
        $article = $this->articleService->getArticleBySlug($request);
        $article->state->increment('views');

        return new ArticleResource($article);
    }

    public function likesIncrement(Request $request)
    {
        $article = $this->articleService->getArticleBySlug($request);

        $typeCounter = $request->get('type_counter');

        new LikeCounterHandle($article, $typeCounter);

        return new ArticleResource($article);
    }
}
