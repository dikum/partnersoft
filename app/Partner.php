<?php

namespace App;

use App\PartnerComment;
use App\Payment;
use App\Sms;
use App\Title;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;

	const PENDING_STATUS = 'pending';
	const ACTIVE_STATUS = 'active';

	const VERIFIED_PARTNER = '1';
	const UNVERIFIED_PARTNER = '0';

    const SINGLE_MARITAL_STATUS = 'single';
    const MARRIED_MARITAL_STATUS = 'married';
    const DIVORCED_MARITAL_STATUS = 'divorced';

    const ENGLISH_PREFERRED_LANGUAGE = 'english';
    const SPANISH_PREFERRED_LANGUAGE = 'spanish';
    const FRENCH_PREFERRED_LANGUAGE = 'french';

    const EMMANUELTV = 'emmanuel tv partnership';
    const DONATION = 'donation';

    const MALE = 'male';
    const FEMALE = 'female';

    const PARTNER_ID = null;
    
    const REGISTERED_BY_SELF = 'self';

    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'partner_id',
        'user_id',
    	'title_id',
        'state_id',
        'currency_id',
    	'surname',
    	'middle_name',
    	'first_name',
    	'sex',
    	'date_of_birth',
    	'marital_status',
    	'occupation',
    	'note',
    	'preflang',

        'birth_country', //Country ID
        'residential_country', //Country ID
        'email',
        'email2',
        'phone',
        'phone2',
        'residential_address',
        'postal_address',

        'donation_type',
        'donation_amount',

    	'status',
    	'password',
    	'verified',
        'remember_token',
    	'verification_token',
    ];



    public function setSurnameAttribute($surname)
    {
        $this->attributes['surname'] = strtolower($surname);
    }

    public function getSurnameAttribute($surname)
    {
        return ucwords($surname);
    }

    public function setFirst_nameAttribute($first_name)
    {
        $this->attributes['first_name'] = strtolower($first_name);
    }

    public function getFirstNameAttribute($first_name)
    {
        return ucwords($first_name);
    }

    public function setMiddle_nameAttribute($middle_name)
    {
        $this->attributes['middle_name'] = strtolower($middle_name);
    }

    public function getMiddleNameAttribute($middle_name)
    {
        return ucwords($middle_name);
    }

    public function setEmailAttribute($email)
    {
        $this->attributes['email'] = strtolower($email);
    }


    public function setEmail2Attribute($email2)
    {
        $this->attributes['email2'] = strtolower($email2);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function emails()
    {
    	return $this->hasMany(Email::class);
    }

    public function sms()
    {
    	return $this->hasMany(Sms::class);
    }

    public function payments()
    {
    	return $this->hasMany(Payment::class);
    }

    public function partner_comments()
    {
    	return $this->hasMany(PartnerComment::class);
    }

    public function title()
    {
    	return $this->belongsTo(Title::class);
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

    public function isVerified()
    {
    	return $this->verified == Partner::VERIFIED_USER;
    }

    public static function generateVerificationCode()
    {
    	return str_random(40);
    }
}
