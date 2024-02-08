<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\PostResource;
use App\Repositories\API\PostRepository;
use App\Http\Requests\API\PostStoreRequest;
use App\Http\Requests\API\PostUpdateRequest;

class PostController extends Controller
{
    private PostRepository $postRepository;
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }


    public function index()
    {
        try {
            $data = $this->postRepository->index();

            return PostResource::collection($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function lastPost()
    {
        try {
            $data = $this->postRepository->lastPost();

            return PostResource::collection($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function show($model)
    {
        try {
            $data = $this->postRepository->show($model);
            return new PostResource($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function store(PostStoreRequest $request)
    {
        try {
            $data = $this->postRepository->store($request);

            return response()->json([
                'message' => 'Model created successfully',
                'data' => new PostResource($data)
            ], 201);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function update(PostUpdateRequest $request, $model)
    {
        try {
            $data = $this->postRepository->update($request, $model);

            return response()->json([
                'message' => 'Model updated successfully',
                'data' => new PostResource($data)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy($model)
    {
        try {
            $this->postRepository->destroy($model);

            return response()->json([
                'message' => 'Model deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
