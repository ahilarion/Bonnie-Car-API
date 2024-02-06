<?php

namespace App\Repositories\API;

use App\Models\API\VehicleType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class VehicleTypeRepository
{
    public function index(): Collection
    {
        return VehicleType::all();
    }

    public function show($vehicleType) : VehicleType
    {
        return VehicleType::where('name', $vehicleType)->first();
    }

    public function store(array $data) : VehicleType
    {
        return VehicleType::create($data);
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $vehicleType) : VehicleType
    {
        $vehicleType = VehicleType::where('name', $vehicleType)->first();

        if (!$vehicleType) {
            throw new Exception('Vehicle not found');
        }

        $vehicleType->update($data);
        return $vehicleType;
    }

    /**
     * @throws Exception
     */
    public function destroy($vehicleType) : void
    {
        $vehicleType = VehicleType::where('name', $vehicleType)->first();

        if (!$vehicleType) {
            throw new Exception('Vehicle not found');
        }

        $vehicleType->delete();
    }
}
