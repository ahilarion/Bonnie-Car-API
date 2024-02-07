<?php

namespace App\Repositories\API;

use App\Http\Requests\API\VehicleTypeStoreRequest;
use App\Http\Requests\API\VehicleTypeUpdateRequest;
use App\Models\API\VehicleType;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Spatie\QueryBuilder\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;

class VehicleTypeRepository
{
    /**
     * @throws Exception
     */
    public function index()
    {
        try {
            $types = QueryBuilder::for(VehicleType::class)
                ->allowedIncludes(VehicleType::$allowedIncludes)
                ->paginate(10);
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

        if ($types->isEmpty()) {
            throw new Exception('No vehicle types found', Response::HTTP_NOT_FOUND);
        }

        return $types;
    }

    /**
     * @throws Exception
     */
    public function show($type) : VehicleType
    {
        try {
            $type = QueryBuilder::for(VehicleType::class)
                ->allowedIncludes(VehicleType::$allowedIncludes)
                ->where('name', $type)
                ->first();
        } catch (Exception $e) {
            throw new Exception("Requested include(s) are not allowed", Response::HTTP_BAD_REQUEST);
        }

        if (!$type) {
            throw new Exception('Vehicle type not found', Response::HTTP_NOT_FOUND);
        }

        return $type;
    }

    /**
     * @throws Exception
     */
    public function store(VehicleTypeStoreRequest $data) : VehicleType
    {
        $type = VehicleType::create($data->all());

        if (!$type) {
            throw new Exception('Vehicle type not created', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $type;
    }

    /**
     * @throws Exception
     */
    public function update(VehicleTypeUpdateRequest $data, $type) : VehicleType
    {
        $type = VehicleType::where('name', $type)->first();

        if (!$type) {
            throw new Exception('Vehicle not found', Response::HTTP_NOT_FOUND);
        }

        $type->update($data->all());

        return $type;
    }

    /**
     * @throws Exception
     */
    public function destroy($type) : void
    {
        $type = VehicleType::where('name', $type)->first();

        if (!$type) {
            throw new Exception('Vehicle not found', Response::HTTP_NOT_FOUND);
        }

        $type->delete();
    }
}
