<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeatureRoom extends Model
{
    use HasFactory;
    protected $table = 'feature_room';
    protected $fillable = ['feature_id','room_id'];


}
