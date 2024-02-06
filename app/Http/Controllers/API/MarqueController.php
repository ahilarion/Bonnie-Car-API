<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\MarqueStoreRequest;
use App\Http\Requests\API\MarqueUpdateRequest;
use App\Http\Resources\API\MarqueResource;
use App\Repositories\API\MarqueRepository;
use Illuminate\Http\JsonResponse;

class MarqueController extends Controller
{
    private MarqueRepository $marqueRepository;
    public function __construct(MarqueRepository $marqueRepository)
    {
        $this->marqueRepository = $marqueRepository;
    }

    public function index()
    {
        try {
            $data = $this->marqueRepository->index();

            return MarqueResource::collection($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function show($marque)
    {
        try {
            $data = $this->marqueRepository->show($marque);
            return new MarqueResource($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function store(MarqueStoreRequest $request)
    {
        try {
            $data = $this->marqueRepository->store($request->all());

            return response()->json([
                'message' => 'Marque created successfully',
                'data' => new MarqueResource($data)
            ], 201);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function update(MarqueUpdateRequest $request, $marque)
    {
        try {
            $data = $this->marqueRepository->update($request->all(), $marque);

            return response()->json([
                'message' => 'Marque updated successfully',
                'data' => new MarqueResource($data)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    public function destroy($marque)
    {
        try {
            $this->marqueRepository->destroy($marque);

            return response()->json([
                'message' => 'Marque deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }
}
