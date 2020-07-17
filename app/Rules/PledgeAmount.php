<?php

namespace App\Rules;

use App\Helpers\CurrencyHelper;
use App\Helpers\TitleHelper;
use Illuminate\Contracts\Validation\Rule;

class PledgeAmount implements Rule
{

    public $currency_id;
    public $title_id;
    public $minimum_amount;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($currency_id, $title_id)
    {
        $this->currency_id = $currency_id;
        $this->title_id = $title_id;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->minimum_amount = CurrencyHelper::getMinimumAmount($this->currency_id);
        $title = TitleHelper::get_title_name($this->title_id);

        if(strpos($title, '&'))
            $this->minimum_amount *= 2;

        if($value < $this->minimum_amount)
            return false;
        return true;

    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The minimum amount for the selected currency is ' . $this->minimum_amount . ' and ' . $this->minimum_amount*2 . ' for 2 persons';
    }
}
