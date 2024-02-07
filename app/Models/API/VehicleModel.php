<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static where(string $string, $model)
 */
class VehicleModel extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'display_name',
        'estimated_price',
        'gearbox',
        'fuel_type',
        'horse_power',
        'consumption',
        'release_year',
        'vehicle_marque_id',
        'vehicle_type_id'
    ];

    public static array $allowedIncludes = [
        'VehicleMarque',
        'VehicleType'
    ];

    public function VehicleMarque() : BelongsTo
    {
        return $this->belongsTo(VehicleMarque::class);
    }

    public function VehicleType() : BelongsTo
    {
        return $this->belongsTo(VehicleType::class);
    }
}
