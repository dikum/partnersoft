<?php

namespace App\Transformers;

use App\Partner;
use League\Fractal\TransformerAbstract;

class PartnerTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Partner $partner)
    {
        return [
            'partnerIdentifier' => (string)$partner->partner_uuid,
            'friendlyIdentifier' => (string)$partner->partner_id,
            'titleIdentifier' => (string)$partner->title_id,
            'stateIdentifier' => (string)$partner->state_id,
            'currencyIdentifier' => (string)$partner->currency_id,
            'lastName' => (string)$partner->surname,
            'middleName' => (string)$partner->middle_name,
            'firstName' => (string)$partner->first_name,
            'gender' => (string)$partner->sex,
            'birthDate' => $partner->date_of_birth,
            'marital_status' => (string)$partner->marital_status,
            'job' => (string)$partner->occupation,
            'preferredLanguage' => (string)$partner->preflang,
            'countryOfBirth' => (string)$partner->birth_country,
            'countryOfResidence' => (string)$partner->residential_country,
            'emailAddress1' => (string)$partner->email,
            'emailAddress2' => (string)$partner->email2,
            'phoneNumber1' => (string)$partner->phone,
            'phoneNumber2' => (string)$partner->phone2,
            'homeAddress' => (string)$partner->residential_address,
            'postalAddress' => (string)$partner->postal_address,
            'typeOfDonation' => (string)$partner->donation_type,
            'pledgeAmount' => $partner->donation_amount,
            'status' => (string)$partner->status,
            'isVerified' => (int)$partner->verified,
            'createdDate' => (string)$partner->created_at,
            'changeDate' => (string)$partner->updated_at,

            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('partners.show', $partner->partner_uuid),
                ],
                [
                    'rel' => 'partners.messages',
                    'href' => route('partners.messages.index', $partner->partner_uuid),
                ],
                [
                    'rel' => 'partners.comments',
                    'href' => route('partners.comments.index', $partner->partner_uuid),
                ],
                [
                    'rel' => 'partners.payments',
                    'href' => route('partners.payments.index', $partner->partner_uuid),
                ], 
            ],
        ];

    }

    public static function originalAttribute($index)
    {
        $attributes = [

            'partnerIdentifier' => 'partner_uuid',
            'friendlyIdentifier' => 'partner_id',
            'titleIdentifier' => 'title_id',
            'stateIdentifier' => 'state_id',
            'currencyIdentifier' => 'currency_id',
            'lastName' => 'surname',
            'middleName' => 'middle_name',
            'firstName' => 'first_name',
            'gender' => 'sex',
            'birthDate' => 'date_of_birth',
            'marital_status' => 'marital_status',
            'job' => 'occupation',
            'preferredLanguage' => 'preflang',
            'countryOfBirth' => 'birth_country',
            'countryOfResidence' => 'residential_country',
            'emailAddress1' => 'email',
            'emailAddress2' => 'email2',
            'phoneNumber1' => 'phone',
            'phoneNumber2' => 'phone2',
            'homeAddress' => 'residential_address',
            'postalAddress' => 'postal_address',
            'typeOfDonation' => 'donation_type',
            'pledgeAmount' => 'donation_amount',
            'status' => 'status',
            'isVerified' => 'verified',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
