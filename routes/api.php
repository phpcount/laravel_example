<?php

use App\Http\Controllers\Api\{ArticleController, CommentController};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('article')->group(function () {
    Route::get('/', [ ArticleController::class, 'show' ]);
    Route::put('/views/inc', [ ArticleController::class, 'viewsIncrement' ]);
    Route::put('/likes/inc', [ ArticleController::class, 'likesIncrement' ]);
    Route::post('/comment/add', [ CommentController::class, 'store' ]);
});

Route::fallback(fn() => abort(404));
