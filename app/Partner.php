<?php

namespace App;

use App\PartnerComment;
use App\Payment;
use App\Sms;
use App\Title;
use Illuminate\Database\Eloquent\Model;

class Partner extends Model
{
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

    protected $fillable = [
    	'partner_id',
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
    	'registered_by',
    	'password',
    	'verified',
        'remember_token',
    	'verification_token',
    ];




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
