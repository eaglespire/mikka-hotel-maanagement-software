<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UpdateAdminPassword extends Model
{
    use HasFactory;
    protected $table = 'update_admin_passwords';
    protected $fillable = ['token','email'];

}
