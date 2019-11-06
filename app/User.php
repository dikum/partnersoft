<?php

namespace App;

use App\Payment;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'admin',
    ];

    public function setNameAttribute($name)
    {
        $this->attribute['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    public function setEmailAttribute($email)
    {
        $this->attribute['email'] = strtolower($email);
    }

    public function getEmailAttribute($email)
    {
        return ucwords($email);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function isAdmin()
    {
        return $this->admin == User::ADMIN_USER;
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
