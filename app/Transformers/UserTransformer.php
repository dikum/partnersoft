<?php

namespace App\Transformers;

use App\Partner;
use App\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [
            'userIdentifier' => (string)$user->user_id,
            'partnerIdentifier' => (string)$user->partner_id,
            'titleIdentifier' => (string)$user->title_id,
            'stateIdentifier' => (string)$user->state_id,
            'currencyIdentififer' => (string)$user->currency_id,
            'userStatus' => (string)$user->status,
            'fullname' => (string)$user->name,
            'emailAddress' => (string)$user->email,
            'secondaryEmailAddress' => (string)$user->email2,
            'phoneNumber' => (string)$user->phone,
            'secondaryPhoneNumber' => (string)$user->phone2,
            'gender' => (string)$user->sex,
            'birthDate' => (string)$user->date_of_birth,
            'maritalStatus' => (string)$user->marital_status,
            'job' => (string)$user->occupation,
            'typeOfDonation' => (string)$user->donation_type,
            'donationAmount' => (string)$user->donation_amount,
            'countryOfBirth' => (string)$user->birth_country,
            'countryOfResidence' => (string)$user->residential_country,
            'residentialAddress' => (string)$user->residential_address,
            'postalAddress' => (string)$user->postal_address,
            'preferredLanguage' => (string)$user->preflang,
            'userType' => $user->type,
            'userBranch' => $user->branch,
            //'password' => 'password',
            //'password_confirmation' => 'password_confirmation',
            'registeredBy' => (string)$user->registered_by,
            'isVerified' => (int)$user->verified,
            'createdDate' => (string)$user->created_at,
            'changeDate' => (string)$user->updated_at,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('users.show', $user->user_id),
                ],
                [
                    'rel' => 'users.payments',
                    'href' => route('users.payments.index', $user->user_id),
                ],
                [
                    'rel' => 'users.comments',
                    'href' => route('users.comments.index', $user->user_id),
                ],
                [
                    'rel' => 'users.partners',
                    'href' => route('users.partners.index', $user->user_id),
                ], [
                    'rel' => 'users.messages',
                    'href' => route('users.messages.index', $user->user_id),
                ],
            ],
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'userIdentifier' => 'user_id',
            'partnerIdentifier' => 'partner_id',
            'titleIdentifier' => 'title_id',
            'stateIdentifier' => 'state_id',
            'currencyIdentifier' => 'currency_id',
            'userStatus' => 'status',
            'fullname' => 'name',
            'emailAddress' => 'email',
            'secondaryEmailAddress' => 'email2',
            'phoneNumber' => 'phone',
            'secondaruPhoneNumber' => 'phone2',
            'gender' => 'sex',
            'birthDate' => 'date_of_birth',
            'maritalStatus' => 'marital_status',
            'job' => 'occupation',
            'typeOfDonation' => 'donation_type',
            'donationAmount' => 'donation_amount',
            'countryOfBirth' => 'birth_country',
            'countryOfResidence' => 'residential_country',
            'residentialAddress' => 'residential_address',
            'postalAddress' => 'postal_address',
            'preferredLanguage' => 'preflang',
            'userType' => 'type',
            'userBranch' => 'branch',
            'password' => 'password',
            'password_confirmation' => 'password_confirmation',
            'registeredBy' => 'registered_by',
            'isVerified' => 'verified',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [

            'user_id' => 'userIdentifier',
            'partner_id' => 'partnerIdentifier',
            'title_id' => 'titleIdentifier',
            'state_id' => 'stateIdentifier',
            'currency_id' => 'currencyIdentififer',
            'status' => 'userStatus',
            'name' => 'fullname',
            'email' => 'emailAddress',
            'email2' => 'secondaryEmailAddress',
            'phone' =>'phoneNumber',
            'phone2' => 'secondaruPhoneNumber',
            'sex' => 'gender' ,
            'date_of_birth' => 'birthDate' ,
            'marital_status' => 'maritalStatus',
            'occupation' => 'job' ,
            'donation_type' => 'typeOfDonation' ,
            'donation_amount' => 'donationAmount',
            'birth_country' => 'countryOfBirth',
            'residential_country' => 'countryOfResidence',
            'residential_address' => 'residentialAddress',
            'postal_address' => 'postalAddress',
            'preflang' => 'preferredLanguage',
            'type' => 'userType',
            'branch' => 'userBranch',
            'password' => 'password',
            'password_confirmation' => 'password_confirmation',
            'registered_by' => 'registeredBy',
            'verified' => 'isVerified',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
