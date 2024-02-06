<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleMarqueStoreRequest;
use App\Http\Requests\API\VehicleMarqueUpdateRequest;
use App\Http\Resources\API\VehicleMarqueResource;
use App\Repositories\API\VehicleMarqueRepository;

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

            return VehicleMarqueResource::collection($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function show($marque)
    {
        try {
            $data = $this->vehicleMarqueRepository->show($marque);
            return new VehicleMarqueResource($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function store(VehicleMarqueStoreRequest $request)
    {
        try {
            $data = $this->vehicleMarqueRepository->store($request->all());

            return response()->json([
                'message' => 'Marque created successfully',
                'data' => new VehicleMarqueResource($data)
            ], 201);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function update(VehicleMarqueUpdateRequest $request, $marque)
    {
        try {
            $data = $this->vehicleMarqueRepository->update($request->all(), $marque);

            return response()->json([
                'message' => 'Marque updated successfully',
                'data' => new VehicleMarqueResource($data)
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
            $this->vehicleMarqueRepository->destroy($marque);

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
