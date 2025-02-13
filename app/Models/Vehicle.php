<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

class Vehicle extends Model
{

    use HasFactory;

    protected $fillable = ['vehicle_type', 'model', 'brand', 'color', 'daily_price'];

}
