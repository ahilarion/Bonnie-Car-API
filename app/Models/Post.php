<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @method static create(array $array)
 * @method static find($uuid)
 */
class Post extends Model
{
    use HasFactory, HasUuids;

    protected $primaryKey = 'uuid';

    protected $fillable = [
        'title',
        'description',
        'price',
        'images',
        'user_uuid',
        'vehicle_uuid'
    ];

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function vehicle() : HasOne
    {
        return $this->hasOne(Vehicle::class);
    }
}
