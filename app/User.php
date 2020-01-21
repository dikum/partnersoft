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

    const ADMIN_USER = 'admin';
    const REGULAR_USER = 'regular';
    const PARTNER_USER = 'partner';

    const VERIFIED_USER = '1';
    const UNVERIFIED_USER = '0';

    const LAGOS_BRANCH = 'lagos';
    const SOUTH_AFRICA_BRANCH = 'south africa';
    const GHANA_BRANCH = 'ghana';

    const ACTIVE_USER = 'active';
    const INACTIVE_USER = 'inactive';
    const SUSPENDED_USER = 'suspended';

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
        'status',
        'email', 
        'password',
        'type',
        'branch',
        'verified',
        'remember_token',
        'verification_token',
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


    //User can register many partners
    public function partners()
    {
        return $this->hasMany(Partner::class, 'user_id');
    }

    //User is a partner
    public function partner()
    {
        return $this->hasOne(Partner::class, 'user_id');
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
        return $this->type == User::ADMIN_USER;
    }

    public function isRegularUser()
    {
        return $this->type == User::REGULAR_USER;
    }

    public function isPartner()
    {
        return $this->type == User::PARTNER_USER;
    }

    public function isVerified()
    {
        return $this->verified == Partner::VERIFIED_USER;
    }

    public static function generateVerificationCode()
    {
        return str_random(40);
    }


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 
        'remember_token',
        'verification_token', 
        'deleted_at',
    ];
}
