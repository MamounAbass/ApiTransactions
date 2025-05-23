<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    protected $table = 'users';
    protected $dates =['delete_at'];

    CONST VERIFIED_USER = '1';
    CONST UNVERIFIED_USER = '0';

    CONST ADMIN_USER = 'true';
    CONST REGULAR_USER = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

     public function setNameAttribute($name)
     {
        $this->attributes['name']=strtolower($name);
     }

     public function getNameAttribute($name)
     {
        return ucwords($name);
     }

     public function setEmailAttribute($email)
     {
        $this->attributes['email']=strtolower($email);
     }
     public function getEmailAttribute($email)
     {
       return ucwords($email);
     }

    protected $fillable = [
        'name',
        'email',
        'password',
        'verified',
        'verification_token',
        'admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'verification_token'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }

    public static function isVerified()
    {
       return $this->verified == User::VERIFIED_USER;
    }

    public static function generateVerifiactioncode()
    {
        return Str::random(40);
    }
}
