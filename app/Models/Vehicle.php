<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $array)
 * @method static find($vehicle_uuid)
 */
class Vehicle extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'constructor',
        'model',
        'original_price',
        'type',
        'is_two_wheeled',
        'energy_source',
        'transmission',
        'cylinder_capacity',
        'power',
        'torque',
        'year_of_manufacture',
        'production_year',
        'circulation_date',
        'technical_revision',
        'number_of_owners',
        'kilometers',
        'color',
        'number_of_doors',
        'seats',
        'vehicle_length',
        'condition',
        'description',
    ];

    public function post() : BelongsTo
    {
        return $this->belongsTo(Post::class);
    }
}
