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
            'friendlyPartnerIdentifier' => (string)$partner->partner_id,
            'userIdentifier' => (string)$partner->user_id,
            'registeredByUser' => (string)$partner->registeredBy,
            'titleIdentifier' => (string)$partner->title_id,
            'stateIdentifier' => (string)$partner->state_id,
            'currencyIdentifier' => (string)$partner->currency_id,
            'gender' => (string)$partner->sex,
            'birthDate' => $partner->date_of_birth,
            'marital_status' => (string)$partner->marital_status,
            'job' => (string)$partner->occupation,
            'preferredLanguage' => (string)$partner->preflang,
            'countryOfBirth' => (string)$partner->birth_country,
            'countryOfResidence' => (string)$partner->residential_country,
            'emailAddress2' => (string)$partner->email2,
            'phoneNumber1' => (string)$partner->phone,
            'phoneNumber2' => (string)$partner->phone2,
            'homeAddress' => (string)$partner->residential_address,
            'postalAddress' => (string)$partner->postal_address,
            'typeOfDonation' => (string)$partner->donation_type,
            'pledgeAmount' => $partner->donation_amount,
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
            'friendlyPartnerIdentifier' => 'partner_id',
            'userIdentifier' => 'user_id',
            'registeredByUser' => 'registeredBy',
            'titleIdentifier' => 'title_id',
            'stateIdentifier' => 'state_id',
            'currencyIdentifier' => 'currency_id',
            'gender' => 'sex',
            'birthDate' => 'date_of_birth',
            'marital_status' => 'marital_status',
            'job' => 'occupation',
            'preferredLanguage' => 'preflang',
            'countryOfBirth' => 'birth_country',
            'countryOfResidence' => 'residential_country',
            'emailAddress2' => 'email2',
            'phoneNumber1' => 'phone',
            'phoneNumber2' => 'phone2',
            'homeAddress' => 'residential_address',
            'postalAddress' => 'postal_address',
            'typeOfDonation' => 'donation_type',
            'pledgeAmount' => 'donation_amount',
            'createdDate' => 'created_at',
            'changeDate' => 'updated_at',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [

            'partner_uuid' => 'partnerIdentifier',
            'partner_id' => 'friendlyPartnerIdentifier',
            'user_id' => 'userIdentifier',
            'registeredBy' => 'registeredByUser',
            'title_id' => 'titleIdentifier',
            'state_id' => 'stateIdentifier',
            'currency_id' => 'currencyIdentifier',
            'sex' => 'gender',
            'date_of_birth' => 'birthDate',
            'marital_status' => 'marital_status',
            'occupation' => 'job',
            'preflang' => 'preferredLanguage',
            'birth_country' => 'countryOfBirth',
            'residential_country' => 'countryOfResidence',
            'email2' => 'emailAddress2',
            'phone' => 'phoneNumber1',
            'phone2' => 'phoneNumber2',
            'residential_address' => 'homeAddress',
            'postal_address' => 'postalAddress',
            'donation_type' => 'typeOfDonation',
            'donation_amount' => 'pledgeAmount',
            'created_at' => 'createdDate',
            'updated_at' => 'changeDate',

        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
