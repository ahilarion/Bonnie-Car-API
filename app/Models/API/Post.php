<?php

namespace App\Models\API;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $array)
 * @method static where(string $string, $model)
 */
class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'images',
        'price',
        'kilometer',
        'reduction',
        'status',
        'user_id',
        'vehicle_model_id'
    ];

    public function User() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public static array $allowedIncludes = [

    ];
}
