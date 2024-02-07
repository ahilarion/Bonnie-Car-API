<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleMarqueStoreRequest;
use App\Http\Requests\API\VehicleMarqueUpdateRequest;
use App\Http\Resources\API\VehicleMarqueResource;
use App\Repositories\API\VehicleMarqueRepository;
use Symfony\Component\HttpFoundation\Response;

class VehicleMarqueController extends Controller
{
    private VehicleMarqueRepository $vehicleMarqueRepository;
    public function __construct(VehicleMarqueRepository $vehicleMarqueRepository)
    {
        $this->vehicleMarqueRepository = $vehicleMarqueRepository;
    }

    public function index()
    {
        try {
            $data = $this->vehicleMarqueRepository->index();

            return response()->json([
                'data' => VehicleMarqueResource::collection($data)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function show($marque)
    {
        try {
            $data = $this->vehicleMarqueRepository->show($marque);

            return response()->json([
                'data' => new VehicleMarqueResource($data)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function store(VehicleMarqueStoreRequest $request)
    {
        try {
            $data = $this->vehicleMarqueRepository->store($request->all());

            return response()->json([
                'message' => 'Marque created successfully',
                'data' => new VehicleMarqueResource($data)
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function update(VehicleMarqueUpdateRequest $request, $marque)
    {
        try {
            $data = $this->vehicleMarqueRepository->update($request->all(), $marque);

            return response()->json([
                'message' => 'Marque updated successfully',
                'data' => new VehicleMarqueResource($data)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function destroy($marque)
    {
        try {
            $this->vehicleMarqueRepository->destroy($marque);

            return response()->json([
                'message' => 'Marque deleted successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
