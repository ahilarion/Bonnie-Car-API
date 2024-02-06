<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VehicleModel extends Model
{
    protected $fillable = [
        'name',
        'display_name',
        'estimated_price',
    ];

    public function vehicleMarque() : BelongsTo
    {
        return $this->belongsTo(VehicleMarque::class);
    }

    public function vehicleType() : BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }
}
