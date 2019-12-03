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
        ];

    }
}
