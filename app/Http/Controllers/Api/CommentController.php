<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CommentStoreRequest;
use App\Jobs\AddComment;
use Illuminate\Http\Response;

class CommentController extends Controller
{
    public function store(CommentStoreRequest $request)
    {
        AddComment::dispatch($request['subject'], $request['body'], $request['article_id']);

        return response()->json(
            ["status" => "success"],
            Response::HTTP_CREATED
        );
    }
}
