<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleService
{
    public function getArticleBySlug(Request $request)
    {
        $slug = $request->get('slug');
        return Article::findBySlug($slug);
    }
}
