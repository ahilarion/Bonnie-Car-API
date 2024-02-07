<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\ArticleStoreRequest;
use App\Http\Requests\API\ArticleUpdateRequest;
use App\Http\Resources\API\ArticleResource;
use App\Repositories\API\ArticleRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ArticleController extends Controller
{
    private ArticleRepository $ArticleRepository;

    /**
     *
     * @throws Exception
     */
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
            $data = $this->ArticleRepository->store($request->all());

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
            $data = $this->ArticleRepository->update($request->all(), $uuid);

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
                'message' => 'Article deleted successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}

