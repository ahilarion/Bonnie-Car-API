<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\VehicleTypeStoreRequest;
use App\Http\Requests\API\VehicleTypeUpdateRequest;
use App\Http\Resources\API\VehicleTypeResource;
use App\Repositories\API\VehicleTypeRepository;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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

            return response()->json([
                'data' => VehicleTypeResource::collection($data)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function show($type)
    {
        try {
            $data = $this->vehicleTypeRepository->show($type);

            return response()->json([
                'data' => new VehicleTypeResource($data)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function store(VehicleTypeStoreRequest $request)
    {
        try {
            $data = $this->vehicleTypeRepository->store($request);

            return response()->json([
                'message' => 'Type created successfully',
                'data' => new VehicleTypeResource($data)
            ], Response::HTTP_CREATED);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function update(VehicleTypeUpdateRequest $request, $type)
    {
        try {
            $data = $this->vehicleTypeRepository->update($request, $type);

            return response()->json([
                'message' => 'Marque updated successfully',
                'data' => new VehicleTypeResource($data)
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }


    public function destroy($type)
    {
        try {
            $this->vehicleTypeRepository->destroy($type);

            return response()->json([
                'message' => 'Type deleted successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
