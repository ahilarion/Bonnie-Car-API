<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, $marque)
 * @method static create(array $data)
 */
class VehicleMarque extends Model
{
    /**
     * @var array|string[]
     */
    protected $fillable = [
        'name',
        'display_name',
    ];

    public static array $allowedIncludes = [
        'VehicleModels',
        'VehicleModels.VehicleType'
    ];
    public function VehicleModels() : HasMany
    {
        return $this->hasMany(VehicleModel::class);
    }
}
