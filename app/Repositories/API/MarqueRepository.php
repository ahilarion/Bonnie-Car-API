<?php

namespace App\Repositories\API;

use App\Models\API\Marque;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;

class MarqueRepository
{
    public function index(): Collection
    {
        return Marque::all();
    }

    public function show($marque) : Marque
    {
        return Marque::where('name', $marque)->first();
    }

    public function store(array $data) : Marque
    {
        return Marque::create($data);
    }

    /**
     * @throws Exception
     */
    public function update(array $data, $marque) : Marque
    {
        $marque = Marque::where('name', $marque)->first();

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
        $marque = Marque::where('name', $marque)->first();

        if (!$marque) {
            throw new Exception('Marque not found');
        }

        $marque->delete();
    }
}
