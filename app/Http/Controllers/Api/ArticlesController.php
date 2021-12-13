<?php

namespace App\Http\Controllers\Api;

use App\Filters\ArticleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlesImportRequest;
use App\Http\Requests\ArticlesRequest;
use App\Services\ArticlesImportService;
use App\Services\ArticlesService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ArticlesController extends Controller
{
    protected ArticlesImportService $articlesImportService;
    protected ArticlesService $articlesService;

    /**
     * @param ArticlesImportService $articlesImportService
     */
    public function __construct(
        ArticlesImportService $articlesImportService,
        ArticlesService       $articlesService
    )
    {
        $this->articlesImportService = $articlesImportService;
        $this->articlesService = $articlesService;
    }

    /**
     * @return JsonResponse
     */
    public function index(ArticleFilter $filter): JsonResponse
    {
        return response()->json(
            $this->articlesService->getArticles($filter)
        );
    }

    /**
     * @param ArticlesImportRequest $request
     * @return Response
     */
    public function import(ArticlesImportRequest $request)
    {
        $this->articlesImportService->import($request->file->getContent());
        return response([], 204);
    }
}
