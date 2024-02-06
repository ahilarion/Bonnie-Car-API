<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\VehicleModelResource;
use App\Repositories\API\VehicleModelRepository;
use App\Http\Requests\API\VehicleModelStoreRequest;
use App\Http\Requests\API\VehicleModelUpdateRequest;

class VehicleModelController extends Controller
{
    private VehicleModelRepository $vehicleModelRepository;
    public function __construct(VehicleModelRepository $vehicleModelRepository)
    {
        $this->vehicleModelRepository = $vehicleModelRepository;
    }


    public function index()
    {
        try {
            $data = $this->vehicleModelRepository->index();

            return VehicleModelResource::collection($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function show($model)
    {
        try {
            $data = $this->vehicleModelRepository->show($model);
            return new VehicleModelResource($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function store(VehicleModelStoreRequest $request)
    {
        try {
            $data = $this->vehicleModelRepository->store($request->all());

            return response()->json([
                'message' => 'Model created successfully',
                'data' => new VehicleModelResource($data)
            ], 201);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function update(VehicleModelUpdateRequest $request, $model)
    {
        try {
            $data = $this->vehicleModelRepository->update($request->all(), $model);

            return response()->json([
                'message' => 'Model updated successfully',
                'data' => new VehicleModelResource($data)
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
            $this->vehicleModelRepository->destroy($model);

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
