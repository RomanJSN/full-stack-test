<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticlesImportRequest;
use App\Services\ArticlesImportService;
use Illuminate\Http\Request;

class ArticlesController extends Controller
{
    public ArticlesImportService $articlesImportService;

   /**
   * @param ArticlesImportService $articlesImportService
   */
    public function __construct(ArticlesImportService $articlesImportService)
    {
      $this->articlesImportService = $articlesImportService;
    }

  /**
   * @param ArticlesImportRequest $request
   * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
   */
    public function import(ArticlesImportRequest $request)
    {
      $this->articlesImportService->import($request->file->getContent());
      return response([], 204);
    }
}
