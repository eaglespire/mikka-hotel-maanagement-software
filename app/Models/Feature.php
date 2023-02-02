<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = ['name','icon','image'];

    public function rooms() : BelongsToMany
    {
        return $this->belongsToMany(Room::class);
    }
    public function pricings() : BelongsToMany
    {
        return $this->belongsToMany(Pricing::class);
    }
}
