<?php

namespace App\Repositories\API;

use App\Models\API\VehicleMarque;
use App\Models\API\VehicleModel;
use App\Models\API\VehicleType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class VehicleModelRepository
{
    public function index(): Collection
    {
        return VehicleModel::all();
    }

    public function show($model) : VehicleModel
    {
        return VehicleModel::where('name', $model)->first();
    }

    /**
     * @throws Exception
     */
    public function store(array $data) : VehicleModel
    {
        if (!isset($data['vehicle_marque'], $data['vehicle_type'], $data['name'], $data['display_name'], $data['estimated_price']))
        {
            throw new Exception('Invalid data provided');
        }

        $vehicleMarque = VehicleMarque::where('name', $data['vehicle_marque'])->first();

        if (!$vehicleMarque) {
            throw new Exception('Marque '. $data['vehicle_marque'] .' not found');
        }

        $vehicleType = VehicleType::where('name', $data['vehicle_type'])->first();

        if (!$vehicleType) {
            throw new Exception('Type '. $data['vehicle_type'] .' not found');
        }

        return VehicleModel::create([
            'name' => $data['name'],
            'display_name' => $data['display_name'],
            'estimated_price' => $data['estimated_price'],
            'vehicle_marque_id' => $vehicleMarque->id,
            'vehicle_type_id' => $vehicleType->id
        ]);
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $model) : VehicleModel
    {
        $model = VehicleModel::where('name', $model)->first();

        if (!$model) {
            throw new Exception('Model not found');
        }

        $model->update($data);
        return $model;
    }

    /**
     * @throws Exception
     */
    public function destroy($model) : void
    {
        $model = VehicleModel::where('name', $model)->first();

        if (!$model) {
            throw new Exception('Model not found');
        }

        $model->delete();
    }
}
