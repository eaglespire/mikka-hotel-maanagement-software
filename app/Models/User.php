<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'firstname','lastname',
        'email','dob',
        'password','staff_identity',
        'join_date','status',
        'phone','password_text',
        'photo','ip',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'join_date'=>'date',
        'dob'=>'date',
    ];

    public function getFullnameAttribute(): string
    {
        return $this->attributes['firstname']." ". $this->attributes['lastname'];
    }

    public function scopeSearch($query, $term)
    {
        return $query->where('firstname','LIKE','%'.$term.'%')
            ->orWhere('lastname','LIKE','%'.$term.'%')
            ->orWhere('staff_identity','LIKE','%'.$term.'%')
            ->orWhere('email','LIKE','%'.$term.'%');
    }
}