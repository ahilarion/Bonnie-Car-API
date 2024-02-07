<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, mixed $vehicle_type)
 * @method static create(array $data)
 */
class VehicleType extends Model
{
    protected $fillable = [
        'name',
        'display_name',
    ];

    public static array $allowedIncludes = [
        'VehicleModels',
        'VehicleModels.VehicleMarque'
    ];
    public function VehicleModels() : HasMany
    {
        return $this->hasMany(VehicleModel::class);
    }
}
