<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeaturePricing extends Model
{
    use HasFactory;
    protected $table = 'feature_pricing';

    protected $fillable = ['feature_id','pricing_id'];
}
