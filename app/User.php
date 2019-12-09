<?php

namespace App;

use App\Email;
use App\Partner;
use App\PartnerComment;
use App\Payment;
use App\Sms;
use App\Transformers\UserTransformer;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Traits\UsesUuid;
    use Notifiable, SoftDeletes;

    const ADMIN_USER = 'true';
    const REGULAR_USER = 'false';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'user_id';

    public $transformer = UserTransformer::class;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'admin',
    ];

    public function setNameAttribute($name)
    {
        $this->attributes['name'] = strtolower($name);
    }

    public function getNameAttribute($name)
    {
        return ucwords($name);
    }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }


    public function partners()
    {
        return $this->hasMany(Partner::class, 'user_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(PartnerComment::class, 'user_id');
    }

    public function sms()
    {
        return $this->hasMany(Sms::class, 'user_id');
    }

    public function emails()
    {
        return $this->hasMany(Email::class, 'user_id');
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
        'password', 
        'remember_token', 
        'deleted_at',
    ];
}
