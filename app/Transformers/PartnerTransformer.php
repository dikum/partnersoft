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
            'partnerIdentifier' => (int)$partner->id,
            'titleIdentifier' => (int)$partner->title_id,
            'stateIdentifier' => (int)$partner_state_id,
            'currencyIdentifier' => (int)$partner_currency_id,
            'lastName' => (string)$partner->surname,
            'middleName' => (string)$partner->middle_name,
            'firstName' => (string)$partner->first_name,
            'gender' => (string)$partner->sex,
            'birthDate' => $partner->date_of_birth,
            'marital_status' => (string)$partner->marital_status,
            'job' => (string)$partner->occupation,
            'preferredLanguage' => (string)$partner->preflang,
            'countryOfBirth' => (int)$partner->birth_country,
            'countryOfResidence' => (int)$partner->residential_country,
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
            'createdDate' => $user->created_at,
            'changeDate' => $user->updated_at,
        ];

    }
}
