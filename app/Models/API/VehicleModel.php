<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class VehicleModel extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'estimated_price',
    ];

    public function marque() : hasOne
    {
        return $this->hasOne(Marque::class);
    }

    public function vehicleType() : hasOne
    {
        return $this->hasOne(VehicleType::class);
    }
}
