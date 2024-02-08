<?php

namespace App\Models\API;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Article extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $keyType = "string";
    
    /**
     * @var array|string[]
     */
    protected $fillable = [
        'title',
        'thumbnail',
        'description',
        'short_description',
        'html_content',
        'banner',
        'tags'
    ];

    public static array $allowedIncludes = [];

    public function VehicleModels() : HasMany
    {
        return $this->hasMany(VehicleModel::class);
    }
}
