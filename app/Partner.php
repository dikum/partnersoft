<?php

namespace App;

use App\PartnerComment;
use App\Payment;
use App\Sms;
use App\Title;
use App\Transformers\PartnerTransformer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Partner extends Model
{
    use SoftDeletes;

    use Traits\UsesUuid;

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

    protected $primaryKey = 'partner_uuid';

    public $transformer = PartnerTransformer::class;
    protected $dates = ['deleted_at'];
    protected $fillable = [
    	'partner_id',
        'user_id',
        'registered_by',
    	'title_id',
        'state_id',
        'currency_id',
    	'sex',
    	'date_of_birth',
    	'marital_status',
    	'occupation',
    	'preflang',

        'birth_country', //Country ID
        'residential_country', //Country ID
        'email2',
        'phone',
        'phone2',
        'residential_address',
        'postal_address',

        'donation_type',
        'donation_amount',
    ];

    public function setEmail2Attribute($email2)
    {
        $this->attributes['email2'] = strtolower($email2);
    }

    //Belongs to probable user that registered the partner
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //User that is a partner
    public function user_partner()
    {
        return $this->belongsTo(User::class);
    }

    public function emails()
    {
    	return $this->hasMany(Email::class, 'partner_uuid');
    }

    public function sms()
    {
    	return $this->hasMany(Sms::class, 'partner_uuid');
    }

    public function payments()
    {
    	return $this->hasMany(Payment::class, 'partner_uuid');
    }

    public function partner_comments()
    {
    	return $this->hasMany(PartnerComment::class, 'partner_uuid');
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
        'deleted_at',
    ];

    
}
