<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $with = ['postcategory'];
    protected $fillable = [
        'title','body','reads','tags','author',
        'postcategory_id','published','slug','image_1','image_2','image_3','image_4','image_5'];

    public function postcategory()
    {
        return $this->belongsTo(Postcategory::class);
    }
    public function incrementReadCount()
    {
        $this->reads++;
        return $this->save();
    }

}
