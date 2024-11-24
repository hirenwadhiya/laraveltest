<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleSearchRequest;
use App\Http\Resources\ArticleCollection;
use App\Models\Article;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use function App\Helpers\failedResponse;
use function App\Helpers\successResponse;

class ArticleController extends Controller
{
    public function index(ArticleSearchRequest $request): JsonResponse
    {
        try {
            $articles = Article::with(['category:id,name', 'source:id,name'])
                ->when(isset($request->keyword), function (Builder $query) use ($request) {
                    $query->where('title', 'like', "%$request->keyword%");
                    $query->orWhere('description', 'like', "%$request->keyword%");
                })
                ->when(isset($request->category), function ($query) use ($request) {
                    $query->whereHas('category', function ($query) use ($request) {
                        $query->where('name', 'like', "%$request->category%");
                    });
                })
                ->when(isset($request->source), function ($query) use ($request) {
                    $query->whereHas('source', function ($query) use ($request) {
                        $query->where('name', 'like', "%$request->source%");
                    });
                })
                ->when(isset($request->date), function ($query) use ($request) {
                    $query->whereDate('published_at', $request->date);
                })
                ->paginate();
            return successResponse(__('message.article.list.success'), new ArticleCollection($articles));
        } catch (Exception $exception) {
            return failedResponse(__('message.article.list.failed'));
        }
    }
}
