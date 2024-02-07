<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\API\VehicleMarqueResource;
use App\Http\Resources\API\VehicleModelResource;
use App\Models\API\VehicleMarque;
use App\Models\API\VehicleModel;
use App\Models\API\VehicleType;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class TestController extends Controller
{
    public function test(Request $request)
    {
        $list = QueryBuilder::for(VehicleModel::class)
            ->allowedFilters('name', 'vehicle_marque_id')
            ->allowedSorts('name')
            ->allowedIncludes('VehicleMarque', 'VehicleType')
            ->paginate(10);

        // Transform with resource but keep the pagination
        return VehicleModelResource::collection($list);
    }
}
