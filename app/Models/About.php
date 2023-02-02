<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'abouts';
    use HasFactory;

    protected $fillable = [
        'heroImage',
        'firstSectionFirstImage',
        'firstSectionSecondImage',
        'firstSectionFirstTitle',
        'firstSectionFirstSubTitle',
        'firstSectionFirstBody',
        'firstSectionSecondBody',
        'secondSectionImage',
        'secondSectionTitle',
        'secondSectionSubTitle',
        'secondSectionBody',
        'thirdSectionImage',
        'thirdSectionTitle',
        'thirdSectionSubTitle',
        'thirdSectionFirstBody',
        'thirdSectionSecondBody',
        'thirdSectionButtonText',
        'thirdSectionButtonUrl',
        'title',
        'description',
        'slug',
    ];
}
