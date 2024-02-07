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
        /*$marque = QueryBuilder::for(VehicleMarque::class)
            //->allowedIncludes(VehicleMarque::$allowedIncludes)
            ->allowedIncludes(['models'])
            ->get();

        return VehicleMarqueResource::collection($marque);

        //result : "data": [
        //        {
        //            "name": "renault",
        //            "display_name": "Renault",
        //            "models": [
        //                {
        //                    "name": "clio",
        //                    "display_name": "Clio",
        //                    "estimated_price": "15000.00"
        //                },
        //                {
        //                    "name": "megane",
        //                    "display_name": "Megane",
        //                    "estimated_price": "20000.00"
        //                },
        //                {
        //                    "name": "captur",
        //                    "display_name": "Captur",
        //                    "estimated_price": "18000.00"
        //                }
        //            ]
        //        },
*/
        $models = QueryBuilder::for(VehicleModel::class)
            ->allowedIncludes(VehicleModel::$allowedIncludes)
            ->get();

        return VehicleModelResource::collection($models);

        //result : "data": [
        //        {
        //            "name": "clio",
        //            "display_name": "Clio",
        //            "estimated_price": "15000.00",
        //            "marque": null
        //        },
    }
}
