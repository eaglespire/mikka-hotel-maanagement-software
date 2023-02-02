<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pricing extends Model
{
    use HasFactory;
    protected $fillable = [
        'title','subtitle','tag','slug','image','url','price'
    ];
    public function features() : BelongsToMany
    {
        return $this->belongsToMany(Feature::class);
    }
}
