<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\VehicleModelResource;
use App\Repositories\API\VehicleModelRepository;
use App\Http\Requests\API\VehicleModelStoreRequest;
use App\Http\Requests\API\VehicleModelUpdateRequest;
use Symfony\Component\HttpFoundation\Response;

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
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function show($model)
    {
        try {
            $data = $this->vehicleModelRepository->show($model);

            return new VehicleModelResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function store(VehicleModelStoreRequest $request)
    {
        try {
            $data = $this->vehicleModelRepository->store($request);

            return new VehicleModelResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function update(VehicleModelUpdateRequest $request, $model)
    {
        try {
            $data = $this->vehicleModelRepository->update($request, $model);

            return new VehicleModelResource($data);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function destroy($model)
    {
        try {
            $this->vehicleModelRepository->destroy($model);

            return response()->json([
                'message' => 'Model deleted successfully'
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
