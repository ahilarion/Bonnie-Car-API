<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleStoreRequest;
use App\Http\Requests\ArticleUpdateRequest;
use App\Http\Resources\ArticleResource;
use App\Repositories\ArticleRepository;

class ArticleController extends Controller
{
    private ArticleRepository $ArticleRepository;
    public function __construct(ArticleRepository $ArticleRepository)
    {
        $this->ArticleRepository = $ArticleRepository;
    }

    public function index()
    {
        try {
            $data = $this->ArticleRepository->index();
            return ArticleResource::collection($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function show($uuid)
    {
        try {
            $data = $this->ArticleRepository->show($uuid);
            return new ArticleResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function store(ArticleStoreRequest $request)
    {
        try {
            $data = $this->ArticleRepository->store($request);
            return new ArticleResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function update(ArticleUpdateRequest $request, $uuid)
    {
        try {
            $data = $this->ArticleRepository->update($request, $uuid);
            return new ArticleResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function destroy($uuid)
    {
        try {
            $this->ArticleRepository->destroy($uuid);
            return response()->json([
                'message' => 'Article deleted'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
