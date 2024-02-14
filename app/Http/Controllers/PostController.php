<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;

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
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function show($uuid)
    {
        try {
            $data = $this->postRepository->show($uuid);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function store(PostStoreRequest $request)
    {
        try {
            $data = $this->postRepository->store($request);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function update(PostUpdateRequest $request, $uuid)
    {
        try {
            $data = $this->postRepository->update($request, $uuid);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function destroy($uuid)
    {
        try {
            $data = $this->postRepository->destroy($uuid);
            return response()->json($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}