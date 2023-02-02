<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';

    protected $fillable = [
        'siteName',
        'favicon',
        'whiteLogo',
        'darkLogo',
        'frontCopyright',
        'backCopyright',
        'firstPhoneNumber',
        'secondPhoneNumber',
        'firstAddress',
        'secondAddress',
        'firstEmail',
        'secondEmail',
        'facebookID',
        'twitterID',
        'instagramID',
        'linkedinID',
        'youtubeID',
        'whatsapp',
        'siteHeaderInfo',
        'currency',
    ];
}
