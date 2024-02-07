<?php

namespace App\Repositories\API;

use App\Models\API\VehicleMarque;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class VehicleMarqueRepository
{
    /**
     * @throws Exception
     */
    public function index(): Collection
    {
        $marques = VehicleMarque::all();

        if ($marques->isEmpty()) {
            throw new Exception('No marques found', Response::HTTP_NOT_FOUND);
        }

        return $marques;
    }

    /**
     * @throws Exception
     */
    public function show($marque) : VehicleMarque
    {
        $marque = VehicleMarque::where('name', $marque)->first();

        if (!$marque) {
            throw new Exception('Marque not found', Response::HTTP_NOT_FOUND);
        }

        return $marque;
    }

    /**
     * @throws Exception
     */
    public function store(array $data) : VehicleMarque
    {
        $marque = VehicleMarque::create($data);

        if (!$marque) {
            throw new Exception('Marque not created', Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        return $marque;
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $marque) : VehicleMarque
    {
        $marque = VehicleMarque::where('name', $marque)->first();

        if (!$marque) {
            throw new Exception('Marque not found', Response::HTTP_NOT_FOUND);
        }

        $marque->update($data);
        return $marque;
    }

    /**
     * @throws Exception
     */
    public function destroy($marque) : void
    {
        $marque = VehicleMarque::where('name', $marque)->first();

        if (!$marque) {
            throw new Exception('Marque not found', Response::HTTP_NOT_FOUND);
        }

        $marque->delete();
    }
}
