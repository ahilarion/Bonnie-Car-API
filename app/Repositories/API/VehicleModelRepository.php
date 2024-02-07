<?php

namespace App\Repositories\API;

use App\Http\Requests\API\VehicleModelStoreRequest;
use App\Http\Requests\API\VehicleModelUpdateRequest;
use App\Models\API\VehicleMarque;
use App\Models\API\VehicleModel;
use App\Models\API\VehicleType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class VehicleModelRepository
{
    /**
     * @throws Exception
     */
    public function index(): Collection
    {
        try {
            $models = QueryBuilder::for(VehicleModel::class)
                ->allowedIncludes(VehicleModel::$allowedIncludes)
                ->get();
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

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
        try {
            $model = QueryBuilder::for(VehicleModel::class)
                ->allowedIncludes(VehicleModel::$allowedIncludes)
                ->where('name', $model)
                ->first();
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

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
        $marque = VehicleMarque::where('name', $data['vehicle_marque'])->firstOrFail();

        $type = VehicleType::where('name', $data['vehicle_type'])->firstOrFail();

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
