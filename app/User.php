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
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Traits\UsesUuid;
    use Notifiable, HasApiTokens, SoftDeletes;

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

    const MALE = 'male';
    const FEMALE = 'female';

    const SINGLE_MARITAL_STATUS = 'single';
    const MARRIED_MARITAL_STATUS = 'married';
    const DIVORCED_MARITAL_STATUS = 'divorced';

    const EMMANUELTV = 'emmanuel tv partnership';
    const DONATION = 'donation';

    const ENGLISH_PREFERRED_LANGUAGE = 'english';
    const SPANISH_PREFERRED_LANGUAGE = 'spanish';
    const FRENCH_PREFERRED_LANGUAGE = 'french';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $primaryKey = 'user_id';

    public $transformer = UserTransformer::class;

    protected $dates = ['deleted_at'];
    protected $fillable = [
        'partner_id',
        'title_id',
        'state_id',
        'currency_id',
        'status',
        'name',
        'email',
        'email2',
        'phone',
        'phone2',
        'sex',
        'date_of_birth',
        'marital_status',
        'occupation',
        'donation_type',
        'donation_amount',
        'birth_country',
        'residential_country',
        'residential_address',
        'postal_address',
        'preflang',
        'type',
        'branch',
        'registered_by',
        'password',
        'remember_token',
        'verified',
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
        return $this->hasMany(Payment::class, 'made_by');
    }

    public function comments()
    {
        return $this->hasMany(PartnerComment::class, 'to');
    }


    public function comments_made_by()
    {
        return $this->hasMany(PartnerComment::class, 'made_by');
    }

    public function sms_to()
    {
        return $this->hasMany(Sms::class, 'to');
    }

    public function sms_sent_by()
    {
        return $this->hasMany(Sms::class, 'sent_by');
    }

    public function emails_to()
    {
        return $this->hasMany(Email::class, 'to');
    }

    public function emails_sent_by()
    {
        return $this->hasMany(Email::class, 'sent_by');
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
        return Str::random(40);
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
