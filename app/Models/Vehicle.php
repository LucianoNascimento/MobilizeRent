<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
class Vehicle extends Model
{

    use HasFactory;

    protected $fillable = ['vehicle_type', 'model', 'brand', 'color', 'daily_price'];

    protected $hidden = ['id'];

    public function images():HasMany
    {
        return $this->hasMany(Image::class);
    }
}
