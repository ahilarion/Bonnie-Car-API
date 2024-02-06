<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleTypeStoreRequest;
use App\Http\Requests\API\VehicleTypeUpdateRequest;
use App\Http\Resources\API\VehicleTypeResource;
use App\Repositories\API\VehicleTypeRepository;
use Illuminate\Http\Request;

class VehicleTypeController extends Controller
{
    private VehicleTypeRepository $vehicleTypeRepository;
    public function __construct(VehicleTypeRepository $vehicleTypeRepository)
    {
        $this->vehicleTypeRepository = $vehicleTypeRepository;
    }

    public function index()
    {
        try {
            $data = $this->vehicleTypeRepository->index();

            return VehicleTypeResource::collection($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function show($vehicleType)
    {
        try {
            $data = $this->vehicleTypeRepository->show($vehicleType);
            return new VehicleTypeResource($data);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function store(VehicleTypeStoreRequest $request)
    {
        try {
            $data = $this->vehicleTypeRepository->store($request->all());

            return response()->json([
                'message' => 'Type created successfully',
                'data' => new VehicleTypeResource($data)
            ], 201);
        } catch (\Exception $e) {
            // Handle exception
        }
    }

    public function update(VehicleTypeUpdateRequest $request, $vehicleType)
    {
        try {
            $data = $this->vehicleTypeRepository->update($request->all(), $vehicleType);

            return response()->json([
                'message' => 'Marque updated successfully',
                'data' => new VehicleTypeResource($data)
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }

    
    public function destroy($vehicleType)
    {
        try {
            $this->vehicleTypeRepository->destroy($vehicleType);

            return response()->json([
                'message' => 'Type deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 404);
        }
    }
}