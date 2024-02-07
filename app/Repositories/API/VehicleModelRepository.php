<?php

namespace App\Repositories\API;

use App\Http\Requests\API\VehicleModelStoreRequest;
use App\Http\Requests\API\VehicleModelUpdateRequest;
use App\Models\API\VehicleMarque;
use App\Models\API\VehicleModel;
use App\Models\API\VehicleType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpFoundation\Response;

class VehicleModelRepository
{
    /**
     * @throws Exception
     */
    public function index(): Collection
    {
        $models = VehicleModel::all();

        if ($models->isEmpty()) {
            throw new Exception('No models found', Response::HTTP_NOT_FOUND);
        }

        return $models;
    }

    /**
     * @throws Exception
     */
    public function show($model) : VehicleModel
    {
        $model = VehicleModel::where('name', $model)->first();

        if (!$model) {
            throw new Exception('Model not found', Response::HTTP_NOT_FOUND);
        }

        return $model;
    }

    /**
     * @throws Exception
     */
    public function store(VehicleModelStoreRequest $data) : VehicleModel
    {
        $marque = VehicleMarque::where('name', $data['vehicle_marque'])->first();

        $type = VehicleType::where('name', $data['vehicle_type'])->first();

        $model = VehicleModel::create([
            'name' => $data['name'],
            'display_name' => $data['display_name'],
            'estimated_price' => $data['estimated_price'],
            'vehicle_marque_id' => $marque->id,
            'vehicle_type_id' => $type->id
        ]);

        if (!$model) {
            throw new Exception('Failed to create model', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $model;
    }

    /**
     * @throws Exception
     */
    public function update(VehicleModelUpdateRequest $data, $model) : VehicleModel
    {
        $model = VehicleModel::where('name', $model)->first();

        if (!$model) {
            throw new Exception('Model not found', Response::HTTP_NOT_FOUND);
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
            throw new Exception('Model not found', Response::HTTP_NOT_FOUND);
        }

        $model->delete();
    }
}
