<?php

namespace App\Repositories\API;

use App\Models\API\Marque;
use Illuminate\Database\Eloquent\Collection;
class MarqueRepository
{
    public function index(): Collection
    {
        return Marque::all();
    }
}
