<?php

namespace App\Repositories\API;

use App\Models\API\VehicleMarque;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class VehicleMarqueRepository
{
    public function index(): Collection
    {
        return VehicleMarque::all();
    }

    public function show($marque) : VehicleMarque
    {
        return VehicleMarque::where('name', $marque)->first();
    }

    public function store(array $data) : VehicleMarque
    {
        return VehicleMarque::create($data);
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $marque) : VehicleMarque
    {
        $marque = VehicleMarque::where('name', $marque)->first();

        if (!$marque) {
            throw new Exception('Marque not found');
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
            throw new Exception('Marque not found');
        }

        $marque->delete();
    }
}
