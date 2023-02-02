<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','category','extraInfo','description','price',
        'roomNumber','roomClean','roomShown','roomBooked','slug',
        'firstImage','secondImage','thirdImage','fourthImage','fifthImage','sixthImage',
        'f1_public_id','f2_public_id','f3_public_id','f4_public_id','f5_public_id','f6_public_id',
    ];

    public function features() : HasMany
    {
        return $this->hasMany(Feature::class);
    }
}
