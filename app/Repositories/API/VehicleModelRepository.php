<?php

namespace App\Repositories\API;

use App\Models\API\VehicleModel;
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

    public function store(array $data) : VehicleModel
    {
        return VehicleModel::create($data);
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
